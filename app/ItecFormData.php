<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItecFormData extends Model
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

    protected $table = 'itec_formdata';

    public function itec_form_info()
    {
        return $this->belongsTo('App\ItecFormInfo');
    }

    /**
     * 取得該模型路由的自定義鍵名(預設為 id)。
     * 
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'task_id';
    }

    /**
     * 取得該單據的表單資訊
     */
    public function form_info()
    {
        // Model, foreign key, local key
        return $this->hasOne('App\ItecFormInfo', 'id', 'form_id');
    }

    /**
     * 取得該表單對應的使用者
     * ex: class, 
     */
    public function user()
    {
        return $this->belongsTo('App\ItecUser', 'user_id', 'id');
    }

     /**
     * 設定日期格式
     */
    protected $casts = [
        'create_date'  => 'date:Y-m-d H:i:s',
        'event_date'  => 'date:Y-m-d H:i:s',
    ];

}
