<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseWeekLessonChapterTopic extends Model
{
    protected $table = 'course_week_lessons_chapter_topic';
    protected $fillable = ['name','course_id','week_id','lesson_id','chapter_id','status'];
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
    public function chapter() {
        return $this->belongsTo('App\Model\CourseWeekLessonChapter', 'chapter_id', 'id');
    }
}
