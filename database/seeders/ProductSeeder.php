<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
        {
            \App\Models\Product::factory(5)->create();
        }

}