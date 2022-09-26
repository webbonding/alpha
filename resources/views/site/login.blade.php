@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Login</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('signup')}}">
            <span>Login</span>
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
                <h2 class="title"><span>Login</span></h2>
                </div>
                <form id="login-form" class="main-form" action="{{ Route('login') }}" method="POST">
                @csrf
                <div class="login-form">
                    <div class="form-group row ">
                    <label class="col-md-3 col-sm-12 form-control-label required">Email</label>
                    <div class="col-md-9 col-sm-12">
                    <input type="email" class="form-control" placeholder="Enter Your Email*"  name="email" value="<?php
                            if (isset($_COOKIE['user_email']) && $_COOKIE['user_email'] !== NULL) {
                                echo $_COOKIE['user_email'];
                            }
                            ?>">
                            <div class="help-block" id="err-email"></div>
                    </div>                            
                    </div>
                    <div class="form-group row ">
                    <label class="col-md-3 col-sm-12 form-control-label">
                        Password
                    </label>
                    <div class="col-md-9 col-sm-12">
                    <input type="password" class="form-control" placeholder="Enter Your Password*" name="password" value="<?php
                            if (isset($_COOKIE['user_password']) && $_COOKIE['user_password'] !== NULL) {
                                echo $_COOKIE['user_password'];
                            }
                            ?>">
                            <div class="help-block" id="err-password"></div>
                    </div>                            
                    </div>
                    <div class="form-group text-center">
                    <div class="link">
                        <a href="{{route('forgot-password')}}">Forgot your password?</a> 
                        <a href="{{route('signup')}}">Register?</a>
                    </div>
                    </div>
                    <div class="form-group text-center">
                    <input class="btn btn-primary" value="Sign In" type="submit">
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