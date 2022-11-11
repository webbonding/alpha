@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-course-index')}}">Course</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Course</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-course-store')}}" class="form-horizontal" enctype="multipart/form-data">
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
                        
                        
                       
                        
                        
                        <div class="form-group {{ $errors->has('book_list') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Book List<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Book List" name="book_list"  id="book_list">{{ (old('book_list')!="") ? old('book_list') : '' }}</textarea>
                                @if ($errors->has('book_list'))
                                <span class="help-block"> {{ $errors->first('book_list') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('additional_resources') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Additional Resources<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Additional Resources" name="additional_resources"  id="additional_resources">{{ (old('additional_resources')!="") ? old('additional_resources') : '' }}</textarea>
                                @if ($errors->has('additional_resources'))
                                <span class="help-block"> {{ $errors->first('additional_resources') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('prior_knowledge') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Prior Knowledge<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Prior Knowledge" name="prior_knowledge"  id="prior_knowledge">{{ (old('prior_knowledge')!="") ? old('prior_knowledge') : '' }}</textarea>
                                @if ($errors->has('prior_knowledge'))
                                <span class="help-block"> {{ $errors->first('prior_knowledge') }} </span>
                                @endif
                            </div>
                        </div>
                      	<div class="form-group {{ $errors->has('analysis_basics') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Analysis Basics<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Analysis Basics" name="analysis_basics"  id="analysis_basics">{{ (old('analysis_basics')!="") ? old('analysis_basics') : '' }}</textarea>
                                @if ($errors->has('analysis_basics'))
                                <span class="help-block"> {{ $errors->first('analysis_basics') }} </span>
                                @endif
                            </div>
                        </div>
						<div class="form-group {{ $errors->has('functions') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Functions<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Functions" name="functions"  id="functions">{{ (old('functions')!="") ? old('functions') : '' }}</textarea>
                                @if ($errors->has('functions'))
                                <span class="help-block"> {{ $errors->first('functions') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Current Featured Image') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Sale Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Price" name="price" value="{{ (old('price')!="") ? old('price') : ''}}"/>
                                @if ($errors->has('price'))
                                <span class="help-block"> {{ $errors->first('price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('original_price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Original Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Original Price" name="original_price" value="{{ (old('original_price')!="") ? old('original_price') : ''}}"/>
                                @if ($errors->has('original_price'))
                                <span class="help-block"> {{ $errors->first('original_price') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('discount_percentage') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Discount Percentage<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Discount Percentage" name="discount_percentage" value="{{ (old('discount_percentage')!="") ? old('discount_percentage') : ''}}"/>
                                @if ($errors->has('discount_percentage'))
                                <span class="help-block"> {{ $errors->first('discount_percentage') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('hours_left_for_this_price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Hours Left For This Price<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="Hours Left For This Price" name="hours_left_for_this_price" value="{{ (old('hours_left_for_this_price')!="") ? old('hours_left_for_this_price') : ''}}"/>
                                @if ($errors->has('hours_left_for_this_price'))
                                <span class="help-block"> {{ $errors->first('hours_left_for_this_price') }} </span>
                                @endif
                            </div>
                        </div> -->
                        
                        <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Short Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Short Description" name="short_description"  id="body">{{ (old('short_description')!="") ? old('short_description') : '' }}</textarea>
                                @if ($errors->has('short_description'))
                                <span class="help-block"> {{ $errors->first('short_description') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('long_description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Long Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Long Description" name="long_description"  id="body">{{ (old('long_description')!="") ? old('long_description') : '' }}</textarea>
                                @if ($errors->has('long_description'))
                                <span class="help-block"> {{ $errors->first('long_description') }} </span>
                                @endif
                            </div>
                        </div>
                        



                        <div class="form-group {{ $errors->has('featured') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Featured <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="featured" value="1"> Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="featured" value="0"> No
                                    </label>
                                    @if ($errors->has('featured'))
                                    <div class="help-block">{{ $errors->first('featured') }}</div>
                                    @endif
                                </div>
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
                                <a href="{{Route('admin-course-index')}}" class="btn btn-primary">Cancel</a>
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