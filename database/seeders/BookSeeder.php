<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        for ($i=0; $i < 100; $i++) {
            $regularPrice = $faker->randomNumber(3,true);
            $salePrice = $regularPrice - 50;
            DB::table('books')->insert([
                'book_name'=> $faker->name,
                'book_slug'=> $faker->slug,
                'sku'=> $faker->swiftBicNumber,
                'isbn'=> $faker->creditCardNumber,
                'edition'=> $faker->randomElement([1,2,3,4,5,6,7]).' th, '.$faker->year($max = 'now'),
                'number_of_pages'=> $faker->randomNumber(3,true),
                'regular_price'=> $regularPrice,
                'sale_price'=> $salePrice,
                'stock'=> $faker->randomNumber(4,true),
                'unit'=> 'Pcs',
                'book_image'=> 'asset/images/book/dummy/image.jpg',
                'book_image_1'=> 'asset/images/book/dummy/image_1.jpg',
                'book_image_2'=> 'asset/images/book/dummy/image_2.jpg',
                'book_image_3'=> 'asset/images/book/dummy/image_3.jpg',
                'description'=> $faker->text($maxNbChars = 100),
                'additional_info'=> $faker->text($maxNbChars = 100),
                'average_rating'=> 5.00,
                'total_reviews'=>  $faker->randomNumber(3,true),
                'book_display'=> $faker->randomElement(['1','2']),
                'status'=> 1,
            ]);

        }
    }
}


