<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('employeeNumber');
            $table->string('lastName',50);
            $table->string('firstName',50);
            $table->string('extension',10);
            $table->string('email',100);
            $table->string('officeCode',10)->index();
            $table->integer('reportsTo')->nullable()->index();
            $table->string('jobTitle',50);
            // 特殊
            $table->primary('employeeNumber');
            $table->foreign('officeCode')->references('officeCode')->on('offices');
            $table->foreign('reportsTo')->references('employeeNumber')->on('employees');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
