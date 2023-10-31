<?php

namespace Asaas\Entities;

use Asaas\Contracts\CreditCardHolderInfoInterface;
use Asaas\Contracts\CreditCardInterface;
use Asaas\Contracts\HasPayload;
use Asaas\Exceptions\CreditCardException;

class CreditCard implements CreditCardInterface, HasPayload
{
    use \Asaas\Traits\HasPayload;

    public function __construct(
        private CreditCardHolderInfoInterface $creditCardHolderInfo,
        private string                        $number,
        private int                           $expiryMonth,
        private int                           $expiryYear,
        private string                        $ccv
    )
    {
        $this->holderName = $this->creditCardHolderInfo->getName();
        $this->validate();
    }

    public function getHolderName(): string
    {
        return $this->holderName;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getExpiryMonth(): int
    {
        return $this->expiryMonth;
    }

    public function getExpiryYear(): int
    {
        return $this->expiryYear;
    }

    public function getCcv(): string
    {
        return $this->ccv;
    }

    private function validate(): void
    {
        $properties = (new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PRIVATE);

        $nullProperties = array_filter($properties, function ($property) {
            return empty($this->{$property->name});
        });

        if (count($nullProperties)) {
            $exception = new CreditCardException("Há campos que não foram preenchidos.");

            array_walk($nullProperties, fn($value, $key) => $exception->addField($key, "Este campo não pode ser nulo ou vazio."));

            throw $exception;
        }

        if ($this->expiryMonth < 1 || $this->expiryMonth > 12) {
            throw (new CreditCardException("Informe um mês Válido"))->addField('expiryMonth');
        }

        if ($this->expiryYear < date('Y')) {
            throw (new CreditCardException("Informe um ano Válido"))->addField('expiryYear');
        }

        $givenDate = (new \DateTime("{$this->expiryYear}-{$this->expiryMonth}-" . date('d')))->setTime(0, 0);

        if ($givenDate < (new \DateTime())->setTime(0, 0)) {
            throw (new CreditCardException("Este Cartão está expirado!"))
                ->addField('expiryYear')
                ->addField('expiryMonth');
        }

        $this->normalize();
    }

    public function holderName(string $holderName): CreditCardInterface
    {
        $this->holderName = $holderName;
        $this->validate();
        return $this;
    }

    public function number(string $number): CreditCardInterface
    {
        $this->number = $number;
        $this->validate();
        return $this;
    }

    public function expiryMonth(int $expiryMonth): CreditCardInterface
    {
        $this->expiryMonth = $expiryMonth;
        $this->validate();
        return $this;
    }

    public function expiryYear(int $expiryYear): CreditCardInterface
    {
        $this->expiryYear = $expiryYear;
        $this->validate();
        return $this;
    }

    public function ccv(string $ccv): CreditCardInterface
    {
        $this->ccv = $ccv;
        $this->validate();
        return $this;
    }

    private function normalize(): void
    {
        $this->expiryMonth = str_pad($this->expiryMonth, 2, "0", STR_PAD_LEFT);
        $this->number = preg_replace("/[^0-9]/", "", $this->number);
        $this->ccv = substr($this->ccv, 0, 3);
    }

}