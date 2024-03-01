<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_products');
    }

    public function getPriceAttribute($value)
    {
        return (float) $value;
    }
}

