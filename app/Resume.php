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
    protected $guarded = [];

    /**
     * 取得擁有該紀錄的使用者。
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    

    /**
     * 取得該使用者的教育經歷
     */
    public function resume_education()
    {
        // hasMany 會主動使用 resumses_id 當作主鍵
        return $this->hasMany('App\ResumeEducation', 'resumes_id', 'id' );
    }

    /**
     * 取得該使用者的專業課程
     */
    public function resume_course()
    {
        // hasMany 會主動使用 resumses_id 當作主鍵        
        return $this->hasMany('App\ResumeCourse', 'resumes_id', 'id' );
    }

    /**
     * 取得該使用者的工作經歷
     */
    public function resume_exp()
    {
        // hasMany 會主動使用 resumses_id 當作主鍵
        return $this->hasMany('App\ResumeExp', 'resumes_id', 'id' );
    }

    /**
     * 取得該使用者的家庭成員
     */
    public function resume_family()
    {
        // hasMany 會主動使用 resumses_id 當作主鍵
        return $this->hasMany('App\ResumeFamily', 'resumes_id', 'id' );
    }

    /**
     * 取得該使用者的手機(格式化)
     * ex: 0900 000 000
     */
    public function getPhoneFormatAttribute()
    {
        return substr($this->phone, 0, 4) . " " . substr($this->phone, 4, 3) . " " . substr($this->phone, 7, 3);
    }
}
