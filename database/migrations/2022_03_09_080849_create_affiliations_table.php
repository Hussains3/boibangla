<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('affiliate_id', 25)->unique();
            $table->unsignedBigInteger('reffered_by')->nullable();
            $table->foreign('reffered_by')->references('id')->on('users');
            $table->tinyInteger('status')->default(1)->comment('1=>Pending,2=>Active,3=>Inactive');
            $table->string('payee_name')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('pan')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->decimal('total_earning', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->integer('rate')->nullable();
            $table->tinyInteger('rank')->default(0)->comment('0=>Beginner,1=>Silver,2=>Gold,3=>Dimond');

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
        Schema::dropIfExists('affiliations');
    }
}
