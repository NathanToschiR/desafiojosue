<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function users(){
        return $this->belongsToMany('App\User','user_course','course_id','user_id');
    }
}