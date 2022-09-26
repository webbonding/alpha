@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-blog-index')}}">Blog</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Blog of {{$data->title}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-blog-update',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Category<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="cat"  name="category_id" required="" class="form-control">
                                    <option value="" disabled="" selected>{{ __("Select Category") }}</option>
                                    @foreach($cats as $cat)
                                    <option value="{{ $cat->id }}" data-href="{{ route('admin-subcat-load',$cat->id) }}" {{ (old('category_id')!="") ? ($cat->id==old('category_id'))?'selected':'' : ($cat->id==$data->category_id)?'selected':''}}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block"> {{ $errors->first('category_id') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Sub Category</label>
                            <div class="col-md-10">
                                <select id="subcat"  name="subcategory_id" class="form-control">
                                    <option value="">{{ __('Select Sub Category') }}</option>
                                    @if($data->subcategory_id == null)
                                    @foreach($data->category->subs as $sub)
                                    <option  value="{{$sub->id}}" >{{$sub->name}}</option>
                                    @endforeach
                                    @else
                                    @foreach($data->category->subs as $sub)
                                    <option value="{{$sub->id}}" {{(old('subcategory_id')!="") ? ($sub->id==old('subcategory_id'))?'selected':'' :$sub->id == $data->subcategory_id ? "selected":""}} >{{$sub->name}}</option>
                                    @endforeach
                                    @endif  
                                </select>
                                @if ($errors->has('subcategory_id'))
                                <span class="help-block"> {{ $errors->first('subcategory_id') }} </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Title<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ (old('title')!="") ? old('title') : $data->title}}"/>
                                @if ($errors->has('title'))
                                <span class="help-block"> {{ $errors->first('title') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Slug<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Enter Slug" name="slug" value="{{ (old('slug')!="") ? old('slug') : $data->slug}}"/>
                                @if ($errors->has('slug'))
                                <span class="help-block"> {{ $errors->first('slug') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Current Featured Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="photo" onchange="readURL(this);">
                                @if ($errors->has('photo'))
                                <span class="help-block"> {{ $errors->first('photo') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="{{isset($data->photo)?URL::asset('public/uploads/blog/'.$data->photo):''}}" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Description" name="details"  id="body">{!! (old('details')!="") ? old('details') : $data->details !!}</textarea>
                                @if ($errors->has('details'))
                                <span class="help-block"> {{ $errors->first('details') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('source') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Source</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Source" name="source" value="{{ (old('source')!="") ? old('source') : $data->source}}"/>
                                @if ($errors->has('source'))
                                <span class="help-block"> {{ $errors->first('source') }} </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($data->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($data->status == '0') ? 'checked' : '' }}> Inactive
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
                            <div class="col-md-12 text-center">
                                <a href="{{Route('admin-blog-index')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection