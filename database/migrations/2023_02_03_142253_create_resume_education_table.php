<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resumes_id')->references('id')->on('resumes');
            $table->string('school_level',2)->nullable();
            $table->string('school_name',100)->nullable();
            $table->string('school_department',100)->nullable();
            $table->string('school_status',1)->nullable();
            $table->string('school_startDate',10)->nullable();
            $table->string('school_endDate',10)->nullable();
            $table->string('school_thesisTopic',100)->nullable();
            $table->string('school_sort',2)->default('0');
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
        Schema::dropIfExists('resume_education');
    }
}
