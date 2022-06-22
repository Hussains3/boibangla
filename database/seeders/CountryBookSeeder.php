<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class CountryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $countriesIDs = DB::table('countries')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('country_books')->insert([
            'book_id' => $faker->randomElement($booksIDs),
            'country_id' => $faker->randomElement($countriesIDs),
            ]);
        }
    }
}
