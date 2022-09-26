@extends('layouts.main')

@section('content')
<!--breadcrumb-->
<div class="breadcrumb-contact">
    <div class="container">
        <div class="breadcrumb_title" data-aos="fade-right">{{ $model->page_name }}</div>
        <div class="bread-crumb right-side" data-aos="fade-left">
            <ul>
                <li><a href="{{route('/')}}">HOME</a>/</li>
                <li><span>{{ $model->page_name }}</span></li>
            </ul>
        </div>
    </div>
</div>
<!--end breadcrumb-->
<section class="main-body-section inner-page-padding">
    <div class="container">
        <!--<h2 class="section-heading">{{ $model->page_name }}<span>.</span></h2>-->
        <div class="heading-line"></div>
        <div class="inner-wrap" style="margin:30px; ">
            <div class="inner-cont-area">
                {!! $model->content !!}
            </div>
        </div>
    </div>
</section>
@stop