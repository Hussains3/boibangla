<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AffiliationLink;
class AffiliationLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affiliationLink = AffiliationLink::create([
            'user_id' => 4,
            'link' => 'http://127.0.0.1:8000/books/show/pariatur-eius-quidem-aliquid-nihil-distinctio?affiliate_id=0124521452',
            'book_id' => 7,
        ]);
    }
}
