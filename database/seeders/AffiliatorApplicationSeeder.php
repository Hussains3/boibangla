<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class AffiliatorApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userID = User::all()->pluck('id');
        $faker = Faker\Factory::create();


        for ($i=0; $i < count($userID); $i++) {
            DB::table('affiliator_applications')->insert([
                'user_id' => $faker->randomElement($userID)
            ]);
        }
    }
}
