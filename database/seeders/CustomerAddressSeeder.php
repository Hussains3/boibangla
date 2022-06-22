<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $customersIDs = DB::table('users')->pluck('id');
        $addressesIDs= DB::table('addresses')->pluck('id');


        foreach (range(1,50) as $index) {
            DB::table('customer_addresses')->insert([
            'user_id' => $faker->randomElement($customersIDs),
            'address_id' => $faker->randomElement($addressesIDs),
            ]);
        }
    }
}
