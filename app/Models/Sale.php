<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['sale_id', 'product_id'];
    // protected $casts = [
    //     'total_amount' => 'decimal:2',
    // ];
    public function products()
    {
        return $this->belongsToMany(Product::class,'sale_products');
        // ->withPivot('quantity')->withTimestamps();
    }

    public function getTotalAmountAttribute($value)
    {
        return (float) $value;
    }
}
