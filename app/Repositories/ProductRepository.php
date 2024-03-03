<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $model = Product::class;
    public function getAll()
    {

        return Product::all();
    }

    public function create($data)
    {
        return Product::create($data);
    }
}

