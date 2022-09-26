@extends('layouts.main')

@section('content')
<!-------------------breadcrumb-------------------->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">About Us</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('about-us')}}">
            <span>About Us</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<!-- --------------------Breadcrumb------------ -->

      <!-- -----------Cart page----------- -->
      <section id="wrapper">
        <div class="container">
          <div id="content-wrapper" class="col-xs-12">
            <section id="main">
              <div class="about-page">    
                <div class="about-container">
                  <h2 class="home-title">Story Block</h2>
                  <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="about-us">
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam 
                                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
                                erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci 
                                tation ullamcorper suscipit lobortis nisl ut aliquip.
                            </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam 
                                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam 
                                erat volutpat. Ut wisi enim ad minim veniam,
                            </p>
                            <p>
                                quis nostrud exercitation ullamcorper suscipit lobortis nisl ut aliquip.
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">                                
                        <a href="#"><img alt="about-img" src="{{ URL::asset('public/frontend/images/aboutus.jpg') }}"></a>
                    </div>
                  </div>
                </div>              
               
                <div class="about-services">
                  <div class="row">
                   
                   
                   
                  </div>
                </div>                  
              </div>
            </section>
          </div>
        </div>
      </section>

@stop

@section('js')

@stop    