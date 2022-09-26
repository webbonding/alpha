@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('users')}}">User</a>
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
                    <span class="caption-subject font-red-sunglo bold uppercase">Update User of {{$user->full_name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('user-edit',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data">
                    @method('PUT')
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="full_name" value="{{ (old('full_name')!="") ? old('full_name') : $user->full_name}}"/>
                                @if ($errors->has('full_name'))
                                <span class="help-block"> {{ $errors->first('full_name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ (old('email')!="") ? old('email') : $user->email}}"/>
                                @if ($errors->has('email'))
                                <span class="help-block"> {{ $errors->first('email') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="control-label col-md-2">Phone</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="{{ (old('phone')!="") ? old('phone') : $user->phone}}"/>
                                @if ($errors->has('phone'))
                                <span class="help-block"> {{ $errors->first('phone') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1"  {{ ($user->status == '1') ? 'checked' : '' }} > Active 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($user->status == '0') ? 'checked' : '' }} > Inactive 
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Subscription</label>
                            <div class="col-md-10">
                                <p>
                                    @if ($user->payment_status == '0') 
                                    <span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>
                                    @elseif ($user->payment_status == '1') 
                                    @if($user->subscription_end >= Carbon\Carbon::now()->format('Y-m-d'))
                                    <span class="badge badge-success"><i class="icofont-check"></i>Active</span>
                                    @else
                                    <span class="badge badge-warning"><i class="icofont-warning"></i>Inactive</span>
                                    @endif 
                                    @endif 
                                    
                                </p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('payment_status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Payment Status </label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="payment_status" value="1"  {{ ($user->payment_status == '1') ? 'checked' : '' }} > Active 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="payment_status" value="0" {{ ($user->payment_status == '0') ? 'checked' : '' }} > Inactive 
                                    </label>
                                    @if ($errors->has('payment_status'))
                                    <div class="help-block">{{ $errors->first('payment_status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3">User Profile Photo</label>
                            <div class="col-md-10">
                                @if(isset($user->image))
                                <img src="{{URL::asset('public/uploads/user/'.$user->image)}}" height="100px" width="100px" />
                                @else
                                Not Given
                                @endif
                            </div>
                        </div>
                        <!--<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">-->
                        <!--    <label class="control-label col-md-3">Upload Image</label>-->
                        <!--    <div class="col-md-10">-->
                        <!--        <input type="file" class="form-control"  name="image" onchange="readURL(this);">-->
                        <!--        @if ($errors->has('image'))-->
                        <!--        <span class="help-block"> {{ $errors->first('image') }} </span>-->
                        <!--        @endif-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('users')}}" class="btn btn-primary">Cancel</a>
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