<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $model = Product::class;
    public function getAll()
    {

        return Product::all();
        // return 'Teste';
    }

    public function create($data)
    {
        // dd($data);
        return Product::create($data);
    }

    // public function definition()
    // {
    //     return [
    //         'name' => $this->faker->word,
    //         'price' => $this->faker->randomFloat(2, 10, 1000),
    //         'description' => $this->faker->sentence,
    //     ];
    // }
}

