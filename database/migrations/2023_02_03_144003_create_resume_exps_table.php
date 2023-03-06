<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_exps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resumes_id')->references('id')->on('resumes');
            $table->string('exp_companyName',100)->nullable();
            $table->string('exp_companyDepartment',100)->nullable();
            $table->string('exp_jobTitle',100)->nullable();
            $table->string('exp_workPlace',100)->nullable();
            $table->date('exp_startDate')->nullable();
            $table->date('exp_endDate')->nullable();
            $table->text('exp_content')->nullable();
            $table->string('exp_leaveReason',255)->nullable();
            $table->string('exp_sort',2)->default('0');
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
        Schema::dropIfExists('resume_exps');
    }
}
