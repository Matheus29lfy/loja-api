<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SaleProduct;
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
            'id' => ['id'],
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('sales', [
            'id' =>  $response['id'],
        ]);

        $saleId = $response->json('id');

        $this->assertDatabaseHas('sales', [
            'id' => $saleId,
        ]);
    }

    public function testAddProductToSale()
    {
        // Criar uma venda
        $sale = Sales::create();

        $product = Product::factory()
              ->create();
        $quantity = 2;

        $response = $this->postJson("/api/sales/{$sale->id}/add-product/{$product->id}",
                                     ['quantity' => $quantity]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('sale_products', [
            'sale_id' => $sale->id,
            'product_id' => $product->id,
        ]);
    }

    public function testGetSaleById()
    {
        // Criar uma venda
        $sale = Sales::create();

        $response = $this->get("/api/sales/{$sale->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $sale->id,
            'created_at' => $sale->created_at->toISOString(),
            'updated_at' => $sale->updated_at->toISOString()
        ]);
    }

    public function testGetAllFinishedSales()
    {
        $unfinishedSale = Sales::factory()
            ->count(3)
            ->create();

       $finishedSales =  Sales::factory()
            ->count(3)
            ->state(['accomplished' => 'done'])
            ->create();

        // Chama a rota
        $response = $this->get('/api/sales/get-finished');

        $response->assertStatus(200);

        foreach ($finishedSales as $sale) {
            $response->assertJsonFragment(['created_at' => $sale->created_at]);
        }

        // Verifica se a venda inacabada não está presente na resposta JSON
        foreach ($unfinishedSale as $sale) {
            $response->assertJsonMissing(['id' => $sale->id]);
        }
    }

    public function testCanceledSale()
    {

       $canceledSale =  Sales::factory()
            ->state(['accomplished' => 'canceled'])
            ->create();

        $response = $this->put("/api/sales/canceled/{$canceledSale->id}");

        $response->assertStatus(200);

        // dd($canceledSale);
        // $this->assertDatabaseMissing('sales', ['id' => $canceledSale->id, 'accomplished' => 'canceled']);
    }
    }
