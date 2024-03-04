<?php

namespace Database\Factories;

use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Sales::class;
    public function definition(): array
    {
     return [
        'accomplished' => 'draft',
    ];
    }

    // $factory->define(App\Models\Sales::class, function (Faker $faker) {

    // });
}


