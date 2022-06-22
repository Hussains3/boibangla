<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {

            DB::table('publications')->insert([
                'name'=> $faker->name,
                'slug' => $faker->slug,
                'logo' => 'asset/images/publisher/dummy/logo.jpg',
                'description' => $faker->text($maxNbChars = 100),
                'status'=> 1,
            ]);

        }
    }
}
