<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Product;
use App\Services\SalesService;
use Illuminate\Http\Response;

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

        if (!$sales) {
            return response()->json(['message' => 'Não foi encontrado vendas '], 404);
        }
        return response()->json($sales);
    }

    public function store()
    {
        try {
            $sales = $this->salesService->createSales();
            return response()->json($sales, 201);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar vendas. Detalhes: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

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
                  return response()->json(['message' => 'Nenhuma venda finalizada foi encontrada'], 404);
              }

              return response()->json($sale);
           }




    // Implementar outros métodos conforme necessário
}
