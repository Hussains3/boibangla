<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $customers = User::all();

        foreach ($customers as $customer) {
                # code...
            DB::table('newsletters')->insert([
                'email'=> $customer->email,
                'status'=> 1 ,
            ]);

        }

    }
}
