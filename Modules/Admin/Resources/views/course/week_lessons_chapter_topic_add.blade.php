@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week", [$courseweeklessonchapter->course_id])}}">Course Week</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week-lessons", [$courseweeklessonchapter->week_id])}}">Course Week Lesson</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week-lessons-chapter", [$courseweeklessonchapter->lesson_id])}}">Course Week Lesson Chapter</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week-lessons-chapter-topic", [$courseweeklessonchapter->id])}}">Course Week Lesson Chapter Topic of {{$courseweeklessonchapter->name}}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Add </span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Course Week Lesson Chapter Topic</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-course-week-lessons-chapter-topic-add',$courseweeklessonchapter->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="course_id" value="{{ $courseweeklessonchapter->course_id }}">
                    <input type="hidden" name="week_id" value="{{ $courseweeklessonchapter->week_id }}">
                    <input type="hidden" name="lesson_id" value="{{ $courseweeklessonchapter->lesson_id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : ''}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0"> Inactive
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route("admin-course-week-lessons-chapter-topic", [$courseweeklessonchapter->id])}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection