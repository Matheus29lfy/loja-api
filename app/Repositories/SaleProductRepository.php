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

    public function canceledSale($saleId)
    {
     return SaleProduct::where('sale_id', $saleId)
           ->update(['accomplished' => 'canceled']);
    }



    public function finishSale($saleId)
    {
        return SaleProduct::where('sale_id', $saleId)
        ->update(['accomplished' => 'done']);
    }




}


