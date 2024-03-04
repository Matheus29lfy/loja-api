<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function sales()
    {
        return $this->belongsToMany(Sales::class, 'sale_products', 'sale_id', 'product_id');
    }

    public function getPriceAttribute($value)
    {
        return (float) $value;
    }
}

