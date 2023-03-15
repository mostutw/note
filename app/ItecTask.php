<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItecTask extends Model
{
    /**
     * 為模型選擇連線名稱。
     * 
     * @var string
     */

    protected $connection = 'sqlsrv';

    /**
     * 與模型關聯的資料表
     * 
     * @var string
     */

    protected $table = 'itec_task';

    /**
     * 定義日期欄位
     * 
     * @var array
     */

    protected $dates = [
        'taskend_day',
        'create_date',
        'update_date',
        'event_date',
    ];
    /**
     * 取消自動時間更新, 目的表格沒有 created_at updated_at
     */
    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'flow_stepid',
        'flow_stepname',
        'flow_BeSign',
        'flow_UnSign',
        'flow_UnSignForView',
    ];

    public function itec_user()
    {
        return $this->belongsTo('App\ItecUser');
    }

    public function itec_form_info()
    {
        return $this->belongsTo('App\ItecFormInfo');
    }
}
