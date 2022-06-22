<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name');
            $table->string('discount');
            $table->string('description');
            $table->text('categories')->nullable()->comment('category ids on which coupon code is can be applied');
            $table->dateTime('start_date');
            $table->dateTime('validity_date');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active,2=>Inactive');
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
        Schema::dropIfExists('discounts');
    }
}
