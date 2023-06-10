<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class FormSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $form_settings = [
            [
                'shop_id' => DB::table('shops')->orderBy('id')->first()->id,
                'form_name' => 'order',
                'option_display_count' => 5,
                'min_delivery_date_offset' => 3,
                'countries_shift_min_delivery_date_offset' => 'a:2:{s:9:"北海道";i:2;s:9:"沖縄県";i:3;}',
                'shift_min_delivery_date_offset_after_3pm' => 1,
                'saturday_delivery_disabled' => 1,
                'sunday_delivery_disabled' => 1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        DB::table('form_settings')->insert($form_settings);
    }
}
