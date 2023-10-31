<?php

namespace Asaas\Contracts;

interface CreditCardHolderInfoInterface
{
    public function name(string $name):self;
    public function email(string $email):self;
    public function document(string $document):self;
    public function postalCode(string $postalCode):self;
    public function addressNumber(string $addressNumber):self;
    public function addressComplement(string $addressComplement):self;
    public function phone(string $phone):self;
    public function mobilePhone(string $mobilePhone):self;

    public function getName(): string;

    public function getEmail(): string;

    public function getDocument(): string;

    public function getPostalCode(): string;

    public function getAddressNumber(): string;

    public function getPhone(): string;

    public function getAddressComplement(): ?string;

    public function getMobilePhone(): ?string;
}