<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['sales_id', 'amount'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price')->withTimestamps();
    }
}
