@extends('admin::layouts.main')

@section('page_css')
<link href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css" />
<style>
    .jconfirm-content {
        overflow: hidden !important;
    }
</style>
@stop

@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{Route('admin-dashboard')}}">Home</a>
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
        <a href="{{Route("admin-course-week-lessons-chapter", [$courseweeklessonchapter->week_id])}}">Course Week Lesson Chapter</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Topic Management For {{$courseweeklessonchapter->course->name}} of {{$courseweeklessonchapter->week->name}} of {{$courseweeklessonchapter->lesson->name}} of {{$courseweeklessonchapter->name}}</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Topic Management For {{$courseweeklessonchapter->name}}</span>
        </div>
        <div class="pull-right"><a href="{{route('admin-course-week-lessons-chapter-topic-add',$courseweeklessonchapter->id)}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="course-week-lessons-chapter-topic-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_js')
<script src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}" type="text/javascript"></script>
<script>

//    $(docuemnt).ready(function () {
//
//    });
$(function () {
    $('#course-week-lessons-chapter-topic-management').DataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin-course-week-lessons-chapter-topic-datatables",$id) }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'status', searchable: false, orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection