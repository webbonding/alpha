@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Forgot Password</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void();">
            <span>Forgot Password</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<section id="wrapper">
    <div class="container">
        <div class="row">
        <div id="content-wrapper" class="col-12">
            <section id="main">
            <div class="login-page">                  
                <div class="block-title">
                <h2 class="title"><span>Forgot Password</span></h2>
                </div>
                <form class="col s12" id="reset-password-form" action="{{ Route('set-password') }}" method="POST">
                @csrf
                <input type="hidden" name="forgot_token" id="forgot_token" value="{{ Session::has('forgot_token') ? Session::get('forgot_token') : '' }}">
                <div class="login-form">
                    <div class="form-group row ">
                        <label class="col-md-3 col-sm-12 form-control-label required">Enter Your Password</label>
                        <div class="col-md-9 col-sm-12">
                            <input type="password" class="form-control" placeholder="Enter Your Password*"  name="password" >
                            <div class="help-block" id="err-password"></div>
                        </div>                            
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3 col-sm-12 form-control-label required">Enter Retype Password</label>
                        <div class="col-md-9 col-sm-12">
                            <input type="password" class="form-control" placeholder="Retype Your Password*"  name="retype_password" >
                            <div class="help-block" id="err-retype_password"></div>
                        </div>                            
                    </div>
                    
                    <div class="form-group text-center">
                        <div class="link">
                            Don't have account?<a href="{{route('signup')}}">Create New Account</a>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-primary" value="Submit" type="submit">
                    </div>
                </div>
                </form>
            </div>
            </section>
        </div>
        </div>
    </div>
</section>

@stop
@section('js')


@endsection
