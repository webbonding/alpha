<!DOCTYPE html>
<html lang="en">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
            var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? true : false; ?>';
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME', 'SELECT FRESH') }}</title>
		<meta name="title" content="Select Fresh">
        <meta name="keywords" content="Select Fresh">
        <meta name="description" content="Select Fresh">
        <meta property="og:title" content="Select Fresh" />
        <meta property="og:image" content="{{ URL::asset('public/frontend/images/og_image.jpg') }}" />
        <meta property="og:description" content="Select Fresh" />
        <!-- Chrome, Firefox OS and Opera -->
		<meta name="theme-color" content="#007038">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#007038">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#007038">

        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">

        <link rel="stylesheet" href="{{ URL::asset('public/frontend/custom/cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/custom/www.atlasestateagents.co.uk/css/tether.min.css') }}">
        <script type="text/javascript" src="{{ URL::asset('public/frontend/custom/www.atlasestateagents.co.uk/javascript/tether.min.js') }}"></script>
        
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/theme.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/style.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <!--fontawesome-4-->
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
        <link href="{{ URL::asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        
       	<link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/css/jquery-confirm.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/custom.css') }}">
        
        <style>
            .help-block{
                color:red;
            }    
        </style>
        <script type="text/javascript" src="{{ URL::asset('public/frontend/js/jquery.js') }}"></script>
        <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}"></script>
        
        <script src="{{ URL::asset('public/frontend/js/popper.min.js') }}"></script>
        <!----------slider/clients------>
        <script src="{{ URL::asset('public/frontend/js/slick.js') }}"></script>
        <!--<script src="{{ URL::asset('public/frontend/js/jquery.min.js') }}" type="text/javascript"></script>-->
        <script src="{{ URL::asset('public/frontend/js/datatables.min.js') }}" type="text/javascript"></script>

        <script src="{{ URL::asset('public/frontend/js/owl.carousel.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/animate.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/totalstorage.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/counter.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/parallax.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/bxslider.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/ishi.initialize.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/support.js') }}" type="text/javascript"></script>


        <script src="{{ URL::asset('public/frontend/custom/js/script.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ URL::asset('public/backend/js/jquery-confirm.js') }}"></script>
		


        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>

        @php
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        @endphp

        
        
        @yield('css')
    </head>
    <style>
  
    </style>
    <body id="index">
        <main>
            <div id="menu_wrapper" class=""></div>
            <!-- --------------------loader------------ -->
            <div id="spin-wrapper"></div>
            <div id="siteloader">
                <div class="loader"></div>
            </div>
            @php
            use App\Model\Settings;
            $social_link = Settings::where('module', '=', 'Social Link')->get();
            $location = Settings::where('module', '=', 'Location')->get();
            @endphp

            @include('partials.header')

            <div id="mobile_top_menu_wrapper" class="hidden-lg-up" style="display:none;">
                <div id="top_menu_closer">
                <i class="material-icons"></i>
                </div>
                <div class="js-top-menu mobile" id="_mobile_top_menu"></div>
            </div>

            @yield('content')
        </main>
            @include('partials.footer')

        
      	
		<!--/ ToTop trigger -->
      	<!--<script src="{{ URL::asset('public/frontend/js/jquery-1.11.3.min.js') }}"></script>-->
        
      
      
      
        <!-- <script>
            // open cart modal
            const cart = document.querySelector('#cart');
            const cartModalOverlay = document.querySelector('.cart-modal-overlay');

            cart.addEventListener('click', () => {
            if (cartModalOverlay.style.transform === 'translateX(-200%)'){
                cartModalOverlay.style.transform = 'translateX(0)';
            } else {
                cartModalOverlay.style.transform = 'translateX(-200%)';
            }
            })
            // end of open cart modal

            // close cart modal
            const closeBtn = document.querySelector ('#close-btn');

            closeBtn.addEventListener('click', () => {
            cartModalOverlay.style.transform = 'translateX(-200%)';
            });

            cartModalOverlay.addEventListener('click', (e) => {
            if (e.target.classList.contains('cart-modal-overlay')){
                cartModalOverlay.style.transform = 'translateX(-200%)'
            }
            })
            // end of close cart modal

            // add products to cart
            const addToCart = document.getElementsByClassName('add-to-cart');
            const productRow = document.getElementsByClassName('product-row');

            for (var i = 0; i < addToCart.length; i++) {
            button = addToCart[i];
            button.addEventListener('click', addToCartClicked)
            
            }

            function addToCartClicked (event) {
            button = event.target;
            var cartItem = button.parentElement;
            var price = cartItem.getElementsByClassName('product-price')[0].innerText;
            
            var imageSrc = cartItem.getElementsByClassName('product-image')[0].src;
            addItemToCart (price, imageSrc);
            updateCartPrice()
            }

            function addItemToCart (price, imageSrc) {
            var productRow = document.createElement('div');
            productRow.classList.add('product-row');
            var productRows = document.getElementsByClassName('product-rows')[0];
            var cartImage = document.getElementsByClassName('cart-image');
            
            for (var i = 0; i < cartImage.length; i++){
                if (cartImage[i].src == imageSrc){
                alert ('This item has already been added to the cart')
                return;
                }
            }
            
            var cartRowItems = `
            <div class="product-row">
                    <img class="cart-image" src="${imageSrc}" alt="">
                    <span class ="cart-price">${price}</span>
                    <input class="product-quantity" type="number" value="1">
                    <button class="remove-btn">Remove</button>
                    </div>
                    
                `
            productRow.innerHTML = cartRowItems;
            productRows.append(productRow);
            productRow.getElementsByClassName('remove-btn')[0].addEventListener('click', removeItem)
            productRow.getElementsByClassName('product-quantity')[0].addEventListener('change', changeQuantity)
            updateCartPrice()
            }
            // end of add products to cart

            // Remove products from cart
            const removeBtn = document.getElementsByClassName('remove-btn');
            for (var i = 0; i < removeBtn.length; i++) {
            button = removeBtn[i]
            button.addEventListener('click', removeItem)
            }

            function removeItem (event) {
            btnClicked = event.target
            btnClicked.parentElement.parentElement.remove()
            updateCartPrice()
            }

            // update quantity input
            var quantityInput = document.getElementsByClassName('product-quantity')[0];

            for (var i = 0; i < quantityInput; i++){
            input = quantityInput[i]
            input.addEventListener('change', changeQuantity)
            }

            function changeQuantity(event) {
            var input = event.target
            if (isNaN(input.value) || input.value <= 0){
                input.value = 1
            }
            updateCartPrice()
            }
            // end of update quantity input

            // update total price
            function updateCartPrice() {
            var total = 0
            for (var i = 0; i < productRow.length; i += 2) {
                cartRow = productRow[i]
            var priceElement = cartRow.getElementsByClassName('cart-price')[0]
            var quantityElement = cartRow.getElementsByClassName('product-quantity')[0]
            var price = parseFloat(priceElement.innerText.replace('$', ''))
            var quantity = quantityElement.value
            total = total + (price * quantity )
                
            }
            document.getElementsByClassName('total-price')[0].innerText =  '$' + total

            document.getElementsByClassName('cart-quantity')[0].textContent = i /= 2
            }
            // end of update total price

            // purchase items
            const purchaseBtn = document.querySelector('.purchase-btn');

            const closeCartModal = document.querySelector('.cart-modal');

            purchaseBtn.addEventListener('click', purchaseBtnClicked)

            function purchaseBtnClicked () {
            alert ('Thank you for your purchase');
            cartModalOverlay.style.transform= 'translateX(-100%)'
            var cartItems = document.getElementsByClassName('product-rows')[0]
            while (cartItems.hasChildNodes()) {
                cartItems.removeChild(cartItems.firstChild)
                
            }
            updateCartPrice()
            }
        </script> -->

        <script>
            
            $('.btn-number').click(function(e){
                e.preventDefault();
                
                fieldName = $(this).attr('data-field');
                type      = $(this).attr('data-type');
                var input = $("input[name='"+fieldName+"']");
                var currentVal = parseInt(input.val());
                if (!isNaN(currentVal)) {
                    if(type == 'minus') {
                        
                        if(currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        } 
                        if(parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if(type == 'plus') {

                        if(currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                        }
                        if(parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });
            $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
            });
            $('.input-number').change(function() {
                
                minValue =  parseInt($(this).attr('min'));
                maxValue =  parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());
                
                name = $(this).attr('name');
                if(valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if(valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                
                
            });        
            $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        </script>  
        <a href="https://chatwith.io/s/select-fresh" class="float" target="_blank">
        <i class="bi bi-whatsapp" style="position: relative;top: 17px;"></i>
        </a>
        <script>
            jQuery(document).ready(($) => {
                $('.quantity').on('click', '.plus', function(e) {
                    let $input = $(this).prev('input.qty');
                    let val = parseInt($input.val());
                    $input.val( val+1 ).change();
                });
        
                $('.quantity').on('click', '.minus', 
                    function(e) {
                    let $input = $(this).next('input.qty');
                    var val = parseInt($input.val());
                    if (val > 1) {
                        $input.val( val-1 ).change();
                    } 
                });
            });
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
    </body>
</html>