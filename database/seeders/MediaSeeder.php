<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i=0; $i < 20; $i++) {
            DB::table('media')->insert([
                'file'=> 'other_image'.$i.'.png',
                'type'=> 1,
                'status' => 1,
            ]);
        }
    }
}
