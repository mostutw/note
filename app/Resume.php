<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    /**
     * table name
     * 
     * @var string
     */
    protected $table = 'resumes';

    /**
     * 不可被批量賦值的屬性。
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * 取得擁有該紀錄的使用者。
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
