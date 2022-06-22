<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
class RecentTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $userIDs = DB::table('users')->pluck('id');

        for ($i=0; $i < 20; $i++) {
            DB::table('recent_transactions')->insert([
                'user_id' => $faker->randomElement($userIDs),
                'amount' => $faker->randomNumber(3,true),
                'status' => $faker->randomElement([1,2]),
            ]);
        }
    }
}
