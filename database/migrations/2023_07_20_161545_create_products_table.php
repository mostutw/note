<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('productCode',15);
            $table->string('productName',70);
            $table->string('productLine',50)->index();
            $table->string('productScale',10);
            $table->string('productVendor',50);
            $table->text('productDescription');
            $table->smallinteger('quantityInStock');
            $table->decimal('buyPrice',10,2);
            $table->decimal('MSRP',10,2);
            // 特殊
            $table->primary('productCode');
            $table->foreign('productLine')->references('productLine')->on('productlines');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
