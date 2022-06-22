<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class LanguageBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $languagesIDs = DB::table('languages')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('language_books')->insert([
            'book_id' => $faker->randomElement($booksIDs),
            'language_id' => $faker->randomElement($languagesIDs),
            ]);
        }
    }
}
