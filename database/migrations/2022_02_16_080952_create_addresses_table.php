<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',100);
            $table->string('contact',100);
            $table->tinyInteger('country')->nullable();
            $table->string('street_address');
            $table->string('state',100);
            $table->string('town_city',100);
            $table->string('postal_code',100)->nullable();
            $table->unsignedTinyInteger('address_type')->default(1)->comment('1=>Home,2=>Office,3=>Others');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
