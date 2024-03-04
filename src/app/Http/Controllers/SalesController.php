<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
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

    public function create()
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


           public function canceledSale($saleId)
           {

               try {
                   $this->salesService->canceledSale($saleId);

                   return response()->json(['message' => 'Cancelado pedido com sucesso']);

                   }catch (\Exception $e) {

                       return response()->json(['error' => 'Erro ao cancelar o pedido.
                                                Detalhes: ' . $e->getMessage()],
                                               Response::HTTP_INTERNAL_SERVER_ERROR);

                   }

           }
           public function finishSale($saleId)
           {

               try {

                    $sale = Sales::findOrFail($saleId);

                     // Verifique se existem produtos vinculados à venda
                    if ($sale->products()->count() === 0) {
                        return response()->json(['error' => 'Pedido não pode ser finalizado sem ter produtos.'], 400);
                    }
                   $this->salesService->finishSale($saleId);

                   return response()->json(['message' => 'Pedido finalizado com sucesso'],201);

                   }catch (\Exception $e) {

                       return response()->json(['error' => 'Erro ao finalizar o pedido.
                                                Detalhes: ' . $e->getMessage()],
                                               Response::HTTP_INTERNAL_SERVER_ERROR);

                   }

           }

}
