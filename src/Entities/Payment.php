<?php

namespace Asaas\Entities;

use Asaas\Contracts\CreditCardHolderInfoInterface;
use Asaas\Contracts\CreditCardInterface;
use Asaas\Contracts\HasPayload;
use Asaas\Enums\BillingType;
use Asaas\Helpers\ReflectionalProperties;
use Asaas\Helpers\RequiredFields;
use Asaas\Helpers\Validator;
use Asaas\Traits\ConditionableTrait;

class Payment implements HasPayload
{
    use ConditionableTrait;

    private array $requireds = [
        'customer',
        'billingType',
        'value',
        'dueDate'
    ];

    private ?int $installmentCount = null;
    private ?int $installmentValue = null;

    private ?CreditCardInterface $creditCard = null;

    private ?string $creditCardToken = null;

    private ?string $remoteIp = null;

    private ?CreditCardHolderInfoInterface $creditCardHolderInfo = null;

    public function __construct(
        private string             $customer,
        private float              $value,
        private \DateTimeInterface $dueDate,
        private BillingType        $billingType = BillingType::UNDEFINED,
        private ?string            $description = null,
        private ?string            $externalReference = null,
        private ?float             $totalValue = null,
        private ?float             $discount = null,
        private ?string            $successUrl = null
    )
    {
        $this->validate();
    }

    public function __get(string $name)
    {
        return (property_exists($this, $name) ? $this->{$name} : null);
    }

    public function validate()
    {
        $this->when(
            $this->billingType == BillingType::CREDIT_CARD && empty($this->creditCardToken),
            function (self $payment) {
                $payment->requireds = array_merge($payment->requireds, ['creditCard']);
            },
            function (self $payment) {
                $payment->requireds = array_filter($payment->requireds, fn($item) => $item != 'creditCard');
            }
        );

        RequiredFields::check($this->requireds, $this);
    }

    public function withCard(CreditCardInterface $card, int $installmentCount, float $installmentValue)
    {
        $this->creditCard = $card;
        $this->installmentCount = $installmentCount;
        $this->installmentValue = $installmentValue;
        $this->validate();
        return $this;
    }

    public function withCardToken(string $token)
    {
        $this->creditCardToken = $token;
        $this->validate();
        return $this;
    }

    public function remoteIp(string $ip)
    {
        Validator::ip($ip);

        $this->remoteIp = $ip;
        return $this;
    }

    public function payload(): array
    {
        return array_map(function ($value) {
            if (Validator::isEnum($value)) {
                $value = $value->value;
            }

            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d');
            }

            return $value;
        }, ReflectionalProperties::filledProperties($this));
    }

}
