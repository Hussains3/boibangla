<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
class SubCategoryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $bookIds= DB::table('books')->pluck('id');
        $subcateegoryIds= DB::table('sub_categories')->pluck('id');


        for ($i=0; $i < 40; $i++) {
            DB::table('sub_category_books')->insert([
                'sub_category_id' => $faker->randomElement($subcateegoryIds),
                'book_id' => $faker->randomElement($bookIds),
            ]);
        }
    }
}
