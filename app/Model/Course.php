<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','book_list','additional_resources','prior_knowledge','analysis_basics','functions','image','price','original_price','discount_percentage','hours_left_for_this_price','short_description','long_description','featured','status'];
    protected $table = 'courses';
    // public $timestamps = false;

    

    
}

