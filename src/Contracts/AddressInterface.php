<?php

namespace Asaas\Contracts;

use Asaas\Entities\Address;

interface AddressInterface
{
    /**
     * @return array
     */
    public function getRequireds(): array;

    /**
     * @param array $requireds
     * @return Address
     */
    public function setRequireds(array $requireds): self;

    /**
     * @return string
     */
    public function getPostalCode(): string;

    /**
     * @param string $postalCode
     * @return Address
     */
    public function setPostalCode(string $postalCode): self;

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @param string $address
     * @return Address
     */
    public function setAddress(string $address): self;

    /**
     * @return string
     */
    public function getAddressNumber(): string;

    /**
     * @param string $addressNumber
     * @return Address
     */
    public function setAddressNumber(string $addressNumber): self;

    /**
     * @return string
     */
    public function getComplement(): string;

    /**
     * @param string $complement
     * @return Address
     */
    public function setComplement(string $complement): self;

    /**
     * @return string
     */
    public function getProvince(): string;

    /**
     * @param string $province
     * @return Address
     */
    public function setProvince(string $province): self;
}