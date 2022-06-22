<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class PublicationBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $publishersIDs = DB::table('publications')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('publication_books')->insert([
                'book_id' => $faker->randomElement($booksIDs),
                'publication_id' => $faker->randomElement($publishersIDs),
            ]);
        }
    }
}
