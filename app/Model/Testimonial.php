<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name','content','photo','status'];
    protected $table = 'testimonials';
    public $timestamps = false;

    
    

    
}
