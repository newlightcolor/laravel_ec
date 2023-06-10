<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $shops = [
            [
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        DB::table('shops')->insert($shops);
    }
}
