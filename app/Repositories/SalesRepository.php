<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SalesRepository
{
    const  ACCOMPLISHED_CANCELED = 'canceled';
    const  ACCOMPLISHED_DONE = 'done';
    public function getAll()
    {

       return Sale::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*,  COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->groupBy('sales.id', 'sales.amount','sale_products.quantity', 'created_at','updated_at')
        // ->where('sale_products.accomplished', '!=', self::ACCOMPLISHED_CANCELED)
        ->get();
    }

    public function create($data)
    {
        return Sale::create($data);
    }
    public function getSaleById($id)
    {
       return Sale::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*, COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->where('sales.id', $id)
        ->groupBy('sales.id', 'sales.amount','sale_products.quantity', 'created_at','updated_at')
       ->first();
    }

    public function getAllFinished()
    {

       return Sale::with(['products' => function ($query) {
            $query->select('name', 'description', 'sale_products.quantity', DB::raw('price * sale_products.quantity as price'));
        }])
        ->selectRaw('sales.*,  COALESCE(SUM(price * sale_products.quantity), 0) as total_amount')
        ->leftJoin('sale_products', 'sales.id', '=', 'sale_products.sale_id')
        ->leftJoin('products', 'products.id', '=', 'sale_products.product_id')
        ->where('sale_products.accomplished', '=', self::ACCOMPLISHED_DONE)
        ->groupBy('sales.id', 'sales.amount','sale_products.quantity', 'created_at','updated_at')
        ->get();
    }
}

