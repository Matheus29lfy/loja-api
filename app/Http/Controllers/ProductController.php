<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        // Consulta (Query)
        $products = $this->productService->getAllProducts();
        dd( $products);
        return response()->json($products);
    }

    public function store()
    {
        // Comando (Command)
        $newProduct = $this->productService->createProduct(request()->all());
        return response()->json($newProduct, 201);
    }
}

