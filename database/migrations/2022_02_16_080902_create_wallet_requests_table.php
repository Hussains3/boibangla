<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('request_id',100);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('mobile');
            $table->unsignedDecimal('amount',8,2);
            $table->string('txn_id');
            $table->string('payment_method');
            $table->unsignedTinyInteger('status')->default(1)->comment("1->Pending,2->Approved,3->Archived");
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
        Schema::dropIfExists('wallet_requests');
    }
}
