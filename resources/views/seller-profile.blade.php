@extends('layouts.main')
@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container-fluid">
            <nav class="woocommerce-breadcrumb"><a href="{!! route('home') !!}">Home</a><span class="delimiter"><i
                        class="fa fa-angle-right"></i></span>{{ $user->name }}</nav>
            <div id="primary" class="content-area">
                <main id="main" class="site-main">

                    <header class="page-header">
                        <h1 class="page-title">Products</h1>
                        {{-- <p class="woocommerce-result-count">Showing 1&ndash;12 of {!! $shops->count() ?? 0 !!} results</p> --}}
                    </header>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">
                            <ul class="products columns-3">
                                @foreach ($product as $pros)
                                    @php
                                        $pro = App\Product::where('id', $pros->product_id)->first();
                                    @endphp


                                    <li class="product first">
                                        <div class="product-outer">
                                            <div class="product-inner"> <span class="loop-product-categories"><a
                                                        href="#" rel="tag">{!! $pro->categorys->name !!}</a></span>
                                                <a href="{{ route('shopDetail', ['id' => $pros->id]) }}">
                                                    <h3>{!! $pro->product_title !!}</h3>
                                                    <div class="product-thumbnail"> <img data-echo="{!! asset($pro->image) !!}"
                                                            src="{{ asset($pro->image) }}" alt=""> </div>
                                                </a>
                                                <div class="price-add-to-cart"> <span class="price">
                                                        <span class="electro-price">
                                                            <ins><span
                                                                    class="amount">&#036;{!! number_format($pros->calculated_final_price, 2) !!}</span></ins>
                                                            <div class="ship-box">
                                                                <div class="ship-detail">
                                                                    <i class="fa-solid fa-truck"></i> Free Shipping - 12-day
                                                                    delivery
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </span> <a rel="nofollow"
                                                        href="{{ route('shopDetail', ['id' => $pros->id]) }}"
                                                        class="button add_to_cart_button">Add to cart</a> </div>
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
                    <div class="shop-control-bar-bottom">



                        <nav class="woocommerce-pagination">

                        </nav>
                    </div>
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
            <div id="sidebar" class="sidebar" role="complementary">
                <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
                    <h3>Store Details </h3>
                </aside>

            </div>
        </div>
        <!-- .container -->
    </div>
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
            ul.products>li {
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
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $('.dropify').dropify();
        $(document).on('click', "#addCart", function(e) {
            console.log($('#addcount').val())
            $('#add-cart').submit();
        });

        $(document).on('keydown keyup', ".qty", function(e) {
            if ($(this).val() <= 1) {
                e.preventDefault();
                $(this).val(1);
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.plus', function() {
                $('.count').val(parseInt($('.count').val()) + 1);
            });
            $(document).on('click', '.minus', function() {
                $('.count').val(parseInt($('.count').val()) - 1);
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
            });
        });

        $('.product-img--main')
            // tile mouse actions
            .on('mouseover', function() {
                $(this).children('.product-img--main__image').css({
                    'transform': 'scale(' + $(this).attr('data-scale') + ')'
                });
            })
            .on('mouseout', function() {
                $(this).children('.product-img--main__image').css({
                    'transform': 'scale(1)'
                });
            })
            .on('mousemove', function(e) {
                $(this).children('.product-img--main__image').css({
                    'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e
                        .pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
                });
            })
            // tiles set up
            .each(function() {
                $(this)
                    // add a image container
                    .append('<div class="product-img--main__image"></div>')
                    // set up a background image for each tile based on data-image attribute
                    .children('.product-img--main__image').css({
                        'background-image': 'url(' + $(this).attr('data-image') + ')'
                    });
            });
    </script>
@endsection
