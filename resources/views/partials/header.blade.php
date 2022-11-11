@php

@endphp



<!------------ header start ----------->
<nav id="navbar-main" aria-label="Primary navigation" class="navbar navbar-main navbar-expand-lg navbar-theme-primary headroom navbar-light navbar-transparent navbar-custom">
      <div class="container position-relative">
        <a class="navbar-brand shadow-softs logo-bg custom-brand py-2 px-3 rounded border-light mr-lg-4" href="{{route('/')}}">
          <img class="navbar-brand-dark" src="{{ URL::asset('public/frontend/images/alpha-logo.png') }}" alt="Logo light">
          <img class="navbar-brand-light" src="{{ URL::asset('public/frontend/images/alpha-logo.png') }}" alt="Logo dark">
        </a>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="{{route('/')}}" class="navbar-brand shadow-soft py-2 px-3 rounded border border-light">
                  <img src="{{ URL::asset('public/frontend/images/alpha-logo.png') }}" alt="Themesberg logo">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <a href="#navbar_global" class="fas fa-times" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" title="close" aria-label="Toggle navigation"></a>
              </div>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-hover ml-auto mr-auto align-items-lg-center">
            <li class="nav-item dropdown">
              <a href="#" class="nav-link free-btn" data-toggle="dropdown">
                <span class="nav-link-inner-text">Free Study</span>
                <span class="fas fa-angle-down nav-link-arrow ml-2"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#">Course Wise</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">All Topics</a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link enroll-btn" data-toggle="dropdown">
                <span class="nav-link-inner-text">Enroll/Tutor</span>
                <span class="fas fa-angle-down nav-link-arrow ml-2"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#">Dropdown 1</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Dropdown 2</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Dropdown 3</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Dropdown 4</a>
                </li>
              </ul>
            </li>
            <li class="nav-item ">
              <a href="{{route('contact-us')}}" class="nav-link contact-btn">
                <span class="nav-link-inner-text">Contact</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link about" data-toggle="dropdown">
                <span class="nav-link-inner-text">About</span>
                <span class="fas fa-angle-down nav-link-arrow ml-2"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#">About The Tutor</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">Testimonials & Reviews</a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link ac" data-toggle="dropdown">
                <span class="nav-link-inner-text">A/C</span>
                <span class="fas fa-angle-down nav-link-arrow ml-2"></span>
              </a>
              <ul class="dropdown-menu">
                @if (Auth()->guard('frontend')->guest())
                <li>
                  <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" onclick="login();">Signin</a>
                </li>
                <li>
                  <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" onclick="signup();">Signup</a>
                </li>
                @else
                <li>
                  <a class="dropdown-item" href="#">Profile</a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">A/C</a>
                </li>
                @endif
              </ul>
            </li>
          </ul>
        </div>
        <div class="d-flex align-items-center">
          <button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        </div>
      </div>
    </nav>
    <!------------//header end ------------------>