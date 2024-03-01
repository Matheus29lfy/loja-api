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


     public function getSaleById($id)
     {
          $sale = $this->salesService->getSaleById($id);

           if (!$sale) {
               return response()->json(['message' => 'Venda não encontrada'], 404);
           }

            return response()->json($sale);
      }

        public function getAllFinished()
        {
             $sale = $this->salesService->getAllFinished();

              if (!$sale) {
                  return response()->json(['message' => 'Nenhuma venda foi finalizada foi encontrada'], 404);
              }

              return response()->json($sale);
           }




    // Implementar outros métodos conforme necessário
}
