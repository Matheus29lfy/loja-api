<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleProduct>
 */
class SaleProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = SaleProduct::class;
    public function definition(): array
    {

        $productId = Product::factory()->create()->id;
        $saleId = Sales::factory()->create()->id;

        return [
            'product_id' =>  $productId,
            'sale_id' => $saleId,
            'quantity' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
