<?php

namespace Asaas\Filters;

class Filter
{
    private array $filters = [
        'offset' => 0,
        'limit' => 15,
    ];

    public static function group(callable $callable)
    {
        return $callable(new static());
    }

    public function column(string $column, string|int|float $value)
    {
        $this->filters[$column] = $value;
        return $this;
    }

    public function __toString()
    {
        return http_build_query($this->filters);
    }

    public function toArray()
    {
        return $this->filters;
    }

    public function between(string $start, string $end)
    {
        return $this->column('dateCreated[ge]', $start)
            ->column('dateCreated[le]', $end);
    }

    public function status(string $status)
    {
        return $this->column('status', $status);
    }

    public function reference(string $reference)
    {
        return $this->column('reference', $reference);
    }

    public function customer(string $customer)
    {
        return $this->column('customer', $customer);
    }

    public function payment(string $paymentId)
    {
        return $this->column('payment', $paymentId);
    }

    public function offset(int $offset)
    {
        return $this->column('offset', $offset);
    }

    public function limit(int $limit)
    {
        return $this->column('limit', $limit);
    }

}
