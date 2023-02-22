<?php
namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testComputeTVAFoodProduct()
    {
        $product = new Product('Pomme', 'food', 1);
        $this->assertSame(0.055, $product->computeTVA());
    }

    public function testComputeTVAOtherProduct()
    {
        $product = new Product('Mangue', 'fruits', 20);
        $this->assertSame(3.92, $product->computeTVA());
    }
}