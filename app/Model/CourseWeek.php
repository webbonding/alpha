<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseWeek extends Model
{
    protected $table = 'course_week';
    protected $fillable = ['name','course_id','status'];
//    public $timestamps = false;

    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
}
