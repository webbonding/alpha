@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-cat-index')}}">Category</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Category</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-cat-store')}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
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
                        <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Slug<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Enter Slug" name="slug" value="{{ (old('slug')!="") ? old('slug') : ''}}"/>
                                @if ($errors->has('slug'))
                                <span class="help-block"> {{ $errors->first('slug') }} </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Upload Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="photo" onchange="readURL(this);">
                                @if ($errors->has('photo'))
                                <span class="help-block"> {{ $errors->first('photo') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="" style="max-width: 400;max-height: 200px">
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
                                <a href="{{Route('admin-cat-index')}}" class="btn btn-primary">Cancel</a>
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