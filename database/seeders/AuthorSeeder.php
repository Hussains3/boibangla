<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 20; $i++) {

            DB::table('authors')->insert([
                'name'=> $faker->name,
                'slug'=> $faker->slug,
                'photo'=> 'https://i.pravatar.cc/300',
                'description'=> $faker->text($maxNbChars = 100),
                'status'=> 1,
            ]);

        }
    }
}
