@extends('layouts.main')
@section('css')

@endsection
@section('content')

<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">My Profile</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('my-profile')}}">
            <span>My Profile</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<div class="dashboard mb-5">
    <div class="container">
        <div class="row">
            @include('partials.left')
            <div class="col-md-8 col-sm-8 tab_dsh_2">
                <div class="dash-right-sec">
                    <div class="successfull">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="user-profile-details">
                                        <div class="account-info">
                                            <div class="header-area">
                                                <h4 class="title">
                                                    MY PROFILE
                                                </h4>
                                            </div>
                                            <div class="edit-info-area">
                                                <div class="body">
                                                    <div class="edit-info-area-form">
                                                        <form method="post" class="form" action="{{route('post-myprofile')}}" id="customer-editprofile-form" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="upload-images">
                                                                        <img id="blah" src="{{($model->image!='')? URL::asset('public/uploads/user').'/'.$model->image:URL::asset('public/frontend/images/no-img.png') }}" alt="profile">
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input name="full_name" type="text" class="input-field" placeholder="Full Name"  value="{{isset($model->full_name)?$model->full_name:''}}">
                                                                    <span class="help-block" id="err-full_name"></span>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input class="input-field" name="image" type="file" onchange="readURL(this);" accept="image/png, image/jpeg, image/jpg">
                                                                    <span class="help-block" id="err-image"></span> 
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input name="email" type="email" class="input-field" placeholder="Email Id" value="{{$model->email}}">
                                                                    <span class="help-block" id="err-email"></span>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input name="phone" type="tel" class="input-field" placeholder="Phone Number" value="{{$model->phone}}">
                                                                    <span class="help-block" id="err-phone"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-links">
                                                                <button class="submit-btn" type="submit">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="header-area">
                                                <h4 class="title mt-5">
                                                    Change Password
                                                </h4>
                                            </div>
                                            <div class="edit-info-area">
                                                <div class="body">
                                                    <div class="edit-info-area-form">
                                                        <form method="post" class="form" action="{{route('post-reset-password')}}" id="reset-password-frm">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input name="old_password" type="password" class="input-field" placeholder="Old Password" required="" >
                                                                    <span class="help-block" id="err-old_password"></span>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input name="password" type="password" class="input-field" placeholder="New Password" required="" >
                                                                    <span class="help-block" id="err-password"></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input name="retype_password" type="password" class="input-field" placeholder="Confirm Password" required="" >
                                                                    <span class="help-block" id="err-retype_password"></span>
                                                                </div>
                                                            </div>
                                                            <div class="form-links">
                                                                <button class="submit-btn" type="submit">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
@section('js')

@endsection



