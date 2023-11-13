<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['user_id' => 1, 'title' => 'Product 1', 'price' => 10],
            ['user_id' => 1, 'title' => 'Product 2', 'price' => 15],
            ['user_id' => 1, 'title' => 'Product 3', 'price' => 8],
            ['user_id' => 1, 'title' => 'Product 4', 'price' => 7],
            ['user_id' => 1, 'title' => 'Product 5', 'price' => 20],
        ];

        DB::table('products')->insert($products);
    }
}
