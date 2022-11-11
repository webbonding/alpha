<!DOCTYPE html>
<html lang="en">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
            var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? true : false; ?>';
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME', 'ALPHA MATHS') }}</title>
		<meta name="title" content="Alpha Maths">
        <meta name="keywords" content="Alpha Maths">
        <meta name="description" content="Alpha Maths">
        <meta property="og:title" content="Alpha Maths" />
        <meta property="og:image" content="{{ URL::asset('public/frontend/images/og_image.jpg') }}" />
        <meta property="og:description" content="Alpha Maths" />
        <meta name="theme-color" content="#d99bff">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#d99bff">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#d99bff">

        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
        
        <!-- <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/bootstrap.css') }}"> -->
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/neumorphism.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/icofont.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/icofont.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/fonts/icomoon/style.css') }}">

        
        <!--fontawesome-4-->
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
        <link href="{{ URL::asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        
       	<link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/stylesheet.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/nunito.css') }}">
        
        <style>
            .help-block{
                color:red;
            }    
        </style>
        

        @php
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        @endphp

        
        
        @yield('css')
    </head>
    <body>
        <div class="wrapper">
            
            @php
            use App\Model\Settings;
            $social_link = Settings::where('module', '=', 'Social Link')->get();
            $location = Settings::where('module', '=', 'Location')->get();
            @endphp

            @include('partials.header')
            @yield('content')

            <!-----sticky-section----->
            <section class="cellphone desktop-section-hide">
                <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 p-0">
                    <ul class="cellphone-ul">
                    <a href="/" target="_blank"></a>
                    <li>
                        <a href="#">
                        <span>
                            <i class="icofont-history"></i>
                        </span>
                        </a>
                    </li>
                    <li>
                    <a href="#">
                        <span>
                            <i class="fa fa-user-o"></i>
                        </span>
                    </a>
                    </li>
                    </ul> 
                </div>
                </div> 
            </div>      
            </section>  
        </div>
        @include('partials.footer')

        <script type="text/javascript" src="{{ URL::asset('public/frontend/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}"></script>
        
        <script src="{{ URL::asset('public/frontend/js/poppers.min.js') }}"></script>
        <!----------slider/clients------>
        <script src="{{ URL::asset('public/frontend/js/headroom.min.js') }}"></script>
        <script src="{{ URL::asset('public/frontend/js/datatables.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('public/frontend/js/smooth-scroll.polyfills.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/neumorphism.js') }}" type="text/javascript"></script>


        <script src="{{ URL::asset('public/frontend/custom/js/script.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}"></script>
		


        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>
      	
		<!-------- back to top js -------------->
        <script>
            $(window).scroll(function() {
            var height = $(window).scrollTop();
            if (height > 100) {
                $('#back2Top').fadeIn();
            } else {
                $('#back2Top').fadeOut();
            }
            });
            $(document).ready(function() {
            $("#back2Top").click(function(event) {
                event.preventDefault();
                $("html, body").animate({
                scrollTop: 0
                }, "slow");
                return false;
            });
            });
        </script>
        <!-- testimonials expand -->
        <script>
            $('.moreless-button').click(function() {
            $('.moretext').slideToggle();
            if ($('.moreless-button').text() == "Read more") {
            $(this).text("...")
            } else {
            $(this).text("....")
            }
        });
        </script>
        <!-- smooth scrooling -->
        <script>
            $(document).ready(function(){
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {
            
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();
            
                // Store hash
                var hash = this.hash;
            
                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){
            
                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
                } // End if
            });
            });
        </script>
        <!------------login-signup-modal------------>
        <script>
            function login() {
                $('.modal').modal('hide');
                $('#logIn').modal('show');
            }
            function signup(){
            $('.modal').modal('hide');
                $('#signUp').modal('show');
            }
            function forgot(){
            $('.modal').modal('hide');
                $('#forGot').modal('show');
            }
        </script>

        

        


        @yield('js')

        <!--gallery-->

        @if(Session::has('success'))
        <input type="hidden" id="success_msg" value="{{ Session::get('success') }}"/>
        <script>
            var success_msg = $('#success_msg').val();
            $.iaoAlert({
                type: "success",
                position: "top-right",
                mode: "dark",
                msg: success_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
        </script>
        @endif
        @if(Session::has('error'))
        <input type="hidden" id="error_msg" value="{{ Session::get('error') }}"/>
        <script>
            var error_msg = $('#error_msg').val();
            $.iaoAlert({
                type: "error",
                position: "top-right",
                mode: "dark",
                msg: error_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
                zIndex: '9999'
            });
        </script>
        @endif
        @if(Session::has('forgot_token'))
        <script>
            $('#reset_password_modal').modal('show');
        </script>
        @endif
    </body>
</html>