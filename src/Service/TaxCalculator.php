<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;

final class TaxCalculator
{
    private array $taxRates;

    public function __construct(array $taxRates)
    {
        $this->taxRates = $taxRates;
    }

    public function getCountryCodeFromTaxNumber(string $taxNumber): string
    {
        return substr($taxNumber, 0, 2);
    }

    public function getTaxRate(string $countryCode): float
    {
        return $this->taxRates[$countryCode] ?? 0;
    }

    public function calculateFinalPrice(Product $product, string $taxNumber): float
    {
        $countryCode = $this->getCountryCodeFromTaxNumber($taxNumber);
        $taxRate = $this->getTaxRate($countryCode);
        return $product->getPrice() * (1 + $taxRate);
    }
}
