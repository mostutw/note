<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('customerNumber');
            $table->string('customerName',50);
            $table->string('contactLastName',50);
            $table->string('contactFirstName',50);
            $table->string('phone',50);
            $table->string('addressLine1',50);
            $table->string('addressLine2',50)->nullable();
            $table->string('city',50);
            $table->string('state',50)->nullable();
            $table->string('postalCode',15)->nullable();
            $table->string('country',50);
            $table->integer('salesRepEmployeeNumber')->nullable()->references('employeeNumber')->on('employees');
            $table->decimal('creditLimit', 10, 2)->nullable();
            // 特殊
            $table->primary('customerNumber');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
