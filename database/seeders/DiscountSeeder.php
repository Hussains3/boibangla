<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $catids = DB::table('categories')->pluck('id');
        for ($i=0; $i < 5; $i++) {

            DB::table('discounts')->insert([
                'coupon_name'=> $faker->unique()->word,
                'discount'=> 1,
                'description'=> $faker->text($maxNbChars = 100),
                'categories'=> $faker->randomElement($catids),
                'start_date'=> $faker->dateTime($max = 'now', $timezone = null),
                'validity_date'=> $faker->dateTime($max = '2023-04-25 08:37:17', $timezone = null),
                'status'=> 1,
            ]);

        }
    }
}
