<?php
namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Support\Facades\DB;

class SalesRepository
{
    const  ACCOMPLISHED_CANCELED = 'canceled';
    const  ACCOMPLISHED_DONE = 'done';
    public function getAll()
    {

       return Sales::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*,  COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->groupBy('sales.id','sale_products.quantity','sales.accomplished', 'created_at','updated_at')
        ->get();
    }

    public function create()
    {
        return Sales::create();
    }
    public function getSaleById($id)
    {
       return Sales::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*, COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->where('sales.id', $id)
        ->groupBy('sales.id','sale_products.quantity', 'sales.accomplished','created_at','updated_at')
       ->first();
    }

    public function getAllFinished()
    {

       return Sales::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*,  COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->where('sales.accomplished', '=', self::ACCOMPLISHED_DONE)
        ->groupBy('sales.id','sales.accomplished','sale_products.quantity', 'created_at','updated_at')
        ->get();
    }


    public function canceledSale($saleId)
    {
     return Sales::where('id', $saleId)
           ->update(['accomplished' => 'canceled']);
    }



    public function finishSale($saleId)
    {
        return Sales::where('id', $saleId)
        ->update(['accomplished' => 'done']);
    }
}

