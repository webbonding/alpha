@extends('layouts.main') 
@section('css')
<style>
.col-sm-12 {
    width: 100% !important;
}
</style>
@endsection
@section('content')
<!--Start Breadcrumb-->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Checkout</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('checkout')}}">
            <span>Checkout</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<!--End Breadcrumb-->
<form id="check-out-form" action="{{Route('checkout')}}" method="POST" class="">
@csrf
<section id="wrapper"  class="top-wrapper">      
    <div class="container">
        <section id="content">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="accordion" id="accordionExample">
                    <section class="checkout-step card" id="checkout-personal-information-step">
                        <div data-toggle="collapse" data-target="#collapseone" aria-expanded="true" aria-controls="collapseone">
                            <h1 class="step-title h3">
                            Personal Information
                            </h1>
                        </div>
                        <div class="content collapse show" id="collapseone" data-parent="#accordionExample">
                            
                                <section>
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">Social title <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12 form-control-valign">
                                        <label class="radio-inline">
                                        <span class="custom-radio">
                                            <input name="social_title" type="radio" value="Mr." {{isset($user_information->social_title)?$user_information->social_title=='Mr.'?'checked':'':''}}>
                                            <span></span>
                                        </span>
                                        Mr.
                                        </label>
                                        <label class="radio-inline">
                                        <span class="custom-radio">
                                            <input name="social_title" type="radio" value="Mrs." {{isset($user_information->social_title)?$user_information->social_title=='Mrs.'?'checked':'':''}}>
                                            <span></span>
                                        </span>
                                        Mrs.
                                        </label>
                                        <div class="help-block" id="error-social_title"></div>
                                    </div>                            
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label required">Full Name <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="full_name" type="text" value="{{isset($user_information->full_name)?$user_information->full_name:$user_details->full_name}}" >
                                        <div class="help-block" id="error-full_name"></div>
                                    </div>                            
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label required">Email <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="email" type="email" value="{{isset($user_information->email)?$user_information->email:$user_details->email}}" >
                                        <div class="help-block" id="error-email"></div>
                                    </div>                            
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">Contact No. <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="phone"  type="tel" value="{{isset($user_information->phone)?$user_information->phone:$user_details->phone}}">
                                        <div class="help-block" id="error-phone"></div>
                                    </div>                            
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">Address <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="address" value="{{isset($user_information->address)?$user_information->address:''}}"  type="text">
                                        <div class="help-block" id="error-address"></div>
                                    </div>                            
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">City <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="city" value="{{isset($user_information->city)?$user_information->city:''}}"  type="text">
                                        <div class="help-block" id="error-city"></div>
                                    </div>                            
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">State <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <select class="form-control form-control-select" name="state" >
                                            <option value="" disabled="" selected="">-- Select Your State --</option>
                                            <option value="Andhra Pradesh" {{isset($user_information->state)&&$user_information->state=='Andhra Pradesh'?'selected':''}}>Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands" {{isset($user_information->state)&&$user_information->state=='Andaman and Nicobar Islands'?'selected':''}}>Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh" {{isset($user_information->state)&&$user_information->state=='Arunachal Pradesh'?'selected':''}}>Arunachal Pradesh</option>
                                            <option value="Assam" {{isset($user_information->state)&&$user_information->state=='Assam'?'selected':''}}>Assam</option>
                                            <option value="Bihar" {{isset($user_information->state)&&$user_information->state=='Bihar'?'selected':''}}>Bihar</option>
                                            <option value="Chandigarh" {{isset($user_information->state)&&$user_information->state=='Chandigarh'?'selected':''}}>Chandigarh</option>
                                            <option value="Chhattisgarh" {{isset($user_information->state)&&$user_information->state=='Chhattisgarh'?'selected':''}}>Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli" {{isset($user_information->state)&&$user_information->state=='Dadar and Nagar Haveli'?'selected':''}}>Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu" {{isset($user_information->state)&&$user_information->state=='Daman and Diu'?'selected':''}}>Daman and Diu</option>
                                            <option value="Delhi" {{isset($user_information->state)&&$user_information->state=='Delhi'?'selected':''}}>Delhi</option>
                                            <option value="Lakshadweep" {{isset($user_information->state)&&$user_information->state=='Lakshadweep'?'selected':''}}>Lakshadweep</option>
                                            <option value="Puducherry" {{isset($user_information->state)&&$user_information->state=='Puducherry'?'selected':''}}>Puducherry</option>
                                            <option value="Goa" {{isset($user_information->state)&&$user_information->state=='Goa'?'selected':''}}>Goa</option>
                                            <option value="Gujarat" {{isset($user_information->state)&&$user_information->state=='Gujarat'?'selected':''}}>Gujarat</option>
                                            <option value="Haryana" {{isset($user_information->state)&&$user_information->state=='Haryana'?'selected':''}}>Haryana</option>
                                            <option value="Himachal Pradesh" {{isset($user_information->state)&&$user_information->state=='Himachal Pradesh'?'selected':''}}>Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" {{isset($user_information->state)&&$user_information->state=='Jammu and Kashmir'?'selected':''}}>Jammu and Kashmir</option>
                                            <option value="Jharkhand" {{isset($user_information->state)&&$user_information->state=='Jharkhand'?'selected':''}}>Jharkhand</option>
                                            <option value="Karnataka" {{isset($user_information->state)&&$user_information->state=='Karnataka'?'selected':''}}>Karnataka</option>
                                            <option value="Kerala" {{isset($user_information->state)&&$user_information->state=='Kerala'?'selected':''}}>Kerala</option>
                                            <option value="Madhya Pradesh" {{isset($user_information->state)&&$user_information->state=='Madhya Pradesh'?'selected':''}}>Madhya Pradesh</option>
                                            <option value="Maharashtra" {{isset($user_information->state)&&$user_information->state=='Maharashtra'?'selected':''}}>Maharashtra</option>
                                            <option value="Manipur" {{isset($user_information->state)&&$user_information->state=='Manipur'?'selected':''}}>Manipur</option>
                                            <option value="Meghalaya" {{isset($user_information->state)&&$user_information->state=='Meghalaya'?'selected':''}}>Meghalaya</option>
                                            <option value="Mizoram" {{isset($user_information->state)&&$user_information->state=='Mizoram'?'selected':''}}>Mizoram</option>
                                            <option value="Nagaland" {{isset($user_information->state)&&$user_information->state=='Nagaland'?'selected':''}}>Nagaland</option>
                                            <option value="Odisha" {{isset($user_information->state)&&$user_information->state=='Odisha'?'selected':''}}>Odisha</option>
                                            <option value="Punjab" {{isset($user_information->state)&&$user_information->state=='Punjab'?'selected':''}}>Punjab</option>
                                            <option value="Rajasthan" {{isset($user_information->state)&&$user_information->state=='Rajasthan'?'selected':''}}>Rajasthan</option>
                                            <option value="Sikkim" {{isset($user_information->state)&&$user_information->state=='Sikkim'?'selected':''}}>Sikkim</option>
                                            <option value="Tamil Nadu" {{isset($user_information->state)&&$user_information->state=='Tamil Nadu'?'selected':''}}>Tamil Nadu</option>
                                            <option value="Telangana" {{isset($user_information->state)&&$user_information->state=='Telangana'?'selected':''}}>Telangana</option>
                                            <option value="Tripura" {{isset($user_information->state)&&$user_information->state=='Tripura'?'selected':''}}>Tripura</option>
                                            <option value="Uttar Pradesh" {{isset($user_information->state)&&$user_information->state=='Uttar Pradesh'?'selected':''}}>Uttar Pradesh</option>
                                            <option value="Uttarakhand" {{isset($user_information->state)&&$user_information->state=='Uttarakhand'?'selected':''}}>Uttarakhand</option>
                                            <option value="West Bengal" {{isset($user_information->state)&&$user_information->state=='West Bengal'?'selected':''}}>West Bengal</option>
                                        </select>
                                        <div class="help-block" id="error-state"></div>
                                    </div>                            
                                    </div>

                                    
                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">Zip/Postal Code <span class="danger">*</span></label>
                                    <div class="col-md-6 col-sm-12">
                                        <input class="form-control" name="zipcode" value="{{isset($user_information->zipcode)?$user_information->zipcode:''}}"  type="text">
                                        <div class="help-block" id="error-zipcode"></div>
                                    </div>                            
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-md-3 col-sm-12 form-control-label">Notes (Optional)</label>
                                    <div class="col-md-6 col-sm-12">
                                        <textarea class="form-control" name="notes" ></textarea>
                                        <div class="help-block" id="error-notes"></div>
                                    </div>                            
                                    </div>

                                    
                                </section>
                            
                        </div>
                    </section>   
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
            <section id="js-checkout-summary" class="card js-cart">
            <div class="card-block-summary-details">
                <div class="cart-summary-products">
                <div id="cart-summary-product-list">
                    <ul class="media-list">
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
                        <li class="media">
                            <div class="media-left">
                            <a href="javascript:void();" title="Omnis dicam mentitum">
                                <img src="{{ URL::asset('public/uploads/product/'.$product->photo) }}" alt="Omnis dicam mentitum">
                            </a>
                            </div>
                            <div class="media-body">
                            <span class="product-name">{{$product->name}}</span>
                            <span class="product-quantity">x{{$cart->quantity}}</span>
                            <span class="product-price float-xs-right">₹{{$cart->item_price}}</span>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>                    
                </div>
                <div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-products">
                <span class="label">Subtotal</span>
                <span class="value">₹{{$total}}</span>
                </div>
                <!-- <div class="cart-summary-line cart-summary-subtotals" id="cart-subtotal-shipping">
                <span class="label">Shipping</span>
                <span class="value">$7.00</span>
                </div> -->
            </div>
            <hr class="separator">
            <div class="cart-summary-totals">
                <div class="cart-summary-line cart-total">
                <span class="label">Total (tax excl.)</span>
                <span class="value">₹{{$total}}</span>
                </div>
                <!-- <div class="cart-summary-line">
                <span class="label sub">Taxes</span>
                <span class="value sub">$0.00</span>
                </div> -->
            </div>
            </section>
            <div id="block-reassurance" class="block-reassurance-cart text-center">
            <button class="placeorder btn btn-primary" name="continue" type="submit">Place Order</button>  
            </div>
            </div>
        </div>
        </section>
    </div>
</section>
<!--Start Checkout-->

    
</form>



@stop
@section('js')


@endsection