<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('orderNumber')->index();
            $table->datetime('orderDate');
            $table->date('requiredDate');
            $table->date('shippedDate')->nullable();
            $table->integer('status');
            $table->text('comments');
            $table->integer('customerNumber');
            // 特殊
            $table->primary('orderNumber');
            $table->foreign('orderNumber')->references('customerNumber')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
