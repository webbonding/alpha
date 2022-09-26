
@extends('layouts.main')
@section('css')

@endsection
@section('content')

<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Dashboard</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('dashboard')}}">
            <span>Dashboard</span>
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
                    <!-- <h2 class="dash-title">DASHBOARD</h2> -->
                    <div class="successfull">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="user-profile-details">
                                        <div class="account-info">
                                            <div class="header-area">
                                                <h4 class="title">
                                                    Account Information
                                                </h4>
                                            </div>
                                            <div class="edit-info-area"></div>
                                            <div class="main-info">
                                                <h5 class="title">{{Auth()->guard('frontend')->user()->full_name}}</h5>
                                                <ul class="list">
                                                    <li>
                                                        <p><span class="user-title">Email:</span> {{Auth()->guard('frontend')->user()->email}}</p>
                                                    </li>
                                                    <li>
                                                        <p><span class="user-title">Phone:</span> {{isset(Auth()->guard('frontend')->user()->phone)?Auth()->guard('frontend')->user()->phone:''}}</p>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="col-md-6 col-xl-6">
                                    <div class="card c-info-box-area">
                                        <div class="c-info-box box2">
                                            <p>1</p>
                                        </div>
                                        <div class="c-info-box-content">
                                            <h6 class="title">Total Orders</h6>
                                            <p class="text">All Time</p>
                                        </div>
                                    </div>
                                </div>-->

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

