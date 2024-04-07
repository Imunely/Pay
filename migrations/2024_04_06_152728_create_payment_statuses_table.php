<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * 
         * 0 - waiting
         * 1 - dispute
         * 2 - disputed
         * 3 - chaneled
         * 4 - errored
         * 5 - paid
         * 
         */
        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('waiting');
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
        Schema::dropIfExists('payment_statuses');
    }
}
