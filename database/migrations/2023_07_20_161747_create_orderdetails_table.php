<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->integer('orderNumber');
            $table->string('productCode',15)->index();
            $table->integer('quantityOrdered');
            $table->decimal('priceEach',10,2);
            $table->smallInteger('orderLineNumber');
            // 特殊
            $table->primary(['orderNumber','productCode']);
            $table->foreign('orderNumber')->references('orderNumber')->on('orders');
            $table->foreign('productCode')->references('productCode')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdetails');
    }
}
