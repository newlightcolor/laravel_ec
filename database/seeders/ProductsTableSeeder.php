<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $products = [
            [
                'product_name' => 'productA',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'product_name' => 'productB',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'product_name' => 'productC',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
        ];

        DB::table('products')->insert($products);
    }
}
