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
}
