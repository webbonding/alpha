@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week", [$courseweek->course_id])}}">Course Week</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route("admin-course-week-lessons", [$courseweek->id])}}">Course Week Lesson of {{$courseweek->name}}</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Course Week Lesson</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-course-week-lessons-add',$courseweek->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="course_id" value="{{ $courseweek->course_id }}">
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
                        <div class="form-group {{ $errors->has('free_video') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Free Video<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="url" class="form-control" placeholder="Free Video" name="free_video" value="{{ (old('free_video')!="") ? old('free_video') : ''}}"/>
                                @if ($errors->has('free_video'))
                                <span class="help-block"> {{ $errors->first('free_video') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('paid_video') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Paid Video<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="url" class="form-control" placeholder="Paid Video" name="paid_video" value="{{ (old('paid_video')!="") ? old('paid_video') : ''}}"/>
                                @if ($errors->has('paid_video'))
                                <span class="help-block"> {{ $errors->first('paid_video') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('special_questions_discussion') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Special Questions & Discussion</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="special_questions_discussion" >
                                @if ($errors->has('special_questions_discussion'))
                                <span class="help-block"> {{ $errors->first('special_questions_discussion') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('one_month_pricing') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">1 Month Pricing<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="1 Month Pricing" name="one_month_pricing" value="{{ (old('one_month_pricing')!="") ? old('one_month_pricing') : ''}}"/>
                                @if ($errors->has('one_month_pricing'))
                                <span class="help-block"> {{ $errors->first('one_month_pricing') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('three_years_pricing') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">3 Years Pricing<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="3 Years Pricing" name="three_years_pricing" value="{{ (old('3_years_pricing')!="") ? old('three_years_pricing') : ''}}"/>
                                @if ($errors->has('three_years_pricing'))
                                <span class="help-block"> {{ $errors->first('three_years_pricing') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('past_paper_question') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Past Paper Question</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="past_paper_question" >
                                @if ($errors->has('past_paper_question'))
                                <span class="help-block"> {{ $errors->first('past_paper_question') }} </span>
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
                                <a href="{{Route("admin-course-week-lessons", [$courseweek->id])}}" class="btn btn-primary">Cancel</a>
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