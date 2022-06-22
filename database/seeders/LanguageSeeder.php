<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $languages = ['English','Mandarin','Hindi','Spanish','French','Standard Arabic','Bengali','Russian','Portuguese','Indonesian'];
        DB::table('languages')->insert([
            ['name'=> 'English', 'code' => 'en'],
            ['name'=> 'Mandarin', 'code' => 'mn'],
            ['name'=> 'Hindi', 'code' => 'hi'],
            ['name'=> 'Spanish', 'code' => 'spn'],
            ['name'=> 'French', 'code' => 'fr'],
            ['name'=> 'Standard Arabic', 'code' => 'ar'],
            ['name'=> 'Bengali', 'code' => 'bn'],
            ['name'=> 'Russian', 'code' => 'ru'],
            ['name'=> 'Portuguese', 'code' => 'por'],
            ['name'=> 'Indonesian', 'code' => 'ind'],
        ]);
    }
}








