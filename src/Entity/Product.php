<?php

declare(strict_types=1);

namespace App\Entity;

final class Product implements \Stringable
{
    public function __construct(
        private readonly string $name,
        private readonly float $price
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return sprintf('%s (%s EUR)', $this->name, $this->price);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function __toString(): string
    {
        return $this->getLabel();
    }
}
