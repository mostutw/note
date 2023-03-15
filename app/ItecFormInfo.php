<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItecFormInfo extends Model
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

    protected $table = 'itec_forminfo';

    public function itec_task()
    {
        return $this->hasMany('App\ItecTask');
    }

    public function itec_form_data()
    {
        return $this->hasMany('App\ItecFormData');
    }
}
