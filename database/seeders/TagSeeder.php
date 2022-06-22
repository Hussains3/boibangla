<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $awardWining  = Tag::create(['tag' => 'পুরষ্কারজেী বই','slug' => 'award-wining']);
        $shushuKishor  = Tag::create(['tag' => 'শিশু-কিশোর','slug' => 'shishu-kishor']);
        $scienceFiction  = Tag::create(['tag' => 'সায়েন্স ফিকশন','slug' => 'sience-fiction']);
        $newCollection  = Tag::create(['tag' => 'নতুন কালেকশন','slug' => 'new-collection']);
        $bestSeller  = Tag::create(['tag' => 'বেস্টসেলার','slug' => 'best-seller']);
        $preOrder  = Tag::create(['tag' => 'পূর্বাদেশ','slug' => 'pree-ordeer']);
        $series  = Tag::create(['tag' => 'সিরিজ','slug' => 'siries']);
        $textBook  = Tag::create(['tag' => 'পাঠ্য বই','slug' => 'academic-book']);

        for ($i=0; $i < 20; $i++) {
           DB::table('tags')->insert([
               'tag' => $faker->word,
               'slug' => $faker->slug,
           ]);
        }
    }
}
