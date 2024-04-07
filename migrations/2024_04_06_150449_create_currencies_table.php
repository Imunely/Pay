<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // en version 
            $table->string('symbol')->unique();
            $table->string('flag');
            $table->unsignedDecimal('to_usd', 10, 8);
            $table->decimal('min_pay', 14)->default(0.00);
            $table->decimal('max_pay', 14)->default(0.00);
            $table->decimal('min_out', 14)->default(0.00);
            $table->decimal('max_out', 14)->default(0.00);
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
        Schema::dropIfExists('currencies');
    }
}
