<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resumes_id')->references('id')->on('resumes');
            $table->string('family_title',100)->nullable();
            $table->string('family_name',100)->nullable();
            $table->tinyInteger('family_age')->nullable()->unsigned();
            $table->string('family_job',100)->nullable();
            $table->string('family_sort',2)->default('0');
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
        Schema::dropIfExists('resume_families');
    }
}
