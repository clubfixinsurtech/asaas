<?php

namespace Asaas\Requests\Payments;

use Asaas\Entities\Payment;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class Create extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private readonly Payment $payment
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/payments';
    }

    protected function defaultBody(): array
    {
        return $this->payment->payload();
    }


}