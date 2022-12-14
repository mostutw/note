<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintain extends Model
{
    /**
     * table name
     *
     * @var string
     */
    protected $table = 'maintains';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * 取得擁有該紀錄的使用者。
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * 設定日期格式
     */

    protected $casts = [
        'start_date'  => 'date:m/d/y',
        'end_date' => 'date:m/d/y',
    ];

}
