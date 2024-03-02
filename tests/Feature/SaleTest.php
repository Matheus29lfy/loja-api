<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sale;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Factory;

class SaleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCreateSale()
    {
         // Criação de uma nova venda sem adicionar produtos
         $response = $this->postJson('/api/sales', [
            'amount' => 0,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('sales', [
            'amount' => 0,
        ]);

        $saleId = $response->json('id');

        $this->assertDatabaseHas('sales', [
            'id' => $saleId,
        ]);
    }

    public function testAddProductToSale()
    {
        // Criar uma venda
        $sale = Sale::create();

        $product = [
                        'name' => 'Product 1',
                        'price' => 100.00,
                        'description' => 'Description 1',
        ];
        $product = Product::create($product);
        $quantity = 2;

        $response = $this->postJson("/api/sales/{$sale->id}/add-product/{$product->id}",
                                     ['quantity' => $quantity]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('sale_products', [
            'sale_id' => $sale->id,
            'product_id' => $product->id,
        ]);
    }

    public function testGetSaleById()
    {
        // Criar uma venda
        $sale = Sale::create();

        $response = $this->get("/api/sales/{$sale->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $sale->id,
            'amount' => $sale->amount,
            'created_at' => $sale->created_at->toISOString(),
            'updated_at' => $sale->updated_at->toISOString(),
        ]);
    }
    // public function testCreateSaleWithProducts()
    // {
    //     // Criação de produtos para associar à venda
    //     $products = [
    //         [
    //             'name' => 'Product 1',
    //             'price' => 100.00,
    //             'description' => 'Description 1',
    //         ],
    //         [
    //             'name' => 'Product 2',
    //             'price' => 200.00,
    //             'description' => 'Description 2',
    //         ],
    //     ];

    //     foreach ($products as $product) {
    //         Product::create($product);
    //     }

    //     // Dados para a criação da venda
    //     $saleData = [
    //         'amount' => 0,
    //         'products' => [
    //             ['product_id' => 1, 'quantity' => 2],
    //             ['product_id' => 2, 'quantity' => 1],
    //         ],
    //     ];

    //     // Criação da venda com os produtos associados
    //     $response = $this->postJson('/api/sales', $saleData);

    //     // Verificar se a resposta é bem-sucedida
    //     $response->assertStatus(201);

    //     // Verificar se a venda foi criada corretamente no banco de dados
    //     $this->assertDatabaseHas('sales', [
    //         'amount' => 0,
    //     ]);

    //     // Verificar se os produtos foram associados corretamente à venda
    //     $this->assertDatabaseHas('sale_products', [
    //         'sale_id' => $response->json('id'),
    //         'product_id' => 1,
    //         'quantity' => 2,
    //     ]);

    //     $this->assertDatabaseHas('sale_products', [
    //         'sale_id' => $response->json('id'),
    //         'product_id' => 2,
    //         'quantity' => 1,
    //     ]);
    //   }
    }
