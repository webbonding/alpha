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
        <span class="active">Blog Management</span>
    </li>
</ul>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Blog Management</span>
        </div>
        <div class="pull-right"><a href="{{route('admin-blog-create')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a></div>
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-responsive">
                <table class="ui celled table" cellspacing="0" width="100%" id="blog-management">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Featured Image</th>
                            <th>Post Title</th>
                            <th>Views</th>
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
    $('#blog-management').DataTable({
        serverSide: true,
        responsive: true,
        ajax: '{{ route("admin-blog-datatables") }}',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'photo', name: 'photo', searchable: false, orderable: false},
            {data: 'title', name: 'title' },
            {data: 'views', name: 'views' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endsection