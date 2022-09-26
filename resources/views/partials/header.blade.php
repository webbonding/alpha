@php
use App\Model\Category;
$categories = Category::where('status', '=', '1')->get();
@endphp



<header id="header" class="home">
      <div class="header-nav">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 left-nav">
              <!-- Block search  -->
              <div id="_desktop_seach_widget">
                <div id="search_widget" class="search-widget">
                  <span class="search-logo hidden-lg-up">
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                      <symbol id="magnifying-glass" viewBox="0 0 910 910">
                        <title>magnifying-glass</title>
                        <path d="M495,466.2L377.2,348.4c29.2-35.6,46.8-81.2,46.8-130.9C424,103.5,331.5,11,217.5,11C103.4,11,11,103.5,11,217.5 S103.4,424,217.5,424c49.7,0,95.2-17.5,130.8-46.7L466.1,495c8,8,20.9,8,28.9,0C503,487.1,503,474.1,495,466.2z M217.5,382.9 C126.2,382.9,52,308.7,52,217.5S126.2,52,217.5,52C308.7,52,383,126.3,383,217.5S308.7,382.9,217.5,382.9z" />
                      </symbol>
                    </svg>
                    <svg class="icon" viewBox="0 0 30 30">
                      <use xlink:href="#magnifying-glass" x="22%" y="20%"></use>
                    </svg>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 right-nav">
              <div class="userinfo-inner"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="header-top">
        <div class="container">
          <div class="row">
            <!-- --------------------desktop_logo------------ -->
            <div id="desktop_logo" class="col-lg-3 col-md-5 col-sm-12 col-xs-12">
              <a href="index.php">
                <img class="logo img-responsive" src="{{ URL::asset('public/frontend/images/logo.png') }}"" style="max-width: 120px;" alt="Demo Shop">
              </a>
            </div>
            <div class="header-top-right offset-xl-2 col-xl-7 col-lg-9 col-md-7 col-sm-12 col-xs-12">
              <!-- --------------------services------------ -->
              <div id="ishiservices" class="ishiservicesblock">
                <div class="ishiservices owl-carousel">
                  <div class="icons_container">
                    <a href="{{$social_link[0]->value}}">
                      <div class="icon facebook">
                        <span>
                          <i class="fab fa-facebook-f"></i>
                    </a>
                    </span>
                  </div>
                  <a href="{{$social_link[3]->value}}">
                    <div class="icon instagram">
                      <span>
                        <i class="fab fa-instagram"></i>
                  </a>
                  </span>
                </div>
                <div class="icons_container">
                  <a href="{{$social_link[4]->value}}">
                    <div class="icon whatsapp">
                      <span>
                        <i class="fab fa-whatsapp"></i>
                  </a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <div class="nav-full-width">
        <div class="container">
          <div class="row">
            <!-- ------------------mega menu----------- -->
            <div id="_desktop_top_menu" class="menu js-top-menu hidden-sm-down">
              <ul class="top-menu" id="top-menu" data-depth="0">
                <li class="cms-page" id="category-12">
                  <a class="dropdown-item" href="{{route('/')}}" data-depth="0"> Home </a>
                </li>
                <li class="category" id="category-3">
                  <a class="dropdown-item" href="javascript:void('0')" data-depth="0">Products</a>
                  <span class="float-xs-right hidden-lg-up">
                    <span data-target="#top_sub_menu_37079" data-toggle="collapse" class="navbar-toggler collapse-icons">
                      <i class="material-icons add"></i>
                      <i class="material-icons remove"></i>
                    </span>
                  </span>
                  <div class="popover sub-menu collapse" id="top_sub_menu_37079">
                    <ul class="top-menu" data-depth="1">
                      @forelse($categories as $category)
                        <li class="category" id="category-{{$category->id}}">
                          <a class="dropdown-item dropdown-submenu" href="{{ route('product.category',$category->slug) }}" data-depth="1"> {{$category->name}} </a>
                          <span class="float-xs-right hidden-lg-up">
                            <span data-target="#top_sub_menu_40183{{$category->id}}" data-toggle="collapse" class="navbar-toggler collapse-icons">
                              <i class="material-icons add"></i>
                              <i class="material-icons remove"></i>
                            </span>
                          </span>
                          @if(count($category->subs) > 0)
                          <div class="collapse" id="top_sub_menu_40183{{$category->id}}">
                            <ul class="top-menu" data-depth="2">
                              @foreach($category->subs as $subcat)
                              <li class="category" id="category-5">
                                <a class="dropdown-item" href="{{ route('product.subcat',['slug1' => $subcat->category->slug, 'slug2' => $subcat->slug]) }}" data-depth="2"> {{$subcat->name}} </a>
                              </li>
                              @endforeach
                            </ul>
                          </div>
                          @endif
                        </li>
                      @empty
                      @endforelse
                      

                    </ul>
                  </div>
                </li>
                <li class="cms-page" id="cms-page-1">
                  <a class="dropdown-item" href="{{route('blog')}}" data-depth="2"> Blog </a>
                </li>
                <li class="cms-page" id="cms-page-1">
                  <a class="dropdown-item" href="{{route('recipe')}}" data-depth="2"> Recipe </a>
                </li>
                <li class="cms-page" id="cms-page-1">
                  <a class="dropdown-item" href="{{route('about-us')}}" data-depth="0"> About Us </a>
                </li>
                <li class="cms-page" id="cms-page-1">
                  <a class="dropdown-item" href="{{route('contact-us')}}" data-depth="0"> Contact us </a>
                </li>

              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="contact-num">
              <div class="call-img"></div>
              <a href="tel:917894470085">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                </svg>
                <div class="call-num">{{$location[1]->value}}
              </a>
            </div>
          </div>
          @php
          use Illuminate\Support\Facades\Cookie;
          if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_selectfresh')) {
          $user_id = Cookie::get('guest_user_selectfresh');
          } else if(!Auth()->guard('frontend')->guest()) {
          $user_id = Auth()->guard('frontend')->user()->id;
          }else{
          $user_id=0;
          }
          if($user_id!==0){
          $cart_count=App\Model\Cart::where('user_id','=',$user_id)->wherestatus('1')->count();
          }else{
          $cart_count=0;
          }
          @endphp
          <a href="{{route('cart')}}">
            <div class="cart-btn">
              <i id="cart" class="fas fa-shopping-cart"></i>
              <span class="cart-quantity cart_count">{{$cart_count}}</span>
            </div>
          </a>
          @if (Auth()->guard('frontend')->guest())
          <a href="{{route('signup')}}">
          <div class="cart-btn">
            <i id="log" class="fa fa-user"></i><span class="button-text-reg">Registration</span>
          </div>
          </a>
          <a href="{{route('login')}}">
          <div class="cart-btn">
            <i id="log" class="fa fa-lock"></i><span class="button-text-reg">Log In</span>
          </div>
          </a>
          @else
          <a href="{{route('dashboard')}}">
          <div class="cart-btn">
            <i id="log" class="fa fa-user"></i><span class="button-text-reg">Dashboard</span>
          </div>
          </a>
          @endif

          <!-- ------------------mobile media--------- -->
          <div id="menu-icon" class="menu-icon hidden-lg-up">
            <i class="bi bi-border-width" style="font-size: 25px;"></i>
          </div>
          <div id="_mobile_cart"></div>
          <!-- <div id="_mobile_seach_widget"></div> -->
          <div class="clearfix"></div>
        </div>
      </div>
      </div>
    </header>