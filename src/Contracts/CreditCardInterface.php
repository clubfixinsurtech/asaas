<?php

namespace Asaas\Contracts;

interface CreditCardInterface
{
    public function holderName(string $holderName):self;

    public function number(string $number):self;

    public function expiryMonth(int $expiryMonth):self;

    public function expiryYear(int $expiryYear):self;

    public function ccv(string $ccv):self;

    public function getHolderName(): string;

    public function getNumber(): string;

    public function getExpiryMonth(): int;

    public function getExpiryYear(): int;

    public function getCcv(): string;
}