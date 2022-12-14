<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CourseWeekLesson extends Model
{
    protected $table = 'course_week_lessons';
    protected $fillable = ['name','free_video','paid_video','special_questions_discussion','one_month_pricing','three_years_pricing','past_paper_question','course_id','week_id','status'];
//    public $timestamps = false;

    public function course() {
        return $this->belongsTo('App\Model\Course', 'course_id', 'id');
    }
    public function week() {
        return $this->belongsTo('App\Model\CourseWeek', 'week_id', 'id');
    }
}
