<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuidToResumes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('name',100)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('lock',1)->nullable()->default('0');
            $table->string('interview_department',100)->nullable();
            $table->string('interview_jobTitle',100)->nullable();
            $table->date('interview_workDate')->nullable();
            $table->integer('interview_salary')->nullable()->unsigned();
            $table->integer('interview_lowSalary')->nullable()->unsigned();
            $table->dateTime('interview_applyDate')->nullable();
            $table->string('info_chineseName',100)->nullable();
            $table->string('info_englishName',100)->nullable();
            $table->string('info_sex',1)->nullable();
            $table->string('info_marry',1)->nullable();
            $table->string('info_id',10)->nullable();
            $table->date('info_birthday')->nullable();
            $table->string('info_birthplace',100)->nullable();
            $table->tinyInteger('info_height')->nullable()->unsigned();
            $table->tinyInteger('info_weight')->nullable()->unsigned();
            $table->string('info_blood',2)->nullable();
            $table->string('info_colorPerception',1)->nullable();
            $table->string('info_visionLeft',3)->nullable();
            $table->string('info_visionRight',3)->nullable();
            $table->string('info_disability',2)->nullable();
            $table->string('info_disabilityType',100)->nullable();
            $table->string('info_disabilityLevel',100)->nullable();
            $table->string('info_military',1)->nullable();
            $table->date('info_militaryDate')->nullable();
            $table->string('info_militaryReason',255)->nullable();
            $table->string('info_email',255)->nullable();
            $table->string('info_phone',15)->nullable();
            $table->string('info_address',255)->nullable();
            $table->string('info_telephone',15)->nullable();
            $table->string('info_address_2',255)->nullable();
            $table->string('info_telephone_2',15)->nullable();
            $table->string('feature_strength',255)->nullable();
            $table->string('feature_weakness',255)->nullable();
            $table->string('feature_englishLevel',1)->nullable();
            $table->string('feature_taiwaneseHokkienLevel',1)->nullable();
            $table->text('feature_license')->nullable();
            $table->text('feature_skill')->nullable();
            $table->string('family_emergencyContactName',100)->nullable();
            $table->string('family_emergencyContactPhone',15)->nullable();
            $table->string('family_emergencyContactRelation',100)->nullable();
            $table->string('recommend_name',100)->nullable();
            $table->string('recommend_phone',15)->nullable();
            $table->string('recommend_relation',100)->nullable();
            $table->string('recommend_name_2',100)->nullable();
            $table->string('recommend_phone_2',15)->nullable();
            $table->string('recommend_relation_2',100)->nullable();
            $table->string('other_pregnancy',1)->nullable();
            $table->string('other_hospitalized',1)->nullable();
            $table->string('other_hospitalizedReason',255)->nullable();
            $table->string('other_law',1)->nullable();
            $table->string('other_lawReason',255)->nullable();
            $table->string('other_infoSource',1)->nullable();
            $table->string('other_infoSourceMemo',255)->nullable();
            $table->string('other_workOvertime',1)->nullable();
            $table->string('other_workOvertimeMemo',255)->nullable();
            $table->string('other_workOvertimeHoliday',1)->nullable();
            $table->string('other_workOvertimeHolidayMemo',255)->nullable();
            $table->text('other_future')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropColumn('other_future');
            $table->dropColumn('other_workOvertimeHolidayMemo');
            $table->dropColumn('other_workOvertimeHoliday');
            $table->dropColumn('other_workOvertimeMemo');
            $table->dropColumn('other_workOvertime');
            $table->dropColumn('other_infoSourceMemo');
            $table->dropColumn('other_infoSource');
            $table->dropColumn('other_lawReson');
            $table->dropColumn('other_law');
            $table->dropColumn('other_hospitalizedReson');
            $table->dropColumn('other_hospitalized');
            $table->dropColumn('other_pregnancy');
            $table->dropColumn('recommend_relation_2');
            $table->dropColumn('recommend_phone_2');
            $table->dropColumn('recommend_name_2');
            $table->dropColumn('recommend_relation');
            $table->dropColumn('recommend_phone');
            $table->dropColumn('recommend_name');
            $table->dropColumn('family_emergencyContactRelation');
            $table->dropColumn('family_emergencyContactPhone');
            $table->dropColumn('family_emergencyContactName');
            $table->dropColumn('feature_skill');
            $table->dropColumn('feature_license');
            $table->dropColumn('feature_taiwaneseHokkienLevel');
            $table->dropColumn('feature_englishLevel');
            $table->dropColumn('feature_weakness');
            $table->dropColumn('feature_strength');
            $table->dropColumn('info_telephone_2');
            $table->dropColumn('info_address_2');
            $table->dropColumn('info_telephone');
            $table->dropColumn('info_address');
            $table->dropColumn('info_phone');
            $table->dropColumn('info_email');
            $table->dropColumn('info_militaryReason');
            $table->dropColumn('info_militaryDate');
            $table->dropColumn('info_military');
            $table->dropColumn('info_disabilityLevel');
            $table->dropColumn('info_disabilityType');
            $table->dropColumn('info_disability');
            $table->dropColumn('info_visionRight');
            $table->dropColumn('info_visionLeft');
            $table->dropColumn('info_colorPerception');
            $table->dropColumn('info_blood');
            $table->dropColumn('info_weight');
            $table->dropColumn('info_height');
            $table->dropColumn('info_birthplace');
            $table->dropColumn('info_birthday');
            $table->dropColumn('info_id');
            $table->dropColumn('info_marry');
            $table->dropColumn('info_sex');
            $table->dropColumn('info_englishName');
            $table->dropColumn('info_chineseName');
            $table->dropColumn('interview_applyDate');
            $table->dropColumn('interview_lowSalary');
            $table->dropColumn('interview_salary');
            $table->dropColumn('interview_workDate');
            $table->dropColumn('interview_jobTitle');
            $table->dropColumn('interview_department');
            $table->dropColumn('lock');
            $table->dropColumn('phone');
            $table->dropColumn('name');
            $table->dropColumn('uuid');
        });
    }
}