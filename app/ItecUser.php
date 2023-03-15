<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItecUser extends Model
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

    protected $table = 'itec_user';

    public function itec_task(){
        return $this->hasMany('App\ItecTask');
    }
}