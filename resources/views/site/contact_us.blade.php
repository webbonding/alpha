@extends('layouts.main')

@section('content')
<!--main content-->
<!--breadcrumb-->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Contact</h1>
        <ul>
            <li>
            <a href="{{route('/')}}">
                <span>Home</span>
            </a>
            </li>
            <li>
            <a href="{{route('contact-us')}}">
                <span>Contact</span>
            </a>
            </li>
        </ul>
    </nav>
</div>
<!--end breadcrumb-->
<section id="wrapper">
    <div id="content-wrapper" class="top-wrapper">
    <div class="container">
        <div class="row">
        <section id="main">
            <div class="contact-form-information">
            <div class="row">
                <div class="contact-banner col-lg-6 col-md-12">
                <div class="image-container">
                    <a href="javascript:void(0);">
                    <img
                    src="{{ URL::asset('public/frontend/images/contact-us-concept-illustration_114360-3147.jpg') }}"
                    alt="contact-image">
                    </a>
                </div>
                </div>
                <div class="information-container col-lg-6 col-md-12">
                <div class="title-container">
                    <h3 class="heading">get in touch</h3>
                    <span class="subheading">We&#39;d Love to Hear From You, Lets Get In Touch!</span>
                </div>
                <div class="list-contact-info col-md-12 col-sm-12 col-xs-12">
                    <div class="contact_info_item col-md-6 col-sm-6 col-xs-6">
                    <h3>address</h3>
                    <address>
                    {{$model[0]->value}}
                    </address>
                    </div>
                    <div class="contact_info_item col-md-6 col-sm-6 col-xs-6">
                    <h3>Phone</h3>
                    <p>{{$model[1]->value}}</p>
                    </div>
                    <div class="contact_info_item col-md-6 col-sm-6 col-xs-6">
                    <h3>Email</h3>
                    <p>
                        <a href="tel:{{$model[2]->value}}">
                        {{$model[2]->value}}
                        </a> 
                    </p>
                    </div>
                    <div class="contact_info_item col-md-6 col-sm-6 col-xs-6">
                    <h3>additional Information</h3>
                    <p>We are open: Open 10am to 10pm all days</p>
                    </div>
                    <div class="contact_info_item block-social col-md-12 col-sm-12 col-xs-12">
                    <h3>Social</h3>
                    <ul class="social-inner">
                        <li class="facebook">
                        <a href="{{$social_links[0]->value}}" target="_blank">
                            <i class="bi bi-facebook"></i><span class="socialicon-label">Facebook</span>
                        </a>
                        </li>
                        <li class="twitter">
                        <a href="{{$social_links[3]->value}}" target="_blank">
                            <i class="bi bi-instagram"></i><span class="socialicon-label">Instagram</span>
                        </a>
                        </li>
                        
                        
                        
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        </div>
    </div>
    
    <div class="contact-map clearfix">
        <div id="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3742.6899103494648!2d85.84103891492008!3d20.2716911864133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sPlot.%2011%2C%20Unit%203%2C%20Kharvel%20Nagar%2C%20Bhubaneswar%2C%20Odisha%2C%20India!5e0!3m2!1sen!2sin!4v1660374298870!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="container">
        <div class="contact-form-bottom">
        <div class="contact-form form-vertical">
            <div class="title-container">
            <h3 class="heading">leave us a message</h3>
            <span class="subheading">-good for nature, good for you-</span>
            </div>
            <section class="form-field">
            <form class="contact-form" id="contact-us-form" action="{{route('contact-us')}}">
                    @csrf
                <div class="form-fields row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                    <label for="ContactFormName" class="hidden control-label">Name</label>
                    <input type="text" id="ContactFormName" class="form-control" name="name" value="" placeholder="Name">
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                    <label for="ContactFormEmail" class="hidden">Email</label>
                    <input type="email" id="ContactFormEmail" class="form-control" name="email" autocapitalize="off" value="" placeholder="Email">
                    <span class="help-block"></span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                    <label for="ContactFormPhone" class="hidden">Phone</label>
                    <input type="text" id="ContactFormPhone" class="form-control" name="phone" value="" placeholder="Phone">
                    <span class="help-block"></span>
                </div>              
                <div class="form-group-area col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                    <label for="ContactFormMessage" class="hidden">Message</label>
                    <textarea rows="10" id="ContactFormMessage" class="form-control" name="message" placeholder="your message"></textarea>
                    <span class="help-block"></span>
                </div>
                <div class="submit-button col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <input class="btn btn-primary" name="submitMessage" value="Send" type="submit">
                </div>
                </div>
            </form>
            </section>
        </div>
        </div>
    </div>
    </div>
</section>



@stop

@section('js')

@stop    