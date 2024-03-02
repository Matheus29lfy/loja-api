<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Sale::class;
    public function definition(): array
    {
     return [
        'amount' => $this->faker->randomFloat(2, 100, 1000),
    ];
    }

    // $factory->define(App\Models\Sale::class, function (Faker $faker) {

    // });
}


