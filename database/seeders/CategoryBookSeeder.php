<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class CategoryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categoriesIDs = DB::table('categories')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('category_books')->insert([
            'category_id' => $faker->randomElement($categoriesIDs),
            'book_id' => $faker->randomElement($booksIDs),
            ]);
        }
    }
}
