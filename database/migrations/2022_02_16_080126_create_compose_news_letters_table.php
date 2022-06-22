<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposeNewsLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compose_news_letters', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('link');
            $table->date('scheduled_at');
            $table->unsignedTinyInteger('composed')->default(1)->comment('1=>No,2=>Yes');
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
        Schema::dropIfExists('compose_news_letters');
    }
}
