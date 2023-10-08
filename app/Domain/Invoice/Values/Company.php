<?php

namespace App\Domain\Invoice\Values;

class Company
{
    public function __construct(
        private string $name,
        private string $street,
        private string $city,
        private string $zip,
        private string $phone,
        private string $email,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
