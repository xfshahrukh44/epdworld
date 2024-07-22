@extends('layouts.main')
@section('content')

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
                            <div class="item"
                                 style="background-image: url(https://images.unsplash.com/photo-1570222094114-d054a817e56b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8aG9tZSUyMGFwcGxpYW5jZXxlbnwwfHwwfHx8MA%3D%3D);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="white hero-2 fadeInDown-2">Timepieces that make a
                                                    statement up to under favorable Apparel<br/>
                                                    <strong>FROM 40% Off</strong>
                                                </div>

                                                <div class="hero-action-btn fadeInDown-4"><a
                                                            class="big le-button "
                                                            href="https://epdworld.com/category-detail/106?name=mens-hoodies--sweatshirts">Start
                                                        Buying</a></div>
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                            <div class="item"
                                 style="background-image: url(https://i.ytimg.com/vi/f7U41OmBnpI/maxresdefault.jpg);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="white hero-subtitle-v2 fadeInDown-1 ">shop to get
                                                    what you loves
                                                </div>

                                                <div class="white hero-2 fadeInDown-2">Timepieces that make a
                                                    statement up to <strong>40% Off</strong></div>
                                                <div class="hero-action-btn fadeInDown-4"><a
                                                            class="big le-button "
                                                            href="https://epdworld.com/category-detail/79?name=mens-shoes">Start
                                                        Buying</a></div>
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                            <div class="item"
                                 style="background-image: url(https://pbs.twimg.com/media/CUQBj-eWoAAbzSf.jpg);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="hero-subtitle-v2 fadeInLeft-1">shop to get what you
                                                    loves
                                                </div>

                                                <div class="hero-2 fadeInRight-1">Hair Wigs that make a
                                                    statement up to <strong>40% Off</strong></div>

                                                <div class="hero-action-btn fadeInDown-4"><a
                                                            class="big le-button "
                                                            href="https://epdworld.com/category-detail/147?name=toupee">Start
                                                        Buying</a></div>
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                        </div><!-- /.owl-carousel -->
                        <!-- ========================================= SECTION – HERO : END ========================================= -->
                    </div><!-- /.home-v1-slider -->
                    <div class="home-v2-ads-block animate-in-view fadeIn animated"
                         data-animation=" animated fadeIn">
                        <div class="ads-block row">
                            <div class="ad col-xs-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left media-middle"><img
                                                src="https://m.media-amazon.com/images/I/917xzOZDnPL._AC_SY200_.jpg"
                                                alt=""/>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="ad-text">
                                            Catch Big<br> <strong>Deals </strong>of the<br> Sandals
                                        </div>
                                        <div class="ad-action">
                                            <a href="https://epdworld.com/category-detail/10?name=sandals">Shop
                                                now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ad col-xs-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left media-middle"><img
                                                src="https://m.media-amazon.com/images/I/61nIJnYeOPL._AC_SY200_.jpg"
                                                alt=""/>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="ad-text">
                                            Women's <br> Tote <strong>Bags</strong>
                                        </div>
                                        <div class="ad-action">
                                            <a
                                                    href="https://epdworld.com/category-detail/8?name=womens-tote-bags">Shop
                                                now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="products-carousel-tabs animate-in-view fadeIn animated"
                             data-animation="fadeIn">
                        <h2 class="sr-only">Product Carousel Tabs</h2>
                        <ul class="nav nav-inline">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tab-products-1" data-toggle="tab">Recently
                                    Viewed
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
                                                @php
                                                    $latest_products = \App\Product::whereHas('categorys', function ($q) {
                                                        return $q->where('name', 'Australian products');
                                                    })->orderBy('created_at', 'DESC')->take(12)->get();
                                                    $exclude_product_ids = [];
                                                @endphp

                                                @foreach($latest_products as $latest_product)
                                                    <?php $exclude_product_ids [] = $latest_product->id; ?>
                                                    <div class="product first">
                                                        <div class="product-outer">
                                                            <div class="product-inner">
                                                                <span class="loop-product-categories"><a
                                                                            href=""
                                                                            rel="tag">{{$latest_product->categorys->name}}</a></span>
                                                                <a href="{{ route('shopDetail', ['id' => $latest_product->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $latest_product->product_title)))]) }}">
                                                                    <h3>{{$latest_product->product_title}}</h3>
                                                                    <div class="product-thumbnail">
                                                                        <img src="{{asset($latest_product->image)}}"
                                                                             data-echo="{{asset($latest_product->image)}}"
                                                                             class="img-responsive" alt="">
                                                                    </div>
                                                                </a>

                                                                <div class="price-add-to-cart">
                                                                    <span class="price">
                                                                        <span class="electro-price">
                                                                            <ins><span class="amount">
                                                                                    ${{$latest_product->price}}</span></ins>
                                                                            <div class="ship-box">
                                                                                <div class="ship-detail">
                                                                                  <i class="fa-solid fa-truck"></i>  Free Shipping - 12-day delivery
                                                                                </div>
                                                                            </div>
                                                                        </span>
                                                                    </span>
                                                                    <a rel="nofollow"
                                                                       href="{{ route('shopDetail', ['id' => $latest_product->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $latest_product->product_title)))]) }}"
                                                                       class="button add_to_cart_button">Add to cart</a>
                                                                </div><!-- /.price-add-to-cart -->


                                                            </div><!-- /.product-inner -->
                                                        </div><!-- /.product-outer -->
                                                    </div>
                                                @endforeach
                                            </div><!-- /.products -->
                                        </div>
                                    </div>
                                </section>
                            </div><!-- /.tab-pane -->

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
                                            <img src="https://avatars.mds.yandex.net/i?id=95701fd7c5baebaf0024615d9d8560ce72bfde2c-7552730-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a
                                                href="https://epdworld.com/category-detail/4?name=slippers">Slippers</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/11?name=heeled-sandals">
                                            <img src="https://avatars.mds.yandex.net/i?id=3a231bb1082c5ce9895fc62b1debb21f2770e07e-10490937-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/11?name=heeled-sandals">Heeled
                                            Sandals</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">
                                            <img src="https://avatars.mds.yandex.net/i?id=5f3d41b802a8d1de476d80e4c6df9a77-5884257-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">Women's
                                            Tote Bags</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a
                                                href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">
                                            <img src="https://avatars.mds.yandex.net/i?id=6358452c1b13a1a44516ad3e41d8aae0-5430119-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a
                                                href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">Dress
                                            Shoes & Oxfords</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/17?name=sports-socks">
                                            <img src="https://avatars.mds.yandex.net/i?id=ed2dfbe66e885e0d180f09473e9a2a865f7c371c-8087945-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/17?name=sports-socks">Sports
                                            Socks</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a
                                                href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">
                                            <img src="https://avatars.mds.yandex.net/i?id=4def96234170fa694f1dc406bd5828720019e759-10576312-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a
                                                href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">Fashion
                                            Jewelry Jewelry Sets</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>


                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a href="https://epdworld.com/category-detail/25?name=body-stocking">
                                            <img src="https://avatars.mds.yandex.net/i?id=182d8c66547865ac94320852167e67017e02af2d-8544532-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/25?name=body-stocking">Body
                                            Stocking</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="mainDiv">
                                    <div class="top-products-cards">
                                        <a
                                                href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">
                                            <img src="https://avatars.mds.yandex.net/i?id=b70fc89321464574af304e3580e19c6c6c892d7b-10878933-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a
                                                href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">Bikinis
                                            & Beachwear</a>
                                    </div>
                                    <div class="totalProducts">

                                    </div>
                                </div>
                            </div>


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

                        @php
                            $products = \App\Product::whereHas('categorys', function ($q) {
                                return $q->where('name', 'Australian products');
                            })->whereNotIn('id', $exclude_product_ids)->orderBy('created_at', 'DESC')->take(12)->get();
                        @endphp
                        <ul class="products columns-3">
                            @foreach($products as $product)
                                <li class="product first">
                                    <div class="product-outer">
                                        <div class="product-inner"> <span class="loop-product-categories"><a href="#"
                                                                                                             rel="tag">{{$product->categorys->name}}</a></span>
                                            <a href="{{ route('shopDetail', ['id' => $product->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $product->product_title)))]) }}">
                                                <h3>{{$product->product_title}}</h3>
                                                <div class="product-thumbnail"><img
                                                            data-echo="{{asset($product->image)}}"
                                                            src="{{asset($product->image)}}" alt=""></div>
                                            </a>
                                            <div class="price-add-to-cart"> <span class="price">
                                                    <span class="electro-price">
                                                        <ins><span class="amount">&#036;{{$product->price}}</span></ins>
                                                        <div class="ship-box">
                                                            <div class="ship-detail">
                                                              <i class="fa-solid fa-truck"></i>  Free Shipping - 12-day delivery
                                                            </div>
                                                        </div>

                                                    </span>
                                                </span> <a rel="nofollow"
                                                           href="{{ route('shopDetail', ['id' => $product->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $product->product_title)))]) }}"
                                                           class="button add_to_cart_button">Add to cart</a></div>


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
                        <div class="item bannerSliderOne"
                             style="background: url(uploads/banner/b1_1672690285.jpg)">
                            <div class="bannerSliderOne_content">
                                <h1>ALL KIND OF FASHION WEAR<br/>
                                    AVAILABLE AT EPD WORLD</h1>
                                <quillbot-extension-portal></quillbot-extension-portal>
                            </div>
                        </div>
                        <div class="item bannerSliderOne"
                             style="background: url(uploads/banner/b2_1672690300.jpg)">
                            <div class="bannerSliderOne_content">
                                <h1>MAKE YOUR SKIN SHINE WITH<br/>
                                    EPD WOLRD SKIN CARE &amp;<br/>
                                    BEAUTY PRODUCTS</h1>
                                <quillbot-extension-portal></quillbot-extension-portal>
                            </div>
                        </div>
                        <div class="item bannerSliderOne" style="background: url(uploads/banner/20230102.jpg)">
                            <div class="bannerSliderOne_content">
                                <h1>
                                    BEST AFRICAN FABRICS <br> AVAILABLE AT EPD WORLD
                                </h1>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ads">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="kitchen-div"
                         style="background-image: url(https://avatars.mds.yandex.net/i?id=58659611fb62b75fdb42b31d449af2e8-5288530-images-thumbs&n=13)">
                        <div class="kitchen-content">
                            <h6>Sale Upto</h6>

                            <h4>Upto 25% Off On All Body Shapers</h4>
                            <quillbot-extension-portal></quillbot-extension-portal>
                            <div class="shopBtnDiv">
                                <a href="https://epdworld.com/category-detail/131?name=shapers">SHOP NOW</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="motherboard-div"
                         style="background-image: url(https://s.catch.com.au/assets/0000/0976/60dd385887c67046020356_w500_h200.jpg)">
                        <div class="kitchen-content">
                            <h6>EXTRA 30% OFF</h6>

                            <h4>All Sale Beauty Equipments</h4>
                            <div class="shopBtnDiv">
                                <a
                                        href="https://epdworld.com/category-detail/55?name=home-use-rf-beauty-instrument">SHOP
                                    MORE</a>
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

        ul.products.columns-3 {
            display: flex;
            flex-wrap: wrap;
            padding: 50px 0px;
        }

        li.product.first {
            margin-left: 15px !important;
            width: 32% !important;
        }

        .product-outer {
            height: 531px !important;
        }

        .product-inner {
            height: 500px !important;
        }

        .price-add-to-cart {
            margin-top: 20px !important;
        }

        .product-thumbnail {
            height: 300px !important;
            padding: 0px !important;
        }

        .product-thumbnail img {
            height: 100% !important;
            width: 100% !important;
            object-fit: cover !important;
        }

    </style>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
