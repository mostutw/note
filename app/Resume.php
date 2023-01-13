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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
        'status',
    ];

    /**
     * 取得擁有該紀錄的使用者。
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
