<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resumes_id')->references('id')->on('resumes');
            $table->string('course_name',100)->nullable();
            $table->string('course_department',100)->nullable();
            $table->date('course_startDate')->nullable();
            $table->date('course_endDate')->nullable();
            $table->string('course_sort',2)->default('0');
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
        Schema::dropIfExists('resume_courses');
    }
}
