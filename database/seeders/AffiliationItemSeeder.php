<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AffiliationItem;

class AffiliationItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliationItem = AffiliationItem::create([
            'user_id' => 4,
            'affiliation_id' => 1,
            'book_id' => 1,
            'customer_id' => 5
        ]);

    }
}
