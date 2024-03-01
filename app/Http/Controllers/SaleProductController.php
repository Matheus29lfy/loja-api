<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Services\SaleProductService;

class SaleProductController extends Controller
{
    protected $saleProductService;

    public function __construct(SaleProductService $saleProductService)
    {
        $this->saleProductService = $saleProductService;
    }
    public function addProduct(Request $request, $saleId, $productId)
    {
     // Validar a quantidade fornecida
     $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $quantity = $request->input('quantity');

    $this->saleProductService->addProduct($saleId, $productId, $quantity);

    return response()->json(['message' => 'Produto adicionado ao pedido com sucesso']);

    }

    public function showSale($saleId)
    {
        // Recuperar a venda com os produtos associados
        $sale = Sale::with(['products' => function ($query) {
            $query->select('products.*', 'sales_product.quantity as amount');
        }])->findOrFail($saleId);

        return response()->json($sale);
    }


    public function deleteSale($saleId)
    {
        $this->saleProductService->deleteSale($saleId);

        return response()->json(['message' => 'Deletado pedido com sucesso']);
    }
}

