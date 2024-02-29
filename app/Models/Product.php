<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sales_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}

