<?php

namespace Asaas\Traits;

use Asaas\Helpers\ReflectionalProperties;

trait HasPayload
{
    public function payload():array
    {
        return ReflectionalProperties::filledProperties($this);
    }

    public function jsonSerialize():mixed
    {
        return $this->payload();
    }
}
