<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $authorsIDs = DB::table('authors')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('author_books')->insert([
            'author_id' => $faker->randomElement($authorsIDs),
            'book_id' => $faker->randomElement($booksIDs),
            ]);
        }
    }
}
