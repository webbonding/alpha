@extends('layouts.main')
@section('css')

@stop
@section('content')
<div class="breadcrumb-contact">
    <div class="container">
        <div class="breadcrumb_title" data-aos="fade-right">Subscribtion Plan</div>
        <div class="bread-crumb right-side" data-aos="fade-left">
            <ul>
                <li><a href="{{route('/')}}">HOME</a>/</li>
                <li><span>SUBSCRIBTION PLAN</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="dashboard mb-5">
    <div class="container">
        <div class="row">
            @include('partials.left')
            <div class="col-md-8 col-sm-8 tab_dsh_2">
                <div class="dash-right-sec">

                    <div class="successfull">
                        @if (Auth()->guard('frontend')->user()->payment_status == '1' && Auth()->guard('frontend')->user()->subscription_end >= Carbon\Carbon::now()->format('Y-m-d')) 
                        <div class="coupen">
                            <p>Your subscription plan has been successfully activated</p>
                        </div>
                        @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-sm-12">
                                    <div class="pricing-bg">
                                        <div class="card-body">
                                            <form id="rzp-footer-form" action="{!!route('dopayment')!!}" method="POST" style="width: 100%; text-align: center" >
                                                @csrf
                                                <div class="subscription-icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></div> 
                                                <h1 class="pay-heading">GET SUBSCRIPTION</h1>
                                                <div id="paymentPrevious">
                                                <div class="icon">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/gpay.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/ppay.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/phnpay.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/rupay.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/card.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/net.png') }}">
                                                    <img src="{{ URL::asset('public/frontend/images/icon/upi.png') }}">
                                                </div>

                                                <div class="p-text">
                                                    <p>Price: <span id="total">{{$subscription->value}}</span> INR/Year</p>
                                                    <input type="hidden" name="amount" id="amount" value="{{$subscription->value.'00'}}"/>
                                                    <input type="hidden" name="razorpay_key" id="razorpay_key" value="{{$razorpay->value}}"/>

                                                </div>
                                                <button class="pay-now" id="paybtn" type="submit">Click here to pay now</button> 
                                                </div>
                                                <div id="paymentDetail" style="display: none">
                                                    <div>paymentID: <span id="paymentID"></span></div>
                                                    <div>paymentDate: <span id="paymentDate"></span></div>
                                                    <a href="{{route('/')}}" class="small-button">Go to Home page</a>

                                                </div>

                                            </form>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


@stop
@section('js')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
$('#rzp-footer-form').submit(function (e) {
//        var amount = $('#amount').val();
////        alert(amount);
//        var button = $(this).find('button');
//        var parent = $(this);
//        button.attr('disabled', 'true').addClass('d-none');
//        $.ajax({
//            method: 'post',
//            url: this.action,
//            data: $(this).serialize(),
//            complete: function (r) {
//                console.log('complete');
//                console.log(r);
//            }
//        })
    return false;
})
</script>

<script>
    function padStart(str) {
        return ('0' + str).slice(-2)
    }

    function demoSuccessHandler(transaction) {
        // You can write success code here. If you want to store some data in database.
        var button = $(this).find('button');
        var parent = $(this);
        $('.button').addClass('d-none');
        $('#payment-success').removeClass('d-none');
        $('#paymentPrevious').addClass('d-none');
        $("#paymentDetail").removeAttr('style');
        $('#paymentID').text(transaction.razorpay_payment_id);
        var paymentDate = new Date();
        $('#paymentDate').text(
                padStart(paymentDate.getDate()) + '.' + padStart(paymentDate.getMonth() + 1) + '.' + paymentDate.getFullYear() + ' ' + padStart(paymentDate.getHours()) + ':' + padStart(paymentDate.getMinutes())
                );
        var coupen_id = $('#coupen_id').val();

        $.ajax({
            method: 'post',
            url: "{!!route('dopayment')!!}",
            data: {
                "_token": "{{ csrf_token() }}",
                "razorpay_payment_id": transaction.razorpay_payment_id,
            },
            complete: function (r) {

                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: 'your payment is successful',
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                    zIndex: '9999'
                });
                console.log('complete');
                console.log(r);
            }
        })
    }
</script>

<script>
    document.getElementById('paybtn').onclick = function () {
        var amount = $('#amount').val();
        var razorpay_key = $('#razorpay_key').val();
//        alert(amount);
        var options = {
            key: razorpay_key,
            amount: amount,

            description: 'Subscription',
            handler: demoSuccessHandler
        }
        window.r = new Razorpay(options);
        r.open()
    }
</script>
@stop

