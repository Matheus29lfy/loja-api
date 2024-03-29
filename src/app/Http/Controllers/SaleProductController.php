<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SaleProductService;
use Illuminate\Http\Response;

class SaleProductController extends Controller
{
    protected $saleProductService;

    public function __construct(SaleProductService $saleProductService)
    {
        $this->saleProductService = $saleProductService;
    }
    public function addProduct(Request $request, $saleId, $productId)
    {

        try {
        // Validar a quantidade fornecida
         $request->validate([
            'quantity' => 'required|integer|min:1',
         ]);

         $quantity = $request->input('quantity');

         $this->saleProductService->addProduct($saleId, $productId, $quantity);

         return response()->json(['message' => 'Produto adicionado ao pedido com sucesso'],201);

        }catch (\Exception $e) {

            return response()->json(['error' => 'Erro ao adicionar
                                    produto a uma venda. Detalhes: ' . $e->getMessage()],
                                    Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    // public function showSale($saleId)
    // {
    //     // Recuperar a venda com os produtos associados
    //     $sale = Sales::with(['products' => function ($query) {
    //         $query->select('products.*', 'sales_product.quantity as amount');
    //     }])->findOrFail($saleId);

    //     return response()->json($sale);
    // }


}

