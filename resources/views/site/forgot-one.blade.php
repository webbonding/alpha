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
            <a href="{{route('forgot-password')}}">
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
                <form class="col s12" id="forgot-form" action="{{ Route('forgot-password') }}" method="POST"> 
                @csrf
                <div class="login-form">
                    <div class="form-group row ">
                        <label class="col-md-3 col-sm-12 form-control-label required">Email</label>
                        <div class="col-md-9 col-sm-12">
                            <input type="email" class="form-control" placeholder="Enter Your Email*"  name="email" >
                            <div class="help-block" id="err-email"></div>
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
