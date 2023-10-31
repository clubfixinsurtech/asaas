<?php

namespace Asaas\Contracts;

use Asaas\Entities\Customer;

interface CustomerInterface
{
    /**
     * @return AddressInterface|null
     */
    public function getAddress(): ?AddressInterface;

    /**
     * @param AddressInterface|null $address
     * @return Customer
     */
    public function setAddress(?AddressInterface $address): self;

    /**
     * @return string|null
     */
    public function getGroupName(): ?string;

    /**
     * @param string|null $groupName
     * @return Customer
     */
    public function setGroupName(?string $groupName): self;

    /**
     * @return string|null
     */
    public function getObservations(): ?string;

    /**
     * @param string|null $observations
     * @return Customer
     */
    public function setObservations(?string $observations): self;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): self;

    /**
     * @return string
     */
    public function getDocument(): string;

    /**
     * @param string $cpfCnpj
     * @return Customer
     */
    public function setDocument(string $document): self;

    /**
     * @return string
     */
    public function getPhone(): string;

    /**
     * @param string $phone
     * @return Customer
     */
    public function setPhone(string $phone): self;

    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     * @return Customer
     */
    public function setEmail(?string $email): self;

    /**
     * @return string|null
     */
    public function getMobilePhone(): ?string;

    /**
     * @param string|null $mobilePhone
     * @return Customer
     */
    public function setMobilePhone(?string $mobilePhone): self;

    /**
     * @return string|null
     */
    public function getExternalReference(): ?string;

    /**
     * @param string|null $externalReference
     * @return Customer
     */
    public function setExternalReference(?string $externalReference): self;

    /**
     * @return string|null
     */
    public function getCompany(): ?string;

    /**
     * @param string|null $company
     * @return Customer
     */
    public function setCompany(?string $company): self;
}