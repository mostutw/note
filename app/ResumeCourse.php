<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeCourse extends Model
{
    /**
     * table name
     * 
     * @var string
     */
    protected $table = 'resume_courses';

    /**
     * 不可被批量賦值的屬性。
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 設定日期格式
     */

     protected $casts = [
        'course_startDate'  => 'date:Y-m',
        'course_endDate' => 'date:Y-m',
    ];
}
