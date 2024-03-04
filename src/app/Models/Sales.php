<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = ['accomplished'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_products', 'sale_id', 'product_id');
    }

    public function getTotalAmountAttribute($value)
    {
        return (float) $value;
    }
}
