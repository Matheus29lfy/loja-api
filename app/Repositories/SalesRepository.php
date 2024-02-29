<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\Sale;

class SalesRepository
{
    public function getAll()
    {
         return Sale::all();
    }

    public function create($data)
    {
        return Sale::create($data);
    }
}

