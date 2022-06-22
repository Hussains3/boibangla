<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShurjoPayPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shurjo_pay_payments', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('msg')->nullable();
            $table->string('tx_id')->nullable();
            $table->string('bank_tx_id')->nullable();
            $table->integer('amount')->nullable();
            $table->string('bank_status')->nullable();
            $table->mediumInteger('sp_code')->nullable();
            $table->string('sp_code_des')->nullable();
            $table->string('sp_payment_option')->nullable();
            $table->string('custom1')->comment('user_name')->nullable();
            $table->string('custom2')->nullable();
            $table->string('custom3')->nullable();
            $table->string('custom4')->nullable();
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
        Schema::dropIfExists('shurjo_pay_payments');
    }
}
