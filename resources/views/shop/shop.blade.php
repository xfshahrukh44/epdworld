@extends('layouts.main')
@section('content')
@section('title', 'Products')
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
                <div class="shop-tabs">

                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#grid" role="tab"> <svg version="1.1"
                                    id="shop-view-column-4" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px"
                                    height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19"
                                    xml:space="preserve">
                                    <rect width="4" height="4"></rect>
                                    <rect x="5" width="4" height="4"></rect>
                                    <rect x="10" width="4" height="4"></rect>
                                    <rect x="15" width="4" height="4"></rect>
                                    <rect y="5" width="4" height="4"></rect>
                                    <rect x="5" y="5" width="4" height="4"></rect>
                                    <rect x="10" y="5" width="4" height="4"></rect>
                                    <rect x="15" y="5" width="4" height="4"></rect>
                                    <rect y="15" width="4" height="4"></rect>
                                    <rect x="5" y="15" width="4" height="4"></rect>
                                    <rect x="10" y="15" width="4" height="4"></rect>
                                    <rect x="15" y="15" width="4" height="4"></rect>
                                    <rect y="10" width="4" height="4"></rect>
                                    <rect x="5" y="10" width="4" height="4"></rect>
                                    <rect x="10" y="10" width="4" height="4"></rect>
                                    <rect x="15" y="10" width="4" height="4"></rect>
                                </svg> </a>
                        </li>

                        <li class="nav-item list-view">
                            <a class="nav-link" data-toggle="tab" href="#list" role="tab"> <svg
                                    viewBox="0 0 1024 1024" width="1em" height="1em" fill="currentColor"
                                    aria-hidden="false" focusable="false">
                                    <path
                                        d="M906.666667 789.333333a32 32 0 0 1 0 64H117.333333a32 32 0 0 1 0-64h789.333334z m0-309.333333a32 32 0 0 1 0 64H117.333333a32 32 0 0 1 0-64h789.333334z m0-309.333333a32 32 0 0 1 0 64H117.333333a32 32 0 0 1 0-64h789.333334z"
                                        data-spm-anchor-id="a2g0o.productlist.0.i107.47c0443foMrWxB"></path>
                                </svg></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">
                                <form class="woocommerce-ordering wd-style-underline wd-ordering-mb-icon"
                                    method="get">
                                    <select name="orderby" class="orderby" aria-label="Shop order"
                                        onchange="filterProduct()">
                                        <option value="">Filter</option>
                                        <option value="default" <?php if ($orderBy == 'default') {
                                            echo 'selected';
                                        } ?>>Default sorting</option>
                                        {{-- <option value="popularity" selected="selected">Sort by popularity</option> --}}
                                        {{-- <option value="rating">Sort by average rating</option> --}}
                                        <option value="latest" <?php if ($orderBy == 'latest') {
                                            echo 'selected';
                                        } ?>>Sort by latest</option>
                                        <option value="price-low-high" <?php if ($orderBy == 'price-low-high') {
                                            echo 'selected';
                                        } ?>>Sort by price: low to high
                                        </option>
                                        <option value="price-high-low" <?php if ($orderBy == 'price-high-low') {
                                            echo 'selected';
                                        } ?>>Sort by price: high to low
                                        </option>
                                    </select>
                                    <input type="hidden" name="price" value="1">
                                    <input type="hidden" name="per_row" value="2"><input type="hidden"
                                        name="per_page" value="18"><input type="hidden" name="shop_view"
                                        value="grid"><input type="hidden" name="_pjax"
                                        value=".main-page-wrapper">
                                </form>
                            </a>
                        </li>
                    </ul><!-- Tab panes -->
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">
                        @if (count($shops) > 0)
                            <ul class="products columns-3">

                                @foreach ($shops as $pro)
                                    <li class="product first">
                                        <div class="product-outer">
                                            <div class="product-inner"> <span class="loop-product-categories"><a
                                                        href="#"
                                                        rel="tag">{!! $pro->categorys->name !!}</a></span>
                                                @if (empty($pro->slug))
                                                    <a
                                                        href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}">
                                                    @else
                                                        <a
                                                            href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}">
                                                @endif
                                                <h3>{!! $pro->product_title !!}</h3>
                                                <div class="product-thumbnail"> <img
                                                        data-echo="{!! asset($pro->image) !!}"
                                                        data-src="{{ asset($pro->image) }}" class="lazy"
                                                        alt=""> </div>
                                                </a>
                                                <div class="price-add-to-cart"> <span class="price">
                                                        <span class="electro-price">
                                                            <ins><span
                                                                    class="amount">&#036;{!! $pro->calculated_final_price !!}</span></ins>
                                                            <div class="ship-box">
                                                                <div class="ship-detail">
                                                                    <i class="fa-solid fa-truck"></i> Free Shipping -
                                                                    12-day delivery
                                                                </div>
                                                            </div>
                                                            @if ($pro->moq != null)
                                                                <div class="moq-box">
                                                                    <p>{{ $pro->moq }}</p>
                                                                </div>
                                                            @endif

                                                            {{-- <del><span class="amount">&#036;2,299.00</span></del> --}}
                                                        </span>
                                                    </span>
                                                    @if (empty($pro->slug))
                                                        <a rel="nofollow"
                                                            href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}"
                                                            class="button add_to_cart_button">Add to cart</a>
                                                    @else
                                                        <a rel="nofollow"
                                                            href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}"
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
                        @else
                            <div class="row">
                                <div class="col-md-12 empty-box">
                                    <h3>No Product Found</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane" id="list" aria-expanded="true">
                        @if (count($shops) > 0)
                            <ul class="products list-views">
                                @foreach ($shops as $pro)
                                    <li class="product-list">
                                        <div class="product-outer">
                                            <div class="product-thumbnail-list"> <img class="wp-post-image lazy"
                                                    data-echo="{!! asset($pro->image) !!}"
                                                    data-src="{!! asset($pro->image) !!}" alt="">
                                            </div>
                                            <div class="product-inner product-inner-list"> <span
                                                    class="loop-product-categories"><a href="#"
                                                        rel="tag">{!! $pro->categorys->name !!}</a></span>
                                                <a href="single-product.html">
                                                    <h3>{{ $pro->product_title }}</h3>

                                                    <!--<div class="product-sku">SKU: 5487FB8/15</div>-->
                                                </a>
                                                <div class="price-add-to-cart"> <span class="price">

                                                        <ins><span
                                                                class="amount">&#036;{!! $pro->calculated_final_price !!}</span></ins>


                                                    </span></div>

                                                <div class="price-add-to-cart">
                                                    @if (empty($pro->slug))
                                                        <a rel="nofollow"
                                                            href="{{ route('shopDetail', ['id' => $pro->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $pro->product_title)))]) }}"
                                                            class="button add_to_cart_button">Add to cart</a>
                                                    @else
                                                        <a rel="nofollow"
                                                            href="{{ route('shopDetailSlug', ['slug' => $pro->slug]) }}"
                                                            class="button add_to_cart_button">Add to cart</a>
                                                    @endif

                                                </div>
                                                <!-- /.price-add-to-cart -->

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

                </div>
                <div class="shop-control-bar-bottom">
                    <nav class="woocommerce-pagination">
                        {{--                        {!! $shops->links() !!} --}}
                        {!! $shops->appends(request()->input())->links() !!}

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
                                    <li class="cat-item"><a href="{!! route('shop') !!}">All
                                            Categories</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                        <ul>

                            {{-- @dd($cat->grandchildren) --}}
                            @foreach ($category as $cat)
                                @foreach ($cat->grandchildren as $item)
                                    @if ($item->parent_cat->parent != 0)
                                        @if ($item->parent != 0)
                                            @if (count($item->products) > 0)
                                                <li class="cat-item"><a
                                                        href="{{ route('categoryDetail', ['id' => $item->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $item->name)))]) }}">{!! $item->name !!}</a>
                                                </li>
                                            @endif
                                        @endif
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
                    @foreach ($latest as $item)
                        <li>
                            @if (empty($item->slug))
                                <a href="{{ route('shopDetail', ['id' => $item->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $item->product_title)))]) }}"
                                    title="Notebook Black Spire V Nitro  VN7-591G"> <img width="180"
                                        height="180" data-src="{!! asset($item->image) !!}" class="wp-post-image lazy"
                                        alt="" /><span class="product-title">{!! $item->product_title !!}</span>
                                </a>
                            @else
                                <a href="{{ route('shopDetailSlug', ['slug' => $item->slug]) }}"
                                    title="Notebook Black Spire V Nitro  VN7-591G"> <img width="180"
                                        height="180" data-src="{!! asset($item->image) !!}" class="wp-post-image lazy"
                                        alt="" /><span class="product-title">{!! $item->product_title !!}</span>
                                </a>
                            @endif

                            <span class="electro-price"><ins><span
                                        class="amount">&#36;{!! $item->calculated_final_price !!}</span></ins> </span>
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
    ul.products>li.product {
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

    .page-item.active .page-link,
    .page-item.active .page-link:focus,
    .page-item.active .page-link:hover {
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

    .product-inner-list .loop-product-categories {
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

    .price-add-to-cart {
        margin-top: 0 !important;
    }

    .moq-box p {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }

    .product-inner {
        height: unset !important;
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


        ul.products.columns-3>li,
        ul.products>.product {
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
<script type="text/javascript">
    function filterProduct(getRoute) {
        var url = '{{ route('shop') }}';
        var orderBy = $('.orderby').val();
        // var catId = '{{ Request::segment(1) }}';

        // if(catId != ''){
        //     window.location.href=url+'/'+catId+'/'+orderBy;
        // }else{
        window.location.href = url + '/' + orderBy;
        // }

    }
</script>
@endsection
