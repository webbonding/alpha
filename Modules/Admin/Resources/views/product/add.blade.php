@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-products')}}">Product</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Add Product</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-addproduct')}}" class="form-horizontal" enctype="multipart/form-data" id="add-product-form">
                    {{csrf_field()}}
                    <div class="form-body">
                        
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Product Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="name" class="form-control" placeholder="Product Name" name="name" value="{{ (old('name')!="") ? old('name') : ''}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                                <span class="help-block"></span> 
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Category<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="cat"  name="category_id" required="" class="form-control">
                                    <option value="" disabled="" selected>{{ __("Select Category") }}</option>
                                    @foreach($cats as $cat)
                                      <option value="{{ $cat->id }}" data-href="{{ route('admin-subcat-load',$cat->id) }}" {{ (old('category_id')!="") ? ($cat->id==old('category_id'))?'selected':'' : ''}}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block"> {{ $errors->first('category_id') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Sub Category<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="subcat"  name="subcategory_id" disabled="" class="form-control">
                                  <option value="">{{ __('Select Sub Category') }}</option>
                                    
                                </select>
                                @if ($errors->has('subcategory_id'))
                                <span class="help-block"> {{ $errors->first('subcategory_id') }} </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">{{ __('Current Featured Image') }}</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="photo" onchange="readURL(this);">
                                @if ($errors->has('photo'))
                                <span class="help-block"> {{ $errors->first('photo') }} </span>
                                @endif
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Price</label>
                            <div class="col-md-10">
                                <input type="number" class="form-control" placeholder="price" name="price" value="{{ (old('price')!="") ? old('price') : ''}}"/>
                                @if ($errors->has('price'))
                                <span class="help-block"> {{ $errors->first('price') }} </span>
                                @endif
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('net_weight') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Net Weight</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Net Weight" name="net_weight" value="{{ (old('net_weight')!="") ? old('net_weight') : ''}}"/>
                                @if ($errors->has('net_weight'))
                                <span class="help-block"> {{ $errors->first('net_weight') }} </span>
                                @endif
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        
                        
                        <div class="form-group {{ $errors->has('brand') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Brand</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Brand" name="brand" value="{{ (old('brand')!="") ? old('brand') : ''}}"/>
                                @if ($errors->has('brand'))
                                <span class="help-block"> {{ $errors->first('brand') }} </span>
                                @endif
                                <span class="help-block"></span> 
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
                                <span class="help-block"></span> 
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="offset-md-3 col-md-9">
                                <a href="{{Route('admin-products')}}" class="btn btn-primary">Cancel</a>
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