<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testListAvailableProducts()
    {
        // Criar alguns produtos para testar
        $products = [
            [
                'name' => 'Product 1',
                'price' => 100.00,
                'description' => 'Description 1',
            ],
            [
                'name' => 'Product 2',
                'price' => 200.00,
                'description' => 'Description 2',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $response = $this->get('/api/products');

        // Verificar se a resposta é bem-sucedida
        $response->assertStatus(200);

        //Verificar se o primeiro produto está presente na resposta JSON
        $response->assertJsonFragment([
            'id' => 1,
            'name' => 'Product 1',
            'price' => 100.00,
            'description' => 'Description 1',
        ]);
    }
}
