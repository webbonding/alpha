@extends('layouts.main') 
@section('css')
<style>

</style>
@endsection
@section('content')
<!--main content-->
<!--breadcrumb-->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Recipe</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{route('recipe')}}">
            <span>Recipe</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<!--end breadcrumb-->

<section class="recipe-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="recipe-item">
                    <a href="receipe.php"><img src="{{ URL::asset('public/frontend/images/recipe.jpg') }}" alt=""></a>
                    <div class="ri-text">
                        <!-- <div class="cat-name">Desert</div> -->
                        <a href="receipe.php">
                            <h4 style="text-transform:uppercase;">Finger Millet Idli</h4>
                        </a>
                        <p>This recipe was tested  as a mid-day school meal and was found highly acceptable among children.</p>
                    </div>
                    
                </div>
                <div class="sdsreadMore">
                    <span class="more">
                    <a title="Nec intellegat deseruisse te" href="receipe.php" class="r_more btn-primary">Read more</a>
                    </span>
                </div>
                
            </div>
            
            
            <div class="col-lg-4 col-sm-6">
                <div class="recipe-item">
                    <a href="khichdi.php"><img src="{{ URL::asset('public/frontend/images/khichid.jpg') }}" alt=""></a>
                    <div class="ri-text">
                        <strong>by Dr Anitha Seetha, nutritionist, ICRISAT</strong>
                        <!-- <div class="cat-name">Desert</div> -->
                        <a href="khichdi.php">
                            <h4>MILLET KHICHDI</h4>
                        </a>
                        <p>This recipe was tested as a mid-day school meal and was found highly acceptable among children.</p>
                    </div>
                    
                </div>
                <div class="sdsreadMore">
                    <span class="more">
                    <a title="Nec intellegat deseruisse te" href="khichdi.php" class="r_more btn-primary">Read more</a>
                    </span>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="recipe-item">
                    <a href="mushroom.php"><img src="{{ URL::asset('public/frontend/images/mushroom.jpg') }}" alt=""></a>
                    <div class="ri-text">
                        <strong>by Chef Saransh Goila</strong>
                        <!-- <div class="cat-name">Desert</div> -->
                        <a href="mushroom.php">
                            <h4>MUSHROOM MILLET BIRYANI</h4>
                        </a>
                        
                    </div>
                    
                </div>
                <div class="sdsreadMore">
                    <span class="more">
                    <a title="Nec intellegat deseruisse te" href="mushroom.php" class="r_more btn-primary">Read more</a>
                    </span>
                    
                </div>
            </div>    
        </div>    
    </div>

            
            
            
    
                
            <!-- <div class="row">
            <div class="col-lg-12">
                <div class="recipe-pagination">
                    <a href="#" class="active">01</a>
                    <a href="#">02</a>
                    <a href="#">03</a>
                    <a href="#">04</a>
                    <a href="#">Next</a>
                </div>
            </div>
        </div> -->
</section>




<!--end main content-->


@stop
@section('js')


@endsection