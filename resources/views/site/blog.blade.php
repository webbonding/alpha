@extends('layouts.main') 
@section('css')

@endsection
@section('content')
<!-- --------------------Breadcrumb------------ -->
<div class="breadcrumb-container">
    <nav data-depth="2" class="breadcrumb container">
        <h1 class="h1 category-title breadcrumb-title">Blog</h1>
        <ul>
        <li>
            <a href="{{route('/')}}">
            <span>Home</span>
            </a>
        </li>
        <li>
            <a href="{{'blog'}}">
            <span>Blog Article</span>
            </a>
        </li>
        </ul>
    </nav>
</div>
<section id="wrapper">
        <div class="container">
          <div class="row">                      
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-9"> 
              <div id="smartblogcat" class="block">
                <div class="sdsarticleCat clearfix row">
                  <div class="articleContent col-xl-6 col-lg-6 col-md-12">
                    <a href="#" title="Upon of seasons earth dominion">
                      <img alt="Upon of seasons earth dominion" src="{{ URL::asset('public/frontend/images/blog/milet.jpg') }}">
                    </a>
                  </div>
                  <div class="smartblog-desc col-xl-6 col-lg-6 col-md-12">
                    &nbsp;
                    <span class="author"><i class="fa fa-user"></i>&nbsp;&nbsp;Posted by: Admin </span>&nbsp;&nbsp;
                    <div class="sdsarticleHeader">
                      <p class='sdstitle_block'><a title="Upon of seasons earth dominion" href="#">WHY ADDING MILLET TO A REGULAR DIET CAN BE BENEFICIAL FOR OUR HEALTH???</a></p>
                    </div>
                    <!-- <span class="blogdetail">       
                      <span class="articleSection"><a href="#"><i class="fa fa-tags"></i>&nbsp;&nbsp;Uncategories</a></span>&nbsp;&nbsp;
                      <span class="blogcomment"><a title="0 Comments" href="#"><i class="fa fa-comments"></i>&nbsp;&nbsp;0  Comments</a></span>
                      &nbsp;
                      <span class="viewed"><i class="fa fa-eye"></i>&nbsp;&nbsp; views (0)</span>
                    </span> -->
                    <div class="sdsarticle-des">
                      <div class="clearfix">
                        <div class="lipsum">
                        Indian kitchens have proudly gone back to their roots and side by side I have also evolved a lot in recent years.
                        </div>
                      </div>
                    </div>
                    <div class="sdsreadMore">
                      <span class="more">
                        <a title="Upon of seasons earth dominion" href="blog_post.php" class="r_more btn-primary">Read more</a>
                      </span>
                    </div>
                  </div>
                </div>
               
                
               
                <div class="sdsarticleCat clearfix row">
                  <div class="articleContent col-xl-6 col-lg-6 col-md-12">
                    <a href="#" title="Nec intellegat deseruisse te" class="imageFeaturedLink">
                      <img  alt="Nec intellegat deseruisse te" src="{{ URL::asset('public/frontend/images/blog/flour.jpg') }}" class="imageFeatured">
                    </a>
                  </div>
                  <div class="smartblog-desc col-xl-6 col-lg-6 col-md-12">
                    &nbsp;
                    <span class="author"><i class="fa fa-user"></i>&nbsp;&nbsp;Posted by: Admin </span>&nbsp;&nbsp;
                    <div class="sdsarticleHeader">
                      <p class='sdstitle_block'><a title="Nec intellegat deseruisse te" href="#">ORGANIC FLOURS AND HEALTH </a></p>
                    </div>
                    <!-- <span class="blogdetail">       
                      <span class="articleSection"><a href="#"><i class="fa fa-tags"></i>&nbsp;&nbsp;Uncategories</a></span>&nbsp;&nbsp;
                      <span class="blogcomment"><a title="0 Comments" href="#"><i class="fa fa-comments"></i>&nbsp;&nbsp;0  Comments</a></span>
                      &nbsp;
                      <span class="viewed"><i class="fa fa-eye"></i>&nbsp;&nbsp; views (1)</span>
                    </span> -->
                    <div class="sdsarticle-des">
                      <div class="clearfix">
                        <div class="lipsum">
                        Throughout the history of mankind, grains were considered a staple for consuming a healthy and nutritious diet. 
                        </div>
                      </div>
                    </div>
                    <div class="sdsreadMore">
                      <span class="more">
                        <a title="Nec intellegat deseruisse te" href="blog_post1.php" class="r_more btn-primary">Read more</a>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="blog_pagination">
                <div class="pagination">
                  <div class="col-xl-4 col-lg-5 col-md-5 col-xs-12 pagination-desc">Showing 1 to 5 of 8 (1 Pages)</div>
                  <div class="col-xl-8 col-lg-7 col-md-7 col-xs-12 pagination-right">
                    <ul class="page-list clearfix">        
                      <li>
                        <a rel="prev" href="#" class="previous">
                          <i class="material-icons"></i><span class="pagination-lbl">Previous</span>
                        </a>
                      </li>                
                      <li class="current">
                        <a rel="nofollow" href="#" class="disabled js-search-link">1</a>
                      </li>                
                      <li>
                        <a rel="nofollow" href="#" class="js-search-link">2</a>
                      </li>                
                      <li>
                        <a rel="next" href="#" class="next js-search-link">
                          <span class="pagination-lbl">Next</span><i class="material-icons"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> 
            <div id="_desktop_right_column" class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
              <div id="right-column">
               
               
                
              </div>
            </div>           
          </div>
        </div>        
      </section>
@stop
@section('js')

@endsection
