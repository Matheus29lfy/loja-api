<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Services\SalesService;

class SalesController extends Controller
{
    protected $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }

    public function index()
    {
        $sales = $this->salesService->getAllSales();
        return response()->json($sales);
    }

    public function store(Request $request)
    {
        $sales = $this->salesService->createSales($request->all());
        return response()->json($sales);
    }

    public function show($id)
    {
        $sale = Sale::with('products')->find($id);
        return response()->json($sale);
    }

    // Implementar outros métodos conforme necessário
}
