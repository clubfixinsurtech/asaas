<?php

namespace Asaas;

use Saloon\Http\Connector;

class AsaasConnector extends Connector
{

    public function __construct(
        private string  $apiKey,
        private bool $production = true
    )
    {
    }

    public function resolveBaseUrl(): string
    {
        if ($this->production) {
            return 'https://api.asaas.com/v3';
        }

        return 'https://sandbox.asaas.com/api/v3';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'access_token' => $this->apiKey,
        ];
    }
}