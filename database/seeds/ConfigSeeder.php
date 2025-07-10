<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_flag')->insert([
            [
                'flag_type' => 'Shipping',
                'flag_value' => '0.25',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'flag_additionalText' => 'Shipping',
                'has_image' => 0,
                'is_active' => 1,
                'is_config' => 1,
                'is_number' => 1,
                'flag_show_text' => 'Shipping',
                'is_featured' => 0,
                'is_deleted' => 0,
                'user_id' => 0,
            ],
            [
                'flag_type' => 'Profit Margin',
                'flag_value' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'flag_additionalText' => 'Profit Margin',
                'has_image' => 0,
                'is_active' => 1,
                'is_config' => 1,
                'is_number' => 1,
                'flag_show_text' => 'Profit Margin',
                'is_featured' => 0,
                'is_deleted' => 0,
                'user_id' => 0,
            ],
            [
                'flag_type' => 'Stripe Fee',
                'flag_value' => '0.03',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'flag_additionalText' => 'Stripe Fee',
                'has_image' => 0,
                'is_active' => 1,
                'is_config' => 1,
                'is_number' => 1,
                'flag_show_text' => 'Stripe Fee',
                'is_featured' => 0,
                'is_deleted' => 0,
                'user_id' => 0,
            ],
        ]);
    }
}
