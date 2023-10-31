<?php

namespace Asaas\Requests\CreditCard;

use Asaas\Contracts\CreditCardHolderInfoInterface;
use Asaas\Contracts\CreditCardInterface;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class Tokenize extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private string                        $customer,
        private CreditCardInterface           $creditCard,
        private CreditCardHolderInfoInterface $creditCardHolderInfo,
        private string                        $remoteIp,

    )
    {
    }

    /**
     * @inheritDoc
     */
    public function resolveEndpoint(): string
    {
        return '/creditCard/tokenize';
    }

    protected function defaultBody(): array
    {
        return [
            'customer' => $this->customer,
            'creditCard' => $this->creditCard,
            'creditCardHolderInfo' => $this->creditCardHolderInfo,
            'remoteIp' => $this->remoteIp,
        ];
    }
}