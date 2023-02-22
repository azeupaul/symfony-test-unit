<?php
namespace App\Tests\Entity;

use App\Entity\Product;
use Exception;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /**
     * 
     * @dataProvider pricesForFoodProduct
     */
    public function testComputeTVAFoodProduct($price, $expectedTva)
    {
        $product = new Product('Pomme', 'food', $price);
        $this->assertSame($expectedTva, $product->computeTVA());
    }

    public function testComputeTVAOtherProduct()
    {
        $product = new Product('Mangue', 'fruits', 20);
        $this->assertSame(3.92, $product->computeTVA());
    }

    public function testComputeTVAWithNegativePrice()
    {
        $product = new Product('Fraise', 'fruits', -10);
        $this->expectException(Exception::class);
        $product->computeTVA();
    }

    public function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }
}