<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // \App\Models\User::factory(10)->create();
         $this->call([UserSeeder::class]);
        //  $this->call([NewsletterSeeder::class]);
        //  $this->call([PublicationSeeder::class]);
        //  $this->call([CategorySeeder::class]);
        //  $this->call([DiscountSeeder::class]);
        //  $this->call([AuthorSeeder::class]);
        //  $this->call([BookSeeder::class]);
        //  $this->call([SubCategorySeeder::class]);
        //  $this->call([SubCategoryBookSeeder::class]);
         $this->call([CountrySeeder::class]);
        //  $this->call([RecentTransactionSeeder::class]);
        //  $this->call([ShurjoPayPaymentSeeder::class]);
        //  $this->call([ComposeNewsLetterSeeder::class]);
        //  $this->call([MediaSeeder::class]);
        //  $this->call([ProcessLogSeeder::class]);
        //  $this->call([QuerySeeder::class]);
         $this->call([SettingSeeder::class]);
        //  $this->call([StorySeeder::class]);
        //  $this->call([TagSeeder::class]);
        //  $this->call([WalletRequestSeeder::class]);
        //  $this->call([AddressSeeder::class]);
         $this->call([LanguageSeeder::class]);
        //  $this->call([LanguageBookSeeder::class]);
        //  $this->call([CountryBookSeeder::class]);
        //  $this->call([CustomerAddressSeeder::class]);
        //  $this->call([PublicationBookSeeder::class]);
        //  $this->call([CategoryBookSeeder::class]);
        //  $this->call([AuthorBookSeeder::class]);

        //  $this->call([OrderSeeder::class]);
        //  $this->call([OrderProcessingSeeder::class]);
        //  $this->call([OrderBookSeeder::class]);
        //  $this->call([ReviewSeeder::class]);
        //  $this->call([BookTagSeeder::class]);





         $this->call([AffiliationSeeder::class]);
        //  $this->call([AffiliationItemSeeder::class]);
        //  $this->call([AffiliationLinkSeeder::class]);
        //  $this->call([AffiliatorApplicationSeeder::class]);
    }
}
