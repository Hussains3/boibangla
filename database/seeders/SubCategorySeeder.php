<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categoryIds= DB::table('categories')->pluck('id');


        for ($i=0; $i < 40; $i++) {
            DB::table('sub_categories')->insert([
                'category_id' => $faker->randomElement($categoryIds),
                'subcategory' => $faker->word,
                'slug' => $faker->slug,
                'description'=> $faker->text($maxNbChars = 100),
            ]);
        }
    }
}
