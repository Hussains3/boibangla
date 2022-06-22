<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affiliation;
class AffiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliation = Affiliation::create([
            'user_id' => 4,
            'affiliate_id' => uniqid(),
            'status' => 2,
            'rank' => 1
        ]);


    }
}
