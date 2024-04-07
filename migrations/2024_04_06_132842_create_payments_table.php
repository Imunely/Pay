<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Imynely\Pay\PaymentStatus;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('gateway_id');
            $table->unsignedBigInteger('penalty_id')->nullable();
            $table->string('external_id', 255)->nullable();
            $table->unsignedDecimal('amount', 14);
            $table->unsignedDecimal('real_amount', 14)->nullable();
            $table->unsignedDecimal('paid_amount', 14)->nullable();
            $table->tinyInteger('status_id')->default(PaymentStatus::WAITING);
            $table->string('wallet', 255)->nullable();
            $table->string('url', 500)->nullable();
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
        Schema::dropIfExists('payment');
    }
}
