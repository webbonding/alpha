@extends('layouts.main')

@section('content')
@php
    use App\Model\Settings;
    $social_link = Settings::where('module', '=', 'Social Link')->get();
    $location = Settings::where('module', '=', 'Location')->get();
@endphp
<!--main content-->
<!------------------ breadcrumbs ------------>
<section class="breadcrumbs custom-breadcrumbs">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="breadcrumb-title-div">
                      <div class="bread-left-side">
                          <h2>Contact Us</h2>
                      </div>
                      <div class="breadcrumb-ul right-side">
                          <ul>
                          <li><a href="/">HOME</a>/</li>
                          <li><span>Contact Us</span></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!------------------// breadcrumbs ---------->
    <div class="main-content-area">
      <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                  <div class="contact-us-form">
                    <div class="contact-title">
                      <h1>Contact</h1>
                      <p>Leave us a message by filling the form and we’ll get back to you shortly
                      </p>
                    </div>
                    <form class="contactform" id="contact-us-form" action="{{route('contact-us')}}">
                    @csrf
                      <div class="field">
                        <span class="fa fa-user"></span>
                        <input type="text" class="custom-fields" placeholder="Name *" name="name" >
                        
                      </div>
                      <div class="help-block" id="err-name"></div>
                      <div class="field">
                        <span class="fa fa-envelope"></span>
                        <input type="email" class="custom-fields" placeholder="Email Address *" name="email" >
                        
                      </div>
                      <div class="help-block" id="err-email"></div>

                      <div class="field">
                        <span class="fa fa-phone"></span>
                        <input type="tel" class="custom-fields" placeholder="Phone Number *"  name="phone">
                        
                      </div>
                      <div class="help-block" id="err-phone"></div>

                      <div class="field">
                        <span class="fa fa-comments"></span>
                        <input type="text" class="custom-fields" placeholder="Subject*"  name="subject">
                        
                      </div>
                      <div class="help-block" id="err-subject"></div>

                      <div class="field">
                        <span class="fa fa-comments"></span>
                        <textarea name="message" class="custom-fields" placeholder="Type Your Message Here"></textarea>
                        
                      </div>
                      <div class="help-block" id="err-message"></div>

                      <button class="submit-btn-cus" type="submit">Submit</button>
                    </form>
                  </div>
                </div>
                <div class="col-sm-6">
                   <div class="right-area">
                    
                    <div class="contact-info alert shadow-soft">
                      <div class="left ">
                        <div class="icon">
                          <i class="fa fa-mobile"></i>
                        </div>
                      </div>
                      <div class="content d-flex align-self-center">
                        <div class="content">
                          <a href="tel: {{$location[1]->value}}">{{$location[1]->value}}</a>
                        </div>
                      </div>
                    </div>

                    <div class="contact-info alert shadow-soft">
                      <div class="left ">
                        <div class="icon">
                          <i class="fa fa-envelope"></i>
                        </div>
                      </div>
                      <div class="content d-flex align-self-center">
                        <div class="content">
                          <a href="mailto:{{$location[2]->value}}">{{$location[2]->value}}</a>
                        </div>
                      </div>
                    </div>

                    <div class="contact-info alert shadow-soft">
                      <div class="left ">
                        <div class="icon">
                          <i class="fab fa-whatsapp"></i>
                        </div>
                      </div>
                      <div class="content d-flex align-self-center">
                        <div class="content">
                          <a href="{{$social_link[4]->value}}">{{$location[1]->value}}</a>
                        </div>
                      </div>
                    </div>

                    <div class="social-links">
                      <h4 class="find">Connect On</h4>
                      <ul class="list-inline list-unstyled">
                        <li class="list-inline-item">
                          <a href="{{$social_link[3]->value}}" title="" class="social-item btn btn-primary btn-pill btn-icon-only">
                            <i class="fab fa-linkedin linkedin-icon"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="{{$social_link[1]->value}}" title="" class="social-item btn btn-primary btn-pill btn-icon-only">
                            <i class="fab fa-twitter text-twitter"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="{{$social_link[0]->value}} title="" class="btn btn-primary btn-pill btn-icon-only">
                            <i class="fab fa-facebook-f text-facebook"></i>
                          </a>
                        </li>
                        
                        <li class="list-inline-item">
                          <a href="{{$social_link[2]->value}}" title="" class="social-item btn btn-primary btn-pill btn-icon-only">
                            <i class="fa fa-youtube-play text-youtube"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                   </div> 
                </div>
            </div>
        </div>
     </section>

     <section class="loc-cust">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
          <div class="location">
            <div class="location-icon">
              <a href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
            </div>
            <div class="location-address">
              <p><a href="#">{{$location[0]->value}}</a></p>
            </div>
          </div>
          </div>
        </div>
      </div>
     </section>
    </div>
  <!--main content area end--> 




@stop

@section('js')

@stop    