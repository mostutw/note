<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeExp extends Model
{
    /**
     * table name
     * 
     * @var string
     */
    protected $table = 'resume_exps';

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
        'exp_startDate'  => 'date:Y-m',
        'exp_endDate' => 'date:Y-m',
    ];

}
