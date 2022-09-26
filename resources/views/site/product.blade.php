@extends('layouts.main') 
@section('css')

@endsection
@section('content')
<!-- --------------------Breadcrumb------------ -->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        @if(isset($subcat))
        <h1 class="h1 category-title breadcrumb-title">{{ $subcat->name }}</h1>
        
        @elseif(isset($cat))
        <h1 class="h1 category-title breadcrumb-title">{{ $cat->name }}</h1>
        
        @endif
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void('0');">
            @if(isset($subcat))
            <span>{{ $subcat->name }}</span>
            
            @elseif(isset($cat))
            <span>{{ $cat->name }}</span>
            
            @endif   
            </a>
        </li>
        </ul>
    </nav>
</div>
<section class="product-grid-div">
    <div class="container">
        <!-- <h3 class="home-title"><span class="title-icon"><span></span></span>Latest Products</h3>  -->
        <div class="row">
        @forelse($products as $product)
            <div class="col-sm-3 my-grid"> 
                <div class="product-thumb">
                    <div class="item">
                        <div class="product-desc">
                        <div class="product-title"><a href="javascript:void('0');">{{$product->name}}</a></div>
                        
                        </div>
                        <div class="image">
                        <a href="#" class="thumbnail product-thumbnail">
                            <img src="{{ URL::asset('public/uploads/product/'.$product->photo) }}" alt="product-img">
                            <img class="product-img-extra change" alt="product-img" src="{{ URL::asset('public/uploads/product/'.$product->photo) }}">
                        </a>
                        
                        </div>
                        <div class="caption">    
                        
                        <p class="price">

                            <span class="price-sale">{{number_format($product->price,2)}}Rs </span>
                        </p>
                        <div class="btn-cart">
                            <a href="javascript:void('0');" data-button-action="add-to-cart" class="button sold-out">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="lblcart">net weight - {{$product->net_weight}}</span>
                                </br>
                                <span class="lblcart">Brand -{{$product->brand}}</span>
                            </a>
                        </div>

                        <form id='myform-grid{{$product->id}}' method='POST' class="quantity cart-form" action="">
                            @csrf
                            <input type='hidden' name='product_id' value="{{$product->id}}"  />
                            <input type='button' value='-' class='qtyminus minus' field='quantity' />
                            <input type='text' name='quantity' value='1' class='qty' />
                            <input type='button' value='+' class='qtyplus plus' field='quantity' />
                        
                            <button type="submit" class="btn btn-secondary btn-lg ">Add to Cart</button> 
                        </form>               
                        </div> 
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
        
    </div>
</section>

@stop
@section('js')

@endsection
