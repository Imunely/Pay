<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('payment_system_id');
            $table->string('name')->unique();
            $table->string('system_name');
            $table->boolean('status')->default(false);
            $table->unsignedDecimal('system_commission')->default(1.00);
            $table->unsignedDecimal('merchant_commission')->default(1.00);
            $table->unsignedMediumInteger('currency_id');
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
        Schema::dropIfExists('payment_gateways');
    }
}
