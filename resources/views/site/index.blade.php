@extends('layouts.main') 
@section('css')

@endsection
@section('content')
<div id="top_home">
    <!-- -------------------slider----------- -->
    <section id="ishislider" class="ishislider-container owl-carousel">
    @forelse($sliders as $slider)
        <div class="item">
            <a href="#">
            <img src="{{ URL::asset('public/uploads/slider/'.$slider->photo) }}" alt="Slide-1" class="img-responsive">
            </a>
        </div>
    @empty
    @endforelse
    </section>
    <!--slider-->
    <!--------------------main category------------>
    <section class="main-categotys">
        <div class="container">
            <h3 class="home-title"><span class="title-icon"><span></span></span>Shop By Category</h3>
            <div class="row">
                @forelse($categories as $category)
                <div class="col-sm-4 col-xs-cat text-center"> 
                    <div class="itemss-thumb"> 
                    <img src="{{ URL::asset('public/uploads/categories/'.$category->photo) }}" class="img-fluid cate-img" alt="Image"> 
                    <a href="{{ route('product.category',$category->slug) }}" class="over-layer-cat"></a> </div> 
                    <div class="cat-content"> 
                        <h3> {{$category->name}} </h3> 
                    </div> 
                </div>
                @empty
                @endforelse
            </div>  
        </div> 
    </section>
    <!--------------------//main category----------->
    <!---------------------sub category------------->
    <section id="ishicategory" class="ishicategoryblock">
        <h3 class="home-title"><span class="title-icon"><span></span></span></h3>
        <div class="container">
        <div class="ishicategoryblock-carousel owl-carousel">
            @forelse($subcategories as $subcategory)
            <div class="image-container"> 
                <div class="item">
                <a href="{{ route('product.subcat',['slug1' => $subcategory->category->slug, 'slug2' => $subcategory->slug]) }}">
                    <img src="{{ URL::asset('public/uploads/subcategories/'.$subcategory->photo) }}" alt="category-1" class="img-responsive" />
                </a>
                <div class="text-container">
                {{$subcategory->name}}
                </div>
                </div>  
            </div> 
            @empty
            @endforelse
        </div>  
        </div>
    </section>
    <!---------------------//sub category------------->
     <!---------------------//cart modal------------>
     <div class="cart-modal-overlay">
          <div class="cart-modal">
            <i id="close-btn" class="fas fa-times"></i>
              <h1 class="cart-is-empty">Cart is empty</h1>
            
              <div class="product-rows">
              </div>
              <div class="total">
                <h1 class="cart-total">TOTAL</h1>
                  <span class="total-price">$0</span>
                    <button class="purchase-btn">PURCHASE</button>
              </div>
            </div>
      </div>
      <!--------------//cart modal---------->
      <!---------------------featured product------------->
      <section id="ishispecialproducts" class="container">
        <h3 class="home-title"><span class="title-icon"><span></span></span>Featured Product</h3>
        <div class="block_content row">
          <div id="ishispecialproducts-carousel" class="owl-carousel products">
          @forelse($products as $product)
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
                        <span class="lblcart">Brand - {{$product->brand}}</span>
                    </a>
                </div>

                    <form id='myform-carousel{{$product->id}}' method='POST' class="quantity cart-form" action="">
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
            @empty
            @endforelse
            
          </div>
        </div>
      </section>
      <!---------------------//featured product------------->
      <!---------------------lastest grid------------->
        <section class="product-grid-div">
            <div class="container">
                <h3 class="home-title"><span class="title-icon"><span></span></span>Latest Products</h3> 
                <div class="row">
                @forelse($latest_products as $product)
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
        <!---------------------//latest grid------------->

</div>

@stop
@section('js')

@endsection
