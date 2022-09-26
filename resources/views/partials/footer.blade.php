@php
use App\Model\Category;
$categories = Category::where('status', '=', '1')->get();
@endphp




<footer id="footer">
    <div class="footer-container">
    <div class="container">
        <div class="row">
        <!-- -------------------storeinfo---------- -->
        <div id="ishistoreinfo" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <div id="ishistoreinfo-container" class="ishistoreinfo-inner">
            <a href="index.html" class="store-logo">
                <img src="{{ URL::asset('public/frontend/images/sf-removebg-preview.png') }}" style="max-width: 70px;" alt="footer-logo">
            </a>
            <div class="store-description">
                <p>Your one stop shopping solution for Homemade, Traditional and Specialty Foods.</p>
            </div>
            </div>
        </div>
        <div id="_mobile_storeinfo" class="block-contact col-md-12 col-sm-12 col-xs-12 footer-block"></div>
        <!-- -------------------myaccount---------- -->
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 links wrapper footer-block">
            <h3 class="h3 title_block hidden-md-down">Quick Links</h3>
            <div class="footer-title clearfix hidden-lg-up collapsed" data-target="#footer_account_list" data-toggle="collapse">
            <span class="h3">Quick Links</span>
            <span class="float-xs-right">
                <span class="navbar-toggler collapse-icons">
                <i class="material-icons add"></i>
                <i class="material-icons remove"></i>
                </span>
            </span>
            </div>              
            <ul id="footer_account_list" class="footer-dropdown collapse">
            
            <li>
                <a class="cms-page-link" href="{{route('about-us')}}">
                About Us
                </a>
            </li>
            <li>
                <a class="cms-page-link" href="{{route('recipe')}}">
                Recipe
                </a>
            </li>
            <li>
                <a class="cms-page-link" href="{{route('blog')}}">
                Blog
                </a>
            </li>
            
            </ul>
        </div>
        <!-- -------------------linklist---------- -->
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 links wrapper footer-block">
            <h3 class="h3 title_block hidden-md-down">Product</h3>
            <div class="footer-title clearfix hidden-lg-up collapsed" data-target="#footer_sub_menu_83280" data-toggle="collapse">
            <span class="h3 title_block">Product</span>
            <span class="navbar-toggler collapse-icons">
                <i class="material-icons add"></i>
                <i class="material-icons remove"></i>
            </span>
            </div>
            <ul id="footer_sub_menu_83280" class="footer-dropdown collapse">
                <?php
                $footer_subs= App\Model\Subcategory::where('status', '1')->inRandomOrder()->take('5')->get();
                ?>
                @forelse($footer_subs as $fs)
                <li>
                    <a class="cms-page-link" href="{{ route('product.subcat',['slug1' => $fs->category->slug, 'slug2' => $fs->slug]) }}">
                    
                    {{$fs->name}}
                    </a>
                </li>
                @empty
                @endforelse
            
            </ul>
        </div>
        <!-- -------------------contactblock ---------- -->
        <div id="_desktop_storeinfo" class="block-contact col-lg-3 col-md-12 col-sm-12 col-xs-12 footer-block">
            <h3 class="h3 title_block hidden-md-down">Store information</h3>             
            <div id="contact-info-container" class="footer-contact">
            <div class="block address col-lg-12 col-md-4 col-sm-4 col-xs-12">
                <span class="icon"><i class="fa fa-map-marker"></i></span>
                <div class="content"><address>{{$location[0]->value}}</address></div>
            </div>
            <div class="block phone col-lg-12 col-md-4 col-sm-4 col-xs-12">
                <span class="icon phone"><i class="fa fa-phone"></i></span>
                <div class="content">
                <a href="#">{{$location[1]->value}}</a>
                </div>
            </div>
            <div class="block email col-lg-12 col-md-4 col-sm-4 col-xs-12">
                <span class="icon"><i class="fa fa-envelope"></i></span>
                <div class="content">
                <a href="#">{{$location[2]->value}}</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="footer-after">
    <div class="container">
        <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!-- -------------------copyrights---------- -->
            <p class="footer-aftertext">
            © Copyright {{date('Y')}} {{ env('APP_NAME', 'Select Fresh') }}. All Rights Reserved. 
                <a class="_blank" href="http://thebrokenweb.com/" target="_blank">
                Design & Developed By TheBrokenWeb
                </a>
            </p>
        </div>
        <div class="col-lg-6 col-xs-12">
            <!-- -------------------payment block---------- -->
            <!-- <div class="paymentlogo-container">
            <img src="assets/images/paymenticon/1.png" alt="Discover">
            <img src="assets/images/paymenticon/2.png" alt="Visa">
            <img src="assets/images/paymenticon/3.png" alt="JCB">
            <img src="assets/images/paymenticon/4.png" alt="PayPal">
            <img src="assets/images/paymenticon/5.png" alt="Master Card">
            <img src="assets/images/paymenticon/6.png" alt="American Express">
            </div> -->
        </div>
        
            <script type="text/javascript">
                $("#ishispecialdeal .item").each(function() {
                var container = $(this).find('.countdown-container');
                var time = $(this).data('countdowntime');
                $(container).countdown(time, function(event) {
                    $(this).find(".countdown-days .data").html(event.strftime('%D'));
                    $(this).find(".countdown-hours .data").html(event.strftime('%H'));
                    $(this).find(".countdown-minutes .data").html(event.strftime('%M'));
                    $(this).find(".countdown-seconds .data").html(event.strftime('%S'));
                });
                });
                var specialdeals = $("#ishispecialdeals-carousel").owlCarousel({
                items:1,
                dots:true,
                rtl: $('html').attr('dir') == 'rtl'? true : false,
                });
            </script>
            </div>
        </div>
        </div>
    </div>
    </div>
    <a id="slidetop" href="#" ></a>
</footer>