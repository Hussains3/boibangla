<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class BookTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $tagsIDs = DB::table('tags')->pluck('id');
        $booksIDs= DB::table('books')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('book_tags')->insert([
            'tag_ids' => $faker->randomElement($tagsIDs),
            'book_id' => $faker->randomElement($booksIDs),
            ]);
        }
    }
}
