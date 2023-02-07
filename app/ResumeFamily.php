<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeFamily extends Model
{
    /**
     * table name
     * 
     * @var string
     */
    protected $table = 'resume_families';

    /**
     * 不可被批量賦值的屬性。
     *
     * @var array
     */
    protected $guarded = [];
}
