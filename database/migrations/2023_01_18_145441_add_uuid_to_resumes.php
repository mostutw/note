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
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('lock')->nullable()->default('0');
            $table->string('interview_department')->nullable();
            $table->string('interview_jobTitle')->nullable();
            $table->string('interview_workDate')->nullable();
            $table->string('interview_salary')->nullable();
            $table->string('interview_lowSalary')->nullable();
            $table->string('interview_applyDate')->nullable();
            $table->string('info_chineseName')->nullable();
            $table->string('info_englishName')->nullable();
            $table->string('info_sex')->nullable();
            $table->string('info_marry')->nullable();
            $table->string('info_id')->nullable();;
            $table->string('info_birthday')->nullable();;
            $table->string('info_birthplace')->nullable();;
            $table->string('info_height')->nullable();;
            $table->string('info_weight')->nullable();;
            $table->string('info_blood')->nullable();;
            $table->string('info_colorPerception')->nullable();
            $table->string('info_visionLeft')->nullable();
            $table->string('info_visionRight')->nullable();
            $table->string('info_disability')->nullable();
            $table->string('info_disabilityType')->nullable();
            $table->string('info_disabilityLevel')->nullable();
            $table->string('info_military')->nullable();
            $table->string('info_militaryDate')->nullable();
            $table->string('info_militaryReason')->nullable();
            $table->string('info_email')->nullable();
            $table->string('info_phone')->nullable();
            $table->string('info_address')->nullable();
            $table->string('info_telephone')->nullable();
            $table->string('info_address_2')->nullable();
            $table->string('info_telephone_2')->nullable();
            $table->string('feature_strength')->nullable();
            $table->string('feature_weakness')->nullable();
            $table->string('feature_englishLevel')->nullable();
            $table->string('feature_taiwaneseHokkienLevel')->nullable();
            $table->string('feature_license')->nullable();
            $table->string('feature_skill')->nullable();
            $table->string('family_emergencyContactName')->nullable();
            $table->string('family_emergencyContactPhone')->nullable();
            $table->string('family_emergencyContactRelation')->nullable();
            $table->string('recommend_name')->nullable();
            $table->string('recommend_phone')->nullable();
            $table->string('recommend_relation')->nullable();
            $table->string('recommend_name_2')->nullable();
            $table->string('recommend_phone_2')->nullable();
            $table->string('recommend_relation_2')->nullable();
            $table->string('other_pregnancy')->nullable();
            $table->string('other_hospitalized')->nullable();
            $table->string('other_hospitalizedReson')->nullable();
            $table->string('other_law')->nullable();
            $table->string('other_lawReson')->nullable();
            $table->string('other_infoSource')->nullable();
            $table->string('other_infoSourceMemo')->nullable();
            $table->string('other_workOvertime')->nullable();
            $table->string('other_workOvertimeMemo')->nullable();
            $table->string('other_workOvertimeHoliday')->nullable();
            $table->string('other_workOvertimeHolidayMemo')->nullable();
            $table->string('other_future')->nullable();
            $table->json('education');
            $table->json('exp');
            $table->json('family');
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
            $table->dropColumn('family');
            $table->dropColumn('exp');
            $table->dropColumn('education');
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