<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeEducation extends Model
{
    /**
     * table name
     * 
     * @var string
     */
    protected $table = 'resume_education';

    /**
     * 不可被批量賦值的屬性。
     *
     * @var array
     */
    protected $guarded = [];

}
