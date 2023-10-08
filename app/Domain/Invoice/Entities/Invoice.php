<?php

namespace App\Domain\Invoice\Entities;

use App\Domain\Enums\StatusEnum;
use App\Domain\Invoice\Values\Company;
use App\Domain\Invoice\Values\Product;

class Invoice
{
    public function __construct(
        private string   $id,
        private string   $number,
        private string   $date,
        private string   $dueDate,
        private string   $companyId,
        private string   $status,
        private string   $createdAt,
        private string   $updatedAt,
        private ?Company $company,
        private ?array   $products,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDueDate(): string
    {
        return $this->dueDate;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getStatus(): StatusEnum
    {
        return StatusEnum::from($this->status);
    }

    public function setStatus(StatusEnum $status): void
    {
        $this->status = $status->value;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotal(): int
    {
        $total = 0;
        /** @var Product $product */
        foreach ($this->products as $product) {
            $total += $product->getTotal();
        }

        return $total;
    }
}
