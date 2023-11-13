<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGroupItems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['group_id' => 1, 'product_id' => 2],
            ['group_id' => 1, 'product_id' => 5],
        ];

        DB::table('product_group_items')->insert($items);
    }
}
