@extends('layouts.main')
@section('content')   
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Cart</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('cart')}}">
            <span>Cart</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<section id="wrapper">
    <div class="container">
        <div class="row">
        <div id="content-wrapper" class="col-12 top-wrapper">
            <section id="main">
            <div class="cart-grid row">
                <!-- Left Block: cart product informations & shpping -->
                <div class="cart-grid-body col-xs-12 col-lg-8">
                <!-- cart products detailed -->
                <div class="card cart-container">
                    <div class="card-block">
                    <h1 class="h1">Shopping Cart</h1>
                    </div>
                    @php
                    $total=0;
                    $item=0;
                    @endphp
                    @CSRF
                    @forelse($carts as $cart)
                    @php
                    $item++;
                    $total+=($cart->item_price*$cart->quantity);
                    $product=App\Model\Product::where('id','=',$cart->product_id)->first();
                    
                    @endphp
                    <hr class="separator">

                    <div class="cart-overview js-cart" data-refresh-url="">
                    <ul class="cart-items">
                        <li class="cart-item">
                        <div class="product-line-grid row">
                            <!--  product left content: image-->
                            <div class="product-line-grid-left col-md-2 col-xs-4">
                            <span class="product-image media-middle">
                                <img src="{{ URL::asset('public/uploads/product/'.$product->photo) }}" alt="Simul dolorem voluptaria">
                            </span>
                            </div>

                            <!--  product left body: description -->
                            <div class="product-line-grid-body col-md-5 col-xs-8">
                            <div class="product-line-info">
                                <a class="label" href="javascript:void('0');" data-id_customization="0">{{$product->name}}</a>
                            </div>
                            <p class="product-desc">
                                
                            </p>
                            <div class="product-line-info product-price h5">
                                <div class="current-price">
                                <span class="price">₹{{$cart->item_price}}</span>
                                </div>
                            </div>
                            <div class="product-line-info">
                                <span class="label">Net Weight:</span>
                                <span class="value">{{$product->net_weight}}</span>
                            </div>
                            <div class="product-line-info">
                                <span class="label">Brand:</span>
                                <span class="value">{{$product->brand}}</span>
                            </div>
                            </div>

                            <!--  product left body: description -->
                            <div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">
                            <div class="row">
                                <div class="product_qty_price col-md-10 col-xs-10">
                                <div class="row">
                                    <div class="col-md-6 col-xs-6 qty">
                                    <!-- <input name="quantity" value="1" size="2" class="form-control input-quantity" type="text"> -->
                                    <select classname="select-board-size" id="select-qty" onchange="changeQuantity(this,{{$cart->id}});">
                                        <?php
                                        for($i=1;$i<=200;$i++){
                                        ?>
                                        <option value="{{$i}}" {{($cart->quantity==$i)?'selected':''}}>{{$i}}</option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                    </div>
                                    <div class="col-md-6 col-xs-6 price">
                                    <span class="product-price">
                                    ₹{{$cart->item_price}}
                                    </span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-2 col-xs-2 text-xs-center cart-line-product">
                                    <div class="cart-line-product-actions">
                                        <a href="javascript:void(0);" onclick="removeCart('{{$cart->product_id}}', this);" class= "remove-from-cart">
                                            <i class="material-icons float-xs-left">delete</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        </li>
                    </ul>
                    </div>
                    @empty
                    <tr>
                        <td colspan="5"> No product found in cart.</td>  
                    </tr>

                    @endforelse
                    
                </div>

                <a class="btn btn-primary" href="{{route('/')}}">
                    <i class="fa fa-angle-right"></i>Continue shopping
                </a>
                </div>

                <!-- Right Block: cart subtotal & cart total -->
                <div class="cart-grid-right col-xs-12 col-lg-4">
                <div class="card cart-summary">
                    <div class="cart-detailed-totals">
                    <div class="card-block">
                        <div class="cart-summary-line" id="cart-subtotal-products">
                        <span class="label js-subtotal">
                            {{$item}} item
                        </span>
                        <span class="value">₹{{$total}}</span>
                        </div>
                        <!-- <div class="cart-summary-line" id="cart-subtotal-shipping">
                        <span class="label">
                            Shipping
                        </span>
                        <span class="value">₹0.00</span>
                        <div><small class="value"></small></div>
                        </div> -->
                    </div>
                    <hr class="separator">
                    <div class="card-block">
                        <div class="cart-summary-line cart-total">
                        <span class="label">Total (tax excl.)</span>
                        <span class="value">₹{{$total}}</span>
                        </div>

                        <div class="cart-summary-line">
                        <small class="label">Taxes</small>
                        <small class="value">₹0.00</small>
                        </div>
                    </div>
                    <hr class="separator">
                    </div>              
                    <div class="checkout cart-detailed-actions card-block">
                    <div class="text-sm-center">
                        <a href="{{route('checkout')}}" class="btn btn-primary">Proceed to checkout</a>
                    </div>
                    </div>
                </div>
                <div id="block-reassurance" class="block-reassurance-cart">
                    <ul>
                    <li>
                        <div class="block-reassurance-item">
                        <img src="{{ URL::asset('public/frontend/images/block-reassurance/1.png') }}" alt="Security policy (edit with Customer reassurance module)">
                        <span class="h6">Security policy (edit with Customer reassurance module)</span>
                        </div>
                    </li>
                    <li>
                        <div class="block-reassurance-item">
                        <img src="{{ URL::asset('public/frontend/images/block-reassurance/2.png') }}" alt="Delivery policy (edit with Customer reassurance module)">
                        <span class="h6">Delivery policy (edit with Customer reassurance module)</span>
                        </div>
                    </li>
                    <li>
                        <div class="block-reassurance-item">
                        <img src="{{ URL::asset('public/frontend/images/block-reassurance/3.png') }}" alt="Return policy (edit with Customer reassurance module)">
                        <span class="h6">Return policy (edit with Customer reassurance module)</span>
                        </div>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </section>
        </div>
        </div>
    </div>
</section>

@endsection

