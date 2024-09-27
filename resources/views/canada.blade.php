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
                                 style="background-image: url(https://catherineasquithgallery.com/uploads/posts/2021-02/thumbs/1614396166_5-p-temnii-fon-dlya-kompyutera-6.jpg);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="white hero-2 fadeInDown-2">Timepieces that make a statement
                                                    up to under favorable Apparel<br/>
                                                    <strong>FROM 40% Off</strong></div>

                                                <div class="hero-action-btn fadeInDown-4"><a class="big le-button "
                                                                                             href="https://epdworld.com/category-detail/106?name=mens-hoodies--sweatshirts">Start
                                                        Buying</a></div>
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                            <div class="item"
                                 style="background-image: url(https://www.duchuymobile.com/images/companies/1/1-tin-moi/2020/thang-8/16-8/iphone-13-pro-mau-den.jpg);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="white hero-subtitle-v2 fadeInDown-1 ">shop to get what you
                                                    loves
                                                </div>

                                                <div class="white hero-2 fadeInDown-2">Timepieces that make a statement
                                                    up to <strong>40% Off</strong></div>
                                                <div class="hero-action-btn fadeInDown-4"><a class="big le-button "
                                                                                             href="https://epdworld.com/category-detail/79?name=mens-shoes">Start
                                                        Buying</a></div>
                                            </div><!-- /.caption -->
                                        </div>
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.item -->
                            <div class="item"
                                 style="background-image: url(https://st2.depositphotos.com/1031166/6369/i/950/depositphotos_63699569-stock-photo-household-appliances.jpg);">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-5">
                                            <div class="caption vertical-center text-left">
                                                <div class="hero-subtitle-v2 fadeInLeft-1">shop to get what you loves
                                                </div>

                                                <div class="hero-2 fadeInRight-1">Hair Wigs that make a statement up to
                                                    <strong>40% Off</strong></div>

                                                <div class="hero-action-btn fadeInDown-4"><a class="big le-button "
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
                    <div class="home-v2-ads-block animate-in-view fadeIn animated" data-animation=" animated fadeIn">
                        <div class="ads-block row">
                            <div class="ad col-xs-12 col-sm-6">
                                <div class="media">
                                    <div class="media-left media-middle"><img
                                                src="https://avatars.mds.yandex.net/i?id=928a25f1cca0c2deffac692824bf0a6587a3c9ad-9029247-images-thumbs&n=13"
                                                alt=""/>
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
                                    <div class="media-left media-middle"><img
                                                src="https://avatars.mds.yandex.net/i?id=37b1a9c357bc9513c573ecb17f7572abfa839338-10551030-images-thumbs&n=13"
                                                alt=""/>
                                    </div>
                                    <div class="media-body media-middle">
                                        <div class="ad-text">
                                            Women's <br> Tote <strong>Bags</strong>
                                        </div>
                                        <div class="ad-action">
                                            <a href="https://epdworld.com/category-detail/8?name=womens-tote-bags">Shop
                                                now</a>
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
                                                @php
                                                    $latest_products = \App\Product::whereHas('categorys', function ($q) {
                                                        return $q->where('name', 'Canadian products');
                                                    })->where('price', '!=', 10.00)->where('id', '!=', 8170)->orderBy('created_at', 'DESC')->take(12)->get();
                                                    $exclude_product_ids = [8170];
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
                                            <img src="https://avatars.mds.yandex.net/i?id=d9ad518b1a104434ed01af3846618d8c1c85465a-10715561-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
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
                                            <img src="https://avatars.mds.yandex.net/i?id=e280fe6fd730eb18aa0763d3de1e9b0085b5490b-8245560-images-thumbs&n=13"
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
                                            <img src="https://avatars.mds.yandex.net/i?id=ae83781bddbe8ef25b2ad1629239288eb4d723c8-9853960-images-thumbs&n=13"
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
                                        <a href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">
                                            <img src="https://avatars.mds.yandex.net/i?id=78d47bbf8adb19a182225bb7decae8a5de272755-10303547-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/123?name=dressshoesoxfords">Dress
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
                                            <img src="https://avatars.mds.yandex.net/i?id=e18e4114926dc0bf395e2bf76ed07ec3df334ac4-9852755-images-thumbs&n=13"
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
                                        <a href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">
                                            <img src="https://avatars.mds.yandex.net/i?id=b7216a381bbdaed25bd6977e15f48efc2cfd1270-10636835-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/112?name=fashion-jewelry-jewelry-sets">Fashion
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
                                            <img src="https://avatars.mds.yandex.net/i?id=ddae5756e979db09c26bc5031598573c769543c7-5504462-images-thumbs&n=13"
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
                                        <a href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">
                                            <img src="https://avatars.mds.yandex.net/i?id=7a5059e0c6404682c916e86c07425e2551e5c5fc-10207868-images-thumbs&n=13"
                                                 class="img-fluid" alt="top1">
                                        </a>
                                    </div>
                                    <div class="top1Content">
                                        <a href="https://epdworld.com/category-detail/133?name=bikinis--beachwear">Bikinis
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
                                return $q->where('name', 'Canadian products');
                            })->where('price', '!=', 10.00)->whereNotIn('id', $exclude_product_ids)->orderBy('created_at', 'DESC')->take(12)->get();
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
                        <div class="item bannerSliderOne" style="background: url(uploads/banner/b1_1672690285.jpg)">
                            <div class="bannerSliderOne_content">
                                <h1>ALL KIND OF FASHION WEAR<br/>
                                    AVAILABLE AT EPD WORLD</h1>
                                <quillbot-extension-portal></quillbot-extension-portal>
                            </div>
                        </div>
                        <div class="item bannerSliderOne" style="background: url(uploads/banner/b2_1672690300.jpg)">
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
                         style="background-image: url(https://avatars.mds.yandex.net/i?id=c867ad565e3ff6f964fc709e4a04df2f4291ac05-9678500-images-thumbs&n=13)">
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
                         style="background-image: url(https://avatars.mds.yandex.net/i?id=382b29bd14460f41e132973109aa02a176529591-8310601-images-thumbs&n=13)">
                        <div class="kitchen-content">
                            <h6>EXTRA 30% OFF</h6>

                            <h4>All Sale Beauty Equipments</h4>
                            <div class="shopBtnDiv">
                                <a href="https://epdworld.com/category-detail/55?name=home-use-rf-beauty-instrument">SHOP
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
