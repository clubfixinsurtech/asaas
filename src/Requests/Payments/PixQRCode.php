<?php

namespace Asaas\Requests\Payments;

use Saloon\Http\Request;

class PixQRCode extends Request
{

    public function __construct(
        private string $paymentId,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function resolveEndpoint(): string
    {
        return "/payments/{$this->paymentId}/pixQrCode";
    }
}
