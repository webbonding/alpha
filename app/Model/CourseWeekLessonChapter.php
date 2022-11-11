<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseWeekLessonChapter extends Model
{
    protected $table = 'course_week_lessons_chapter';
    protected $fillable = ['name','course_id','week_id','lesson_id','status'];
//    public $timestamps = false;

    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
    public function week() {
        return $this->belongsTo('App\Model\CourseWeek', 'week_id', 'id');
    }
    public function lesson() {
        return $this->belongsTo('App\Model\CourseWeekLesson', 'lesson_id', 'id');
    }
}
