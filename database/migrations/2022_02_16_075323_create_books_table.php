<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_slug');
            $table->string('sku',100)->nullable();
            $table->string('isbn',100)->nullable();
            $table->string('edition')->nullable();
            $table->string('editor')->nullable();
            $table->integer('number_of_pages')->nullable();
            $table->unsignedDecimal('regular_price',8,2);
            $table->unsignedDecimal('sale_price',8,2)->nullable();
            $table->integer('discount')->nullable();
            $table->integer('stock')->comment('Stock quantity');
            $table->string('unit',100)->comment('pcs,kgs etc..')->nullable();
            $table->string('book_image')->nullable();
            $table->string('book_image_1')->nullable();
            $table->string('book_image_2')->nullable();
            $table->string('book_image_3')->nullable();
            $table->string('book_image_4')->nullable();
            $table->string('book_image_5')->nullable();
            $table->string('book_display',100)->comment('1=>New Arrival,2=>Featured')->nullable();
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->text('additional_info')->nullable();
            $table->unsignedDecimal('average_rating',3,2)->default(0);
            $table->unsignedInteger('total_reviews')->default(0);
            $table->string('quality')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active,2=>Inactive');
            $table->unsignedTinyInteger('affiliation_status')->default(1)->comment('1=>Yes,2=>No');
            $table->timestamps();
        });
    }
    // affiliation status (1=>yes,2=>no)

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
