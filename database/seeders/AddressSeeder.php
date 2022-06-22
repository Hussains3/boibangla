<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
class AddressSeeder extends Seeder
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

        for ($i=0; $i < 1; $i++) {
           DB::table('addresses')->insert([
               'user_id' => 5,
               'first_name' => $faker->firstName,
               'last_name' => $faker->lastName,
               'email' => $faker->email,
               'contact' => $faker->phoneNumber,
               'country' => $faker->randomElement($countriesIDs),
               'street_address' => $faker->streetAddress,
               'state' => $faker->state,
               'town_city' => $faker->city,
               'postal_code' => $faker->postcode,
               'address_type'=>$faker->randomElement([1,2,3]),
           ]);
        }
    }
}
