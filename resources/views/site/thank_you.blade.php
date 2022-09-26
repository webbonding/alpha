@extends('layouts.main')

@section('content')
<!-------------------breadcrumb-------------------->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Thank You</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('thank-you')}}">
            <span>Thank You</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<!-- --------------------Breadcrumb------------ -->

      <!-- -----------Cart page----------- -->
      <section class="thank-u-body">
        <div class="container">
          <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 thanks-bg">
              <div class="thanks-page">
               <h1>THANK YOU!</h1>
               <p>For filling out your information!</p>
                 <a href="https://api.whatsapp.com/send?phone=+917894470085&amp;text={{$whatapp_message}}">Click Here <i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                 <h5 class="whats">To Send Enquiry On Whatsapp</h5> 
               </div>
            </div>
            <div class="col-sm-3"></div>
          </div>
      </div>  
    </section>

@stop

@section('js')

@stop    