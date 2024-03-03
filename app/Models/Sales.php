<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
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
