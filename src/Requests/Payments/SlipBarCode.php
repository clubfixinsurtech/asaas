<?php

namespace Asaas\Requests\Payments;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class SlipBarCode extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        private string $paymentId
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function resolveEndpoint(): string
    {
        return "/payments/{$this->paymentId}/identificationField";
    }
}
