@extends('layouts.main')
@section('content')
@section('canonical_tag_href', 'https://epdworld.com/')
@section('title', 'Top Product Distribution Solutions')
@section('meta_descriptoion', 'Explore EPD World For enhance your business with exclusive deals and quality offerings. So, don’t miss the chance.')
<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->
    <div id="none" class="site-content" tabindex="-1">
        <div class="container">
            <div id="none" class="content-area">
                <main id="main" class="site-main">
                    <div class="home-v2-slider">
                        <!-- ========================================== SECTION – HERO : END========================================= -->
                        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                            @foreach ($banner as $key => $ban)
                            <div class="item" style="background-image: url({!! $ban->image !!});">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                {!! $ban->description !!}
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                            @endforeach
                        </div><!-- /.owl-carousel -->
                        <!-- ========================================= SECTION – HERO : END ========================================= -->
                    </div><!-- /.home-v1-slider -->
                    <div class="home-v2-ads-block animate-in-view fadeIn animated" data-animation=" animated fadeIn">
                        <div class="ads-block row">
                            <div class="ad col-xs-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left media-middle"><img class="lazy" width="100%" height="100%" data-src="images/ads-block/1.webp" alt="" />
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="ad-text">
                                            Catch Big<br> <strong>Deals </strong>of the<br> Sandals
                                        </div>
                                        <div class="ad-action">
                                            <a href="https://epdworld.com/category-detail/10?name=sandals">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ad col-xs-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left media-middle"><img class="lazy" width="100%" height="100%" data-src="images/ads-block/2.webp" alt="" />
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="ad-text">
                                            Women's <br> Tote <strong>Bags</strong>
                                        </div>
                                        <div class="ad-action">
                                            <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="products-carousel-tabs animate-in-view fadeIn animated" data-animation="fadeIn">
                        <h2 class="sr-only">Product Carousel Tabs</h2>
                        <ul class="nav nav-inline">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-products-1" data-toggle="tab">Recently Viewed
                                    Products
                                </a>
                            </li>
                        </ul><!-- /.nav -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-products-1" role="tabpanel">
                                <section class="section-products-carousel">
                                    <div class="home-v2-owl-carousel-tabs">
                                        <div class="woocommerce columns-3">
                                            <div class="products owl-carousel home-v2-carousel-tabs products-carousel columns-3">
                                    @foreach ($product_all as $pro)
                                    {{-- @dump($pro->categorys) --}}
                                    {{-- @php
                                        $cat = DB::table('categories')->where('id', $pro->categories)->first();
                                    @endphp --}}
                                    <div class="product first">
                                        <div class="product-outer">
                                            <div class="product-inner">
                                                <span class="loop-product-categories"><a
                                                        href="" rel="tag">{!! $pro->categorys->name !!}</a></span>
                                                @if(empty($pro->slug))
                                                    <a href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}">
                                                        <h3>{!! $pro->product_title !!}</h3>
                                                        <div class="product-thumbnail">
                                                            <img data-src="{{ asset($pro->image) }}"
                                                                data-echo="{!! asset($pro->image) !!}"
                                                                class="lazy img-responsive" alt="">
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}">
                                                        <h3>{!! $pro->product_title !!}</h3>
                                                        <div class="product-thumbnail">
                                                            <img data-src="{{ asset($pro->image) }}"
                                                                data-echo="{!! asset($pro->image) !!}"
                                                                class="lazy img-responsive" alt="">
                                                        </div>
                                                    </a>
                                                @endif

                                                <div class="price-add-to-cart">
                                                    <span class="price">
                                                        <span class="electro-price">
                                                            <ins><span class="amount">
                                                                    ${!! $pro->price !!}</span></ins>
                                                            <div class="ship-box">
                                                                <div class="ship-detail">
                                                                  <!--<i class="fa-solid fa-truck"></i>-->
                                                                  Free Shipping - 12-day delivery
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </span>
                                                    @if(empty($pro->slug))
                                                        <a rel="nofollow" href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}"
                                                            class="button add_to_cart_button">Add to cart</a>
                                                    @else
                                                        <a rel="nofollow" href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}"
                                                            class="button add_to_cart_button">Add to cart</a>
                                                    @endif
                                                </div><!-- /.price-add-to-cart -->

                                                {{-- <div class="hover-area">
                                                    <div class="action-buttons">

                                                        <a href="#" rel="nofollow" class="add_to_wishlist">
                                                            Wishlist</a>

                                                        <a href="compare.html" class="add-to-compare-link">
                                                            Compare</a>
                                                    </div>
                                                </div> --}}
                                            </div><!-- /.product-inner -->
                                        </div><!-- /.product-outer -->
                                    </div><!-- /.product -->
                                    @endforeach
                                            </div><!-- /.products -->
                                        </div>
                                    </div>
                                </section>
                            </div><!-- /.tab-pane -->
                            {{--<div class="tab-pane" id="tab-products-2" role="tabpanel">
                                    <section class="section-products-carousel">
                                    <div class="home-v2-owl-carousel-tabs">
                                        <div class="woocommerce columns-3">
                                            <div class="products owl-carousel home-v2-carousel-tabs products-carousel columns-3">
                                                <div class="product first">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html" rel="tag">Audio
                                                                    Speakers</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Wireless Audio System Multiroom 360</h3>
                                                                <div class="product-thumbnail">
                                                                    <img  data-src="images/products/3.jpg"
                                                                        data-echo="images/products/3.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product ">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Laptops</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Tablet Thin EliteBook Revolve 810 G6</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/1.jpg"
                                                                        data-echo="images/products/1.jpg"
                                                                        class="img-responsive lazy" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product last">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Headphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Purple Solo 2 Wireless</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/5.jpg"
                                                                        data-echo="images/products/5.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product first">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Laptops</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Tablet Red EliteBook Revolve 810 G2</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/2.jpg"
                                                                        data-echo="images/products/2.jpg"
                                                                        class="img-responsive lazy" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product ">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Headphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>White Solo 2 Wireless</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/newProducts/3.jpg"
                                                                        data-echo="images/newProducts/3.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product last">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Smartphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Smartphone 6S 32GB LTE</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/newProducts/4.jpg"
                                                                        data-echo="images/newProducts/4.jpg"
                                                                        class="img-responsive lazy" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->
                                            </div><!-- /.products -->
                                        </div>
                                    </div>
                                </section>
                                </div><!-- /.tab-pane -->

                            <div class="tab-pane" id="tab-products-3" role="tabpanel">
                                <section class="section-products-carousel">
                                    <div class="home-v2-owl-carousel-tabs">
                                        <div class="woocommerce columns-3">


                                            <div
                                                class="products owl-carousel home-v2-carousel-tabs products-carousel columns-3">


                                                <div class="product first">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html" rel="tag">Audio
                                                                    Speakers</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Wireless Audio System Multiroom 360</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/3.jpg"
                                                                        data-echo="images/products/3.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product ">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Laptops</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Tablet Thin EliteBook Revolve 810 G6</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/1.jpg"
                                                                        data-echo="images/products/1.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product last">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Headphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Purple Solo 2 Wireless</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/5.jpg"
                                                                        data-echo="images/products/5.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product first">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Laptops</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Tablet Red EliteBook Revolve 810 G2</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/products/2.jpg"
                                                                        data-echo="images/products/2.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product ">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Headphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>White Solo 2 Wireless</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/newProducts/3.jpg"
                                                                        data-echo="images/newProducts/3.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount">
                                                                                $1,999.00</span></ins>
                                                                        <del><span class="amount">$2,299.00</span></del>
                                                                        <span class="amount"> </span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->


                                                <div class="product last">
                                                    <div class="product-outer">
                                                        <div class="product-inner">
                                                            <span class="loop-product-categories"><a
                                                                    href="product-category.html"
                                                                    rel="tag">Smartphones</a></span>
                                                            <a href="single-product.php">
                                                                <h3>Smartphone 6S 32GB LTE</h3>
                                                                <div class="product-thumbnail">
                                                                    <img data-src="images/newProducts/4.jpg"
                                                                        data-echo="images/newProducts/4.jpg"
                                                                        class="lazy img-responsive" alt="">
                                                                </div>
                                                            </a>

                                                            <div class="price-add-to-cart">
                                                                <span class="price">
                                                                    <span class="electro-price">
                                                                        <ins><span class="amount"> </span></ins>
                                                                        <span class="amount"> $1,999.00</span>
                                                                    </span>
                                                                </span>
                                                                <a rel="nofollow" href="single-product.php"
                                                                    class="button add_to_cart_button">Add to cart</a>
                                                            </div><!-- /.price-add-to-cart -->

                                                            <div class="hover-area">
                                                                <div class="action-buttons">

                                                                    <a href="#" rel="nofollow" class="add_to_wishlist">
                                                                        Wishlist</a>

                                                                    <a href="compare.html" class="add-to-compare-link">
                                                                        Compare</a>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.product-inner -->
                                                    </div><!-- /.product-outer -->
                                                </div><!-- /.product -->
                                            </div><!-- /.products -->
                                        </div>
                                    </div>
                                </section>
                            </div><!-- /.tab-pane --> --}}
                        </div><!-- /.tab-content -->
                    </section><!-- /.products-carousel-tabs -->
                </main><!-- #main -->
            </div><!-- #primary -->



        </div><!-- .container -->
    </div><!-- #content -->
    <section class="top_products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-products-content">
                        <div class="top-products-heading">
                            <h4>
                                Top Categories
                            </h4>
                        </div>

                        <div class="topProducts owl-carousel owl-theme">


                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/4?name=slippers">
                                            <img data-src="{!! asset('images/c-1.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/4?name=slippers">Slippers</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/11?name=heeled-sandals">
                                            <img data-src="{!! asset('images/c-2.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/11?name=heeled-sandals">Heeled Sandals</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">
                                            <img data-src="{!! asset('images/c-3.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">Women's Tote Bags</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">
                                            <img data-src="{!! asset('images/c-4.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">Dress Shoes & Oxfords</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/17?name=sports-socks">
                                            <img data-src="{!! asset('images/c-5.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/17?name=sports-socks">Sports Socks</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">
                                            <img data-src="{!! asset('images/c-6.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">Fashion Jewelry Jewelry Sets</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>


                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/25?name=body-stocking">
                                            <img data-src="{!! asset('images/c-7.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/25?name=body-stocking">Body Stocking</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">
                                            <img data-src="{!! asset('images/c-8.jpg') !!}" class="lazy img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">Bikinis & Beachwear</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>




                            {{-- <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="#">
                                            <img data-src="images/top1.png" class="img-fluid lazy" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="#">Shapewear (37)</a>
                                    </div>
                                    <div class="totalProducts">
                                        <p>
                                            37 products
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="#">
                                            <img data-src="images/top1.png" class="img-fluid lazy" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="#">Shapewear (37)</a>
                                    </div>
                                    <div class="totalProducts">
                                        <p>
                                            37 products
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="#">
                                            <img data-src="images/top1.png" class="img-fluid lazy" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="#">Shapewear (37)</a>
                                    </div>
                                    <div class="totalProducts">
                                        <p>
                                            37 products
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="#">
                                            <img data-src="images/top1.png" class="img-fluid lazy" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="#">Shapewear (37)</a>
                                    </div>
                                    <div class="totalProducts">
                                        <p>
                                            37 products
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="#">
                                            <img data-src="images/top1.png" class="img-fluid lazy" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="#">Shapewear (37)</a>
                                    </div>
                                    <div class="totalProducts">
                                        <p>
                                            37 products
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-tabs-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                        <div class="top-products-heading">
                            <h4>
                                Our Products
                            </h4>
                        </div>


                </div>

                <div class="col-lg-12">
                    <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

                        <ul class="products columns-3">
                            @foreach ($product as $pro)
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">{!! $pro->categorys->name !!}</a></span>
                                        @if(empty($pro->slug))
                                            <a href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}">
                                                <h3>{!! $pro->product_title !!}</h3>
                                                <div class="product-thumbnail"> <img data-echo="{!! asset($pro->image) !!}"
                                                        data-src="{{ asset($pro->image) }}" alt="" class="lazy"> </div>
                                            </a>
                                        @else
                                            <a href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}">
                                                <h3>{!! $pro->product_title !!}</h3>
                                                <div class="product-thumbnail"> <img data-echo="{!! asset($pro->image) !!}"
                                                        data-src="{{ asset($pro->image) }}" alt="" class="lazy"> </div>
                                            </a>
                                        @endif

                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;{!! $pro->price !!}</span></ins>
                                                    <div class="ship-box">
                                                        <div class="ship-detail">
                                                          <i class="fa-solid fa-truck"></i>  Free Shipping - 12-day delivery
                                                        </div>
                                                    </div>
                                                    {{-- <del><span class="amount">&#036;2,299.00</span></del> --}}
                                                </span>
                                            </span>
                                                @if(empty($pro->slug))
                                                    <a rel="nofollow" href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}"
                                                        class="button add_to_cart_button">Add to cart</a>
                                                @else
                                                    <a rel="nofollow" href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}"
                                                        class="button add_to_cart_button">Add to cart</a>
                                                @endif
                                                </div>


                                        <!-- /.price-add-to-cart -->
                                        <!--<div class="hover-area">-->
                                        <!--    <div class="action-buttons"> <a href="#" rel="nofollow"-->
                                        <!--            class="add_to_wishlist">Wishlist</a> <a href="#"-->
                                        <!--            class="add-to-compare-link">Compare</a> </div>-->
                                        <!--</div>-->
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            @endforeach


                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="banner2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bannerTwoSlider owl-carousel owl-theme">
                    @foreach ($second_banner as $ban2)
                    <div class="item bannerSliderOne lazy" data-bg="url({!! $ban2->image !!})" >
                        <div class="bannerSliderOne_content">
                            {!! $ban2->description !!}
                        </div>
                    </div>
                    @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ads">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="kitchen-div lazy" data-bg="url({!! asset($section[0]->value) !!})" >
                        <div class="kitchen-content">
                           {!! $section[1]->value !!}
                            <div class="shopBtnDiv">
                                <a href="{!! $section[2]->value !!}">SHOP NOW</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="motherboard-div lazy" data-bg="url({!! asset($section[3]->value) !!})">
                        <div class="kitchen-content">
                            {!! $section[4]->value !!}
                            <div class="shopBtnDiv">
                                <a href="{!! $section[5]->value !!}">SHOP MORE</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('countries')



@endsection
@section('css')
<style>


</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
