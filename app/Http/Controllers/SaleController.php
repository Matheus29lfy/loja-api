<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('products')->get();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        // Implementar lógica para criar uma nova venda
    }

    public function show($id)
    {
        $sale = Sale::with('products')->find($id);
        return response()->json($sale);
    }

    // Implementar outros métodos conforme necessário
}
