@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Create Account</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('signup')}}">
            <span>Create Account</span>
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
                <h2 class="title"><span>Create Account</span></h2>
                </div>
                <form id="signup-form" action="{{ Route('signup') }}" method="POST" class="main-form">
                @csrf
                <div class="login-form">
                    <div class="form-group row ">
                    <label class="col-md-3 col-sm-12 form-control-label required">First name</label>
                    <div class="col-md-9 col-sm-12">
                        <input class="form-control" name="first_name" type="text" value="">
                        <div class="help-block" id="error-first_name"></div>
                    </div>                            
                    </div>
                    <div class="form-group row ">
                    <label class="col-md-3 col-sm-12 form-control-label required">Last name</label>
                    <div class="col-md-9 col-sm-12">
                        <input class="form-control" name="last_name" type="text" value="">
                        <div class="help-block" id="error-last_name"></div>
                    </div>                            
                    </div>
                    <div class="form-group row ">
                    <label class="col-md-3 col-sm-12 form-control-label required">Email</label>
                    <div class="col-md-9 col-sm-12">
                        <input class="form-control" name="email" type="email" value="">
                        <div class="help-block" id="error-email"></div>
                    </div>                            
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3 col-sm-12 form-control-label">
                            Password
                        </label>
                        <div class="col-md-9 col-sm-12">
                            <input class="form-control" name="password" type="password" value="">
                            <div class="help-block" id="error-password"></div>
                        </div>                            
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3 col-sm-12 form-control-label">
                            Re-Enter-Password
                        </label>
                        <div class="col-md-9 col-sm-12">
                            <input class="form-control" name="confirm_password" type="password" value="">
                            <div class="help-block" id="error-confirm_password"></div>
                        </div>                            
                    </div>
                    <div class="form-group text-center">
                    <input class="btn btn-primary" value="Create Account" type="submit">
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