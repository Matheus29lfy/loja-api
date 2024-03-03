<?php
namespace App\Repositories;


use App\Models\SaleProduct;

class SaleProductRepository
{
    public function addProduct($saleId, $productId, $quantity)
    {
        return SaleProduct::create([
            'product_id' => $productId,
            'sale_id' => $saleId,
            'quantity' => $quantity
        ]);
    }

}


