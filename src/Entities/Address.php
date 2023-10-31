<?php

namespace Asaas\Entities;

use Asaas\Contracts\AddressInterface;
use Asaas\Contracts\HasPayload;
use Asaas\Helpers\RequiredFields;

class Address implements AddressInterface, HasPayload
{
    use \Asaas\Traits\HasPayload;

    private array $requireds = [
        'postalCode',
        'address',
        'addressNumber',
        'complement',
        'province',
    ];

    public function __construct(
        private string $postalCode,
        private string $address,
        private string $addressNumber,
        private string $complement,
        private string $province,
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        RequiredFields::check($this->requireds, $this);
    }

    /**
     * @return array
     */
    public function getRequireds(): array
    {
        return $this->requireds;
    }

    /**
     * @param array $requireds
     * @return Address
     */
    public function setRequireds(array $requireds): Address
    {
        $this->requireds = $requireds;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress(string $address): Address
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressNumber(): string
    {
        return $this->addressNumber;
    }

    /**
     * @param string $addressNumber
     * @return Address
     */
    public function setAddressNumber(string $addressNumber): Address
    {
        $this->addressNumber = $addressNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     * @return Address
     */
    public function setComplement(string $complement): Address
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * @param string $province
     * @return Address
     */
    public function setProvince(string $province): Address
    {
        $this->province = $province;
        return $this;
    }
}