<?php

namespace Asaas\Entities;

use Asaas\Contracts\CreditCardHolderInfoInterface;
use Asaas\Contracts\HasPayload;
use Asaas\Exceptions\CreditCardHolderInfoException;

class CreditCardHolderInfo implements CreditCardHolderInfoInterface, HasPayload
{
    use \Asaas\Traits\HasPayload;
    public function __construct(
        private string  $name,
        private string  $email,
        private string  $cpfCnpj,
        private string  $postalCode,
        private string  $addressNumber,
        private string  $phone,
        private ?string $addressComplement = null,
        private ?string $mobilePhone = null,
    )
    {
        $this->validate();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDocument(): string
    {
        return $this->cpfCnpj;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddressComplement(): ?string
    {
        return $this->addressComplement;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    private function validate(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw (new CreditCardHolderInfoException("Informe um e-mail válido"))
                ->addField('email');
        }

        $this->normalize();
    }

    private function normalize()
    {
        $this->cpfCnpj = $this->onlyDigits($this->cpfCnpj);
        $this->phone = $this->onlyDigits($this->phone);
        $this->mobilePhone = $this->onlyDigits($this->mobilePhone);
    }

    public function name(string $name): CreditCardHolderInfoInterface
    {
        $this->name = $name;
        $this->validate();
        return $this;
    }

    public function email(string $email): CreditCardHolderInfoInterface
    {
        $this->email = $email;
        $this->validate();
        return $this;
    }

    public function document(string $document): CreditCardHolderInfoInterface
    {
        $this->cpfCnpj = $document;
        $this->validate();
        return $this;
    }

    public function postalCode(string $postalCode): CreditCardHolderInfoInterface
    {
        $this->postalCode = $postalCode;
        $this->validate();
        return $this;
    }

    public function addressNumber(string $addressNumber): CreditCardHolderInfoInterface
    {
        $this->addressNumber = $addressNumber;
        $this->validate();
        return $this;
    }

    public function addressComplement(string $addressComplement): CreditCardHolderInfoInterface
    {
        $this->addressComplement = $addressComplement;
        $this->validate();
        return $this;
    }

    public function phone(string $phone): CreditCardHolderInfoInterface
    {
        $this->phone = $phone;
        $this->validate();
        return $this;
    }

    public function mobilePhone(string $mobilePhone): CreditCardHolderInfoInterface
    {
        $this->mobilePhone = $mobilePhone;
        $this->validate();
        return $this;
    }

    public function onlyDigits(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}