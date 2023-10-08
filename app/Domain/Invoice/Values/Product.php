<?php

namespace App\Domain\Invoice\Values;

class Product
{
    public function __construct(
        private string $name,
        private int    $quantity,
        private int    $price
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getTotal(): int
    {
        return $this->quantity * $this->price;
    }
}
