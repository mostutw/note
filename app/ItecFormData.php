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
}