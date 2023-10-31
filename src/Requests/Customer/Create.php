<?php

namespace Asaas\Requests\Customer;

use Asaas\Entities\Customer;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class Create extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        private Customer $entity
    )
    {
    }



    public function resolveEndpoint(): string
    {
        return '/customers';
    }

    protected function defaultBody(): array
    {
        return $this->entity->payload();
    }
}