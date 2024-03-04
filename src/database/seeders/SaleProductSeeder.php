<?php

namespace Database\Seeders;

use App\Models\SaleProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleProduct::factory()->count(20)->create();
    }
}
