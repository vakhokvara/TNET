<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProductGroups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = [
            ['user_id' => 1, 'discount' => 15]
        ];

        DB::table('user_product_groups')->insert($group);
    }
}
