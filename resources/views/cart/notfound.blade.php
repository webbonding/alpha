@extends('layouts.main')

@section('content')
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Cart</h1>
        <ul>
        <li>
            <a href="#">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="#">
            <span>Cart</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<center>
<div class="body_content padding-50 hg_section" style="margin:25px 0px;">
    <section class="cart_main notifi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 rounded shadow-sm">
                    <!-- Shopping cart table -->
                    <div class="notifi_inner">
                        <div class="notfound">
                            <div class="notfound-404">
                                <h1>Whoops!</h1>
                            </div>
                            <h2>We are sorry, No item found on your cart !</h2>
                            <p>Please click below button for continue to shopping. <i class="icofont-shopping-cart"></i></p>
                            <a href="{{ Route('/') }}" class="btn btn-secondary">Continue to Shopping</a>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </div>
    </section>
</div>
</center>
@stop