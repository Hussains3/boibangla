<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('category_slug');
            $table->integer('discount')->default(0);
            $table->text('description')->nullable();
            $table->string('icon_class')->nullable()->comment('Font awesom icon class');
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Active,2=>Inactive,3=>Deleted');
            $table->unsignedTinyInteger('navigation')->default(1)->comment("1=>Show in navigation menu,2=>Don't show");
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
        Schema::dropIfExists('categories');
    }
}
