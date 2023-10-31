<?php

namespace Asaas\Contracts;

interface HasPayload  extends \JsonSerializable
{
    public function payload():array;
}