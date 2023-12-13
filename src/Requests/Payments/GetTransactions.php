<?php

namespace Asaas\Requests\Payments;

use Asaas\Filters\Filter;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTransactions extends Request
{
    protected Method $method = Method::GET;


    public function __construct(
        private null|array|Filter $filters = null
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function resolveEndpoint(): string
    {
        return '/payments';
    }

    protected function defaultQuery(): array
    {
        if (is_array($this->filters)) {
            return $this->filters;
        }

        if ($this->filters instanceof Filter) {
            return $this->filters->toArray();
        }

        return [
            'offset' => 0,
            'limit' => 15,
        ];
    }

}
