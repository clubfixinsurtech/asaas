<?php

namespace Asaas\Entities;

use Asaas\Contracts\AddressInterface;
use Asaas\Contracts\CustomerInterface;
use Asaas\Contracts\HasPayload;
use \Asaas\Traits\HasPayload as HasPayloadTrait;
use Asaas\Helpers\ReflectionalProperties;
use Asaas\Helpers\RequiredFields;
use Asaas\Helpers\Validator;
use Asaas\Traits\ConditionableTrait;

class Customer implements CustomerInterface, HasPayload
{
    use ConditionableTrait, HasPayloadTrait;

    private array $requireds = ['name', 'document'];

    private ?AddressInterface $address = null;

    private bool $notificationDisabled = false;

    private ?string $groupName = null;

    private ?string $observations = null;

    public function __construct(
        private string  $name,
        private string  $cpfCnpj,
        private string  $phone,
        private ?string $email = null,
        private ?string $mobilePhone = null,
        private ?string $externalReference = null,
        private ?string $company = null,
    )
    {
        $this->validate();
    }

    public function __get(string $name)
    {
        return (property_exists($this, $name) ? $this->{$name} : null);
    }


    public function enableNotifications(): self
    {
        $this->notificationDisabled = false;
        return $this;
    }

    public function disableNotifications()
    {
        $this->notificationDisabled = false;
        return $this;
    }

    public function validate(): void
    {
        RequiredFields::check($this->requireds, $this);

        $this->when(
            !empty($this->email),
            fn(self $customer) => Validator::email($this->email)
        );
    }

    /**
     * @return AddressInterface|null
     */
    public function getAddress(): ?AddressInterface
    {
        return $this->address;
    }

    /**
     * @param AddressInterface|null $address
     * @return Customer
     */
    public function setAddress(?AddressInterface $address): Customer
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    /**
     * @param string|null $groupName
     * @return Customer
     */
    public function setGroupName(?string $groupName): Customer
    {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservations(): ?string
    {
        return $this->observations;
    }

    /**
     * @param string|null $observations
     * @return Customer
     */
    public function setObservations(?string $observations): Customer
    {
        $this->observations = $observations;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->cpfCnpj;
    }

    /**
     * @param string $cpfCnpj
     * @return Customer
     */
    public function setDocument(string $document): Customer
    {
        $this->cpfCnpj = $document;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Customer
     */
    public function setPhone(string $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Customer
     */
    public function setEmail(?string $email): Customer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    /**
     * @param string|null $mobilePhone
     * @return Customer
     */
    public function setMobilePhone(?string $mobilePhone): Customer
    {
        $this->mobilePhone = $mobilePhone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalReference(): ?string
    {
        return $this->externalReference;
    }

    /**
     * @param string|null $externalReference
     * @return Customer
     */
    public function setExternalReference(?string $externalReference): Customer
    {
        $this->externalReference = $externalReference;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string|null $company
     * @return Customer
     */
    public function setCompany(?string $company): Customer
    {
        $this->company = $company;
        return $this;
    }

}