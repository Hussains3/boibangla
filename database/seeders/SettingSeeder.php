<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'setting_name' => 'delivery_charge',
                'setting_value' => 50,
            ],
            [
                'setting_name' => 'affiliation_rate',
                'setting_value' => 5,
            ],
            [
                'setting_name' => 'global_discount',
                'setting_value' => 0,
            ],
            [
                'setting_name' => 'offer_text',
                'setting_value' => 'Free Ground Shipping Over $250',
            ],
            [
                'setting_name' => 'cash_on_delivery',
                'setting_value' => 'Yes', // Yes=> Enabled, No => Disabled
            ],
            [
                'setting_name' => 'website_logo',
                'setting_value' => null,
            ],
            [
                'offer_text' => 'popup',
                'setting_value' => '{"title":"Subscribe2 Newsletter And Get 25% Discount!2","link":"http:\/\/localhost\/projects\/shopzen-v2\/","popup_image":"1619259382-popup_img3.jpg","description":"Subscribe to the newsletter to receive updates about new products."}',
            ],
            [
                'offer_text' => 'seo',
                'setting_value' => '{"meta_description":"Boi Bangla -Buy  book online- Trusted online books shop in Bangladesh"}',
            ],
        ]);
    }
}
