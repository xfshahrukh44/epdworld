@extends('layouts.main')
@section('content')
    <!-- ============================================================== -->
    <!-- BODY START HERE -->
    <!-- ============================================================== -->
    <?php

    $categories = DB::table('categories')->get();
    use App\wishlists;

    ?>


<div id="content" class="site-content" tabindex="-1">
    <div class="container-fluid">
        <nav class="woocommerce-breadcrumb"><a href="{!! route('home') !!}">Home</a><span class="delimiter"><i
                    class="fa fa-angle-right"></i></span>Shop</nav>
        <div id="primary" class="content-area">
            <main id="main" class="site-main">

                <header class="page-header">
                    <h1 class="page-title">Products</h1>
                    <!--<p class="woocommerce-result-count">Showing 1&ndash;12 of {!! count($shops) !!} results</p>-->
                </header>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">
                        @if(count($shops) > 0)
                        <ul class="products columns-3">
                            @foreach ($shops as $pro)
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">{!! $pro->categorys->name !!}</a></span>
                                        <a href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}">
                                            <h3>{!! $pro->product_title !!}</h3>
                                            <div class="product-thumbnail"> <img data-echo="{!! asset($pro->image) !!}"
                                                    src="{{ asset($pro->image) }}" alt=""> </div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;{!! $pro->price !!}</span></ins>
                                                    {{-- <del><span class="amount">&#036;2,299.00</span></del> --}}
                                                </span>
                                            </span> <a rel="nofollow" href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            @endforeach


                        </ul>
                        @else
                        <div class="row">
                            <div class="col-md-12 empty-box">
                                <h3>No Product Found</h3>
                            </div>
                        </div>
                        @endif
                    </div>
                    {{-- <div role="tabpanel" class="tab-pane" id="grid-extended" aria-expanded="true">
                        <ul class="products columns-3">
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product ">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product last">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product ">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product last">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product ">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product last">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product ">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product last">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product first">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product ">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                            <li class="product last">
                                <div class="product-outer">
                                    <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                rel="tag">Smartphones</a></span>
                                        <a href="single-product.html">
                                            <h3>Notebook Black Spire V Nitro VN7-591G</h3>
                                            <div class="product-thumbnail"> <img class="wp-post-image"
                                                    data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                            </div>
                                            <div class="product-rating">
                                                <div title="Rated 4 out of 5" class="star-rating"><span
                                                        style="width:80%"><strong class="rating">4</strong> out
                                                        of 5</span></div> (3)
                                            </div>
                                            <div class="product-short-description">
                                                <ul>
                                                    <li><span class="a-list-item">Intel Core i5 processors
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Intel Iris Graphics 6100
                                                            (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Flash storage</span></li>
                                                    <li><span class="a-list-item">Up to 10 hours of battery
                                                            life2 (13-inch model)</span></li>
                                                    <li><span class="a-list-item">Force Touch trackpad (13-inch
                                                            model)</span></li>
                                                </ul>
                                            </div>
                                            <div class="product-sku">SKU: 5487FB8/15</div>
                                        </a>
                                        <div class="price-add-to-cart"> <span class="price">
                                                <span class="electro-price">
                                                    <ins><span class="amount">&#036;1,999.00</span></ins>
                                                    <del><span class="amount">&#036;2,299.00</span></del>
                                                </span>
                                            </span> <a rel="nofollow" href="single-product.html"
                                                class="button add_to_cart_button">Add to cart</a> </div>
                                        <!-- /.price-add-to-cart -->
                                        <div class="hover-area">
                                            <div class="action-buttons"> <a href="#" rel="nofollow"
                                                    class="add_to_wishlist">Wishlist</a> <a href="#"
                                                    class="add-to-compare-link">Compare</a> </div>
                                        </div>
                                    </div>
                                    <!-- /.product-inner -->
                                </div>
                                <!-- /.product-outer -->
                            </li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="list-view" aria-expanded="true">
                        <ul class="products columns-3">
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Tablets</a></span><a
                                                    href="single-product.html">
                                                    <h3>Tablet Air 3 WiFi 64GB Gold</h3>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="availability in-stock">Availablity: <span>In
                                                        stock</span></div> <span class="price"><span
                                                        class="electro-price"><span
                                                            class="amount">$629.00</span></span>
                                                </span> <a
                                                    class="button product_type_simple add_to_cart_button ajax_add_to_cart"
                                                    data-product_sku="5487FB8/35" data-product_id="2706"
                                                    data-quantity="1" href="single-product.html" rel="nofollow">Add
                                                    to cart</a>
                                                <div class="hover-area">
                                                    <div class="action-buttons">
                                                        <div class="yith-wcwl-add-to-wishlist add-to-wishlist-2706">
                                                            <a class="add_to_wishlist" data-product-type="simple"
                                                                data-product-id="2706" rel="nofollow"
                                                                href="#">Wishlist</a>
                                                            <div style="display:none;"
                                                                class="yith-wcwl-wishlistaddedbrowse hide">
                                                                <span class="feedback">Product added!</span> <a
                                                                    rel="nofollow" href="#">Wishlist</a>
                                                            </div>
                                                            <div style="display:none"
                                                                class="yith-wcwl-wishlistexistsbrowse hide">
                                                                <span class="feedback">The product is already in
                                                                    the wishlist!</span> <a rel="nofollow"
                                                                    href="#">Wishlist</a>
                                                            </div>
                                                            <div style="clear:both"></div>
                                                            <div class="yith-wcwl-wishlistaddresponse"></div>
                                                        </div>
                                                        <div class="clear"></div> <a data-product_id="2706"
                                                            class="add-to-compare-link" href="#">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="list-view-small" aria-expanded="true">
                        <ul class="products columns-3">
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/1.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/6.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/3.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/5.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/4.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product list-view list-view-small">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="single-product.html"> <img class="wp-post-image"
                                                data-echo="images/products/2.jpg" src="images/blank.gif" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="row">
                                            <div class="col-xs-12"> <span class="loop-product-categories"><a
                                                        rel="tag" href="#">Smartphones</a></span><a href="#">
                                                    <h3>Ultrabook UX605CA-FC050T</h3>
                                                    <div class="product-short-description">
                                                        <ul style="padding-left: 18px;">
                                                            <li>4.5 inch HD Screen</li>
                                                            <li>Android 4.4 KitKat OS</li>
                                                            <li>1.4 GHz Quad Core&trade; Processor</li>
                                                            <li>20 MP front Camera</li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div title="Rated 4 out of 5" class="star-rating"><span
                                                                style="width:80%"><strong class="rating">4</strong>
                                                                out of 5</span>
                                                        </div> (3)
                                                    </div>
                                                </a> </div>
                                            <div class="col-xs-12">
                                                <div class="price-add-to-cart"> <span class="price"><span
                                                            class="electro-price"><span
                                                                class="amount">$1,218.00</span></span>
                                                    </span> <a class="button add_to_cart_button" href="cart.html"
                                                        rel="nofollow">Add to cart</a> </div>
                                                <!-- /.price-add-to-cart -->
                                                <div class="hover-area">
                                                    <div class="action-buttons"> <a href="#" rel="nofollow"
                                                            class="add_to_wishlist">Wishlist</a> <a
                                                            href="compare.html"
                                                            class="add-to-compare-link">Compare</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="shop-control-bar-bottom">
                    {{-- <form class="form-electro-wc-ppp">
                        <select class="electro-wc-wppp-select c-select" onchange="this.form.submit()" name="ppp">
                            <option selected="selected" value="15">Show 15</option>
                            <option value="-1">Show All</option>
                        </select>
                    </form> --}}
                    {{-- <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p> --}}

                    <nav class="woocommerce-pagination">
                        {!! $shops->links() !!}
                    </nav>
                </div>
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
        <div id="sidebar" class="sidebar" role="complementary">
            <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                <ul class="product-categories category-single">
                    <li class="product_cat">
                        <ul class="show-all-cat">
                            <li class="product_cat"><span class="show-all-cat-dropdown">Show All
                                    Categories</span>
                                <ul>


                                    <!--@foreach ($cat->grandchildren as $item)-->
                                    <!--<li class="cat-item"><a href="#">{!! $item->name !!}</a>-->
                                    <!--    <span class="count">(0)</span></li>-->
                                    <!--@endforeach-->




                                </ul>
                            </li>
                        </ul>
                       <ul>

                                     @foreach ($category as $cat)

                                    @foreach ($cat->grandchildren as $item)
                                    @if($item->parent != 0)
                                    <li class="cat-item"><a href="{{ route('categoryDetail', ['id' => $item->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $item->name)))]) }}">{!! $item->name !!}</a>
                                       </li>
                                    @endif
                                    @endforeach

                                    @endforeach

                        </ul>
                    </li>
                </ul>
            </aside>


            <aside class="widget widget_products">
                <h3 class="widget-title">Latest Products</h3>
                <ul class="product_list_widget">
                    @foreach($latest as $item)
                    <li>
                        <a href="{{ route('shopDetail', ['id' => $item->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $item->product_title)))]) }}" title="Notebook Black Spire V Nitro  VN7-591G"> <img
                                width="180" height="180" src="{!! asset($item->image) !!}" class="wp-post-image"
                                alt="" /><span class="product-title">{!! $item->product_title !!}</span> </a> <span class="electro-price"><ins><span
                                    class="amount">&#36;{!! $item->price !!}</span></ins> </span>
                    </li>
                    @endforeach


                </ul>
            </aside>
        </div>
    </div>
    <!-- .container -->
</div>
<!-- #content -->




@endsection
@section('css')
<style>
ul.products > li.product {
    width: 24% !important;
    margin-left: 12px;
    margin-bottom: 40px;
}

li.product-list {
    width: 100% !important;
    margin-bottom: 15px;
}


#content #primary {
    width: 75% !important;
    left: 25% !important;
}

ul.products {
    display: flex;
    flex-wrap: wrap;
    flex: 0 0 25% !important;
}

li .page-link {
    color: #7e7e7e;
    display: block;
    padding: 0.643em 1.429em;
    border: 1px solid #e3e3e3;
    border-radius: 1.143em;
    background: #fed700;
    margin-left: 5px;
}

.page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
    z-index: 2;
    color: #333e48;
    cursor: default;
    background-color: #fed700;
    border-color: #333e48;
}

.product-thumbnail img {
    height: 200px;
    width: 100%;
}

.shop-tabs {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.list-view a svg {
    font-size: 22px;
    color: #000;
}

ul.products.list-views {
    display: flex;
    flex-direction: column;
    flex: 0 0 100%;
}

.list-views .product {
    width: 100% !important;
}


.list-views .product-thumbnail-list {
    height: 250px !important;
    width: 25% !important;
    margin-bottom: 0px !important;
    border-radius: 10px;
    border: 2px solid #fed700;
}


.product-list .wp-post-image {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    border-radius: 15px;
}

.product-list .product-outer {
    display: flex;
    background: #ffffff;
    padding: 10px;
    height: 270px !important;
    border-radius: 10px;
    box-shadow: 5px 5px 10px;
}

li.product-list {
    width: 100% !important;
}


.product-inner-list {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 15px;
    width: 70% !important;

}

.product-inner-list .loop-product-categories a {
    color: #000 !important;
}

.product-inner-list .loop-product-categories{
    padding-bottom: 20px;
}

.product-inner-list h3 {
    font-size: 26px;
    color: #000;
    font-weight: 600;
}

.product-inner-list .amount {
    font-size: 28px !important;
    text-decoration: none !important;
    font-weight: 700;
}

.product-inner-list .price-add-to-cart {
    padding: 10px 0px;
}

.product-inner-list .price-add-to-cart a {
    font-size: 22px;
    padding: 10px 20px;
    color: #fff;
}


@media (max-width: 1440px) {

     #content #primary {
        width: 80% !important;
        left: 20% !important;
    }


    #content #sidebar {
        padding-right: 0.9375rem !important;
        width: 20% !important;
        right: 80% !important;
    }


    ul.products.columns-3 > li, ul.products > .product {
        width: 22% !important;
        margin: 15px 10px !important;
    }

    .product-outer {
        height: 330px !important;
    }

    .product-inner {
        height: 330px !important;
    }

    .product-thumbnail img {
        height: 172px !important;
        width: 100% !important;
    }

    .product-list .product-outer {
        display: flex;
        background: #ffffff;
        padding: 10px;
        height: 270px !important;
        border-radius: 10px;
        box-shadow: 5px 5px 10px;
        margin-bottom: 30px;
    }

    .product-list .product-inner {
        height: 265px !important;
    }

    .product-inner-list h3 {
        font-size: 22px;
        color: #000;
        font-weight: 600;
    }
}
</style>

@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
