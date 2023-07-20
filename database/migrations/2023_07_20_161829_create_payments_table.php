<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('customerNumber');
            $table->string('checkNumber',50);
            $table->date('paymentDate');
            $table->decimal('amount',10,2);
            // 特殊
            $table->primary(['customerNumber','checkNumber']);
            $table->foreign('customerNumber')->references('customerNumber')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
