<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpSalaryToResumeExps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume_exps', function (Blueprint $table) {
            $table->integer('exp_salary')->nullable()->unsigned()->after('exp_workPlace');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resume_exps', function (Blueprint $table) {
            $table->dropColumn('exp_salary');
        });
    }
}
