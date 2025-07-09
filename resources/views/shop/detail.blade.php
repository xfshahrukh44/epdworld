@extends('layouts.main')
@section('content')
@section('title', $product_detail->product_title)
<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->



<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <nav class="woocommerce-breadcrumb"> <a href="{!! route('home') !!}">Home</a> <span class="delimiter"><i
                    class="fa fa-angle-right"></i></span> <a href="{{ route('shop') }}">{!! $product_detail->categorys->name !!}</a> <span
                class="delimiter"><i class="fa fa-angle-right"></i>
            </span>{!! $product_detail->product_title !!} </nav>
        <!-- /.woocommerce-breadcrumb -->
        <div id="primary" class="content-area single-product">
            <main id="main" class="site-main">
                <div class="product">
                    <div class="single-product-wrapper">
                        <div class="product-images-wrapper"> <span class="onsale">Sale!</span>
                            <div class="images electro-gallery">
                                <div class="thumbnails-single owl-carousel">
                                    <a href="{!! asset($product_detail->image) !!}" class="zoom" title=""
                                        data-rel="prettyPhoto[product-gallery]"><img
                                            src="{{ asset($product_detail->image) }}"
                                            data-echo="{!! asset($product_detail->image) !!}" class="wp-post-image"
                                            alt=""></a>

                                    @php
                                        $gallery = DB::table('product_imagess')
                                            ->where('product_id', $product_detail->id)
                                            ->get();
                                    @endphp
                                    @foreach ($gallery as $gal)
                                        <a href="{!! asset($gal->image) !!}" class="zoom" title=""
                                            data-rel="prettyPhoto[product-gallery]"><img src="{{ asset($gal->image) }}"
                                                data-echo="{!! asset($gal->image) !!}" class="wp-post-image"
                                                alt=""></a>
                                    @endforeach


                                </div>
                                <!-- .thumbnails-single -->
                                <div class="thumbnails-all columns-5 owl-carousel">
                                    <a href="{!! asset($product_detail->image) !!}" class="first" title=""><img
                                            src="{{ asset($product_detail->image) }}"
                                            data-echo="{!! asset($product_detail->image) !!}" class="wp-post-image"
                                            alt=""></a>
                                    @foreach ($gallery as $gal)
                                        <a href="{!! asset($gal->image) !!}" class="" title=""><img
                                                src="{{ asset($gal->image) }}" data-echo="{!! asset($gal->image) !!}"
                                                class="wp-post-image" alt=""></a>
                                    @endforeach

                                </div>
                                <!-- .thumbnails-all -->
                            </div>
                            <!-- .electro-gallery -->
                        </div>
                        <!-- /.product-images-wrapper -->
                        <form method="POST" action="{{ route('save_cart') }}" id="add-cart">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product_detail->id }}">
                            <div class="summary entry-summary"> <span class="loop-product-categories">
                                    <a href="" rel="tag">{!! $product_detail->categorys->name !!}</a>
                                </span>
                                <!-- /.loop-product-categories -->
                                <h1 itemprop="name" class="product_title entry-title">{!! $product_detail->product_title !!}</h1>

                                <!-- .woocommerce-product-rating -->

                                <!-- .brand -->
                                <div class="availability in-stock">Availablity: <span>In stock</span></div>
                                <!-- .availability -->
                                <hr class="single-product-title-divider" />

                                <div itemprop="description">
                                    <div class="ship-box" style="margin: 10px 0px;">
                                        <div class="ship-detail" style="font-size: 14px;">
                                            <i class="fa-solid fa-truck"></i> Free Shipping - 12-day delivery
                                        </div>
                                    </div>
                                    <p><strong>SKU</strong>: {!! $product_detail->sku !!}</p>
                                    @if ($product_detail->users)
                                        <p><strong>Vendor</strong>: <a
                                                href="{{ route('seller-profile', ['slug' => $product_detail->users->slug]) }}"
                                                target="_blank">{!! $product_detail->users->name !!}</a></p>
                                    @endif

                                </div>
                                <!-- .description -->
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <p class="price">
                                        <span class="electro-price">
                                            <input type="hidden" name="price" id="productPrice"
                                                value="{{ $product_detail->price }}" />
                                            <ins><span class="amount" id="productPriceDisplay">${{ $product_detail->price }}</span></ins>
                                        </span>
                                    </p>
                                    <meta itemprop="price" content="{{ $product_detail->price }}" />
                                    <meta itemprop="priceCurrency" content="USD" />
                                    <link itemprop="availability" href="http://schema.org/InStock" />
                                </div>

                                <!-- /itemprop -->

                                <input type="hidden" id="variation-data" value='@json($variations)' />

                                @php
                                    $formattedVariations = $variations->map(function ($variation) {
                                        return [
                                            'id' => $variation->id,
                                            'price' => $variation->price,
                                            'attributes' => $variation->variationValues
                                                ->pluck('attribute_value_id', 'attribute_id')
                                                ->toArray(),
                                        ];
                                    });
                                @endphp

                                <table class="variations">
                                    <tbody>
                                        <tr>
                                            <td class="label">
                                                @foreach ($attributes as $attribute)
                                                    <div class="variation">
                                                        <h3 class="variation-title">{{ $attribute->name }}</h3>

                                                        <div class="att_vals">
                                                            @foreach ($attribute->values as $value)
                                                                <label class="radio-img">
                                                                    <input type="radio"
                                                                        class="radio-box variation-selector"
                                                                        name="variation[{{ $attribute->id }}]"
                                                                        value="{{ $value->id }}"
                                                                        data-attribute-id="{{ $attribute->id }}">

                                                                    <div class="image1"
                                                                        style="
                                                                        background-color: {{ $value->value }};
                                                                        @if ($value->image != null) background-image: url('{{ asset($value->image) }}');
                                                                            background-size: contain;
                                                                            background-repeat: no-repeat;
                                                                            width: 60px;
                                                                            height: 60px; @endif
                                                                        ">
                                                                        @if ($value->image == null)
                                                                            <span>{{ $value->value }}</span>
                                                                        @else
                                                                            <span></span>
                                                                        @endif
                                                                    </div>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach

                                                {{-- Hidden Variation Data --}}
                                                <input type="hidden" id="variation-data"
                                                    value='@json($variations)' />
                                                <h4 id="final-price"></h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="single_variation_wrap">
                                    <div class="woocommerce-variation single_variation"></div>
                                    <div class="woocommerce-variation-add-to-cart variations_button">
                                        <div class="slecter">
                                            <td class="text-center ">
                                                <div class="qty center">

                                                    <span id="1" class="minus btn btnMinus ">-</span>
                                                    <input id="counter" class="count form-control cartcount "
                                                        name="qty" value="1">
                                                    <span id="1" class=" plus btn btnMinus ">+</span>
                                                </div>
                                            </td>
                                            <div class="slecter-but">
                                                <button type="submit" class="btn enroll"> Add to Cart</a>
                                            </div>

                                            {{-- <button id="addCart" class="qty btn btnDonate mt-2" href="javascript:void(0)"
                                                class="nav-link btn btn-red" id="addCart">Add
                                                To
                                                Cart</button> --}}
                                        </div>
                                        {{-- <button type="submit" class="">Add to
                                            cart</button> --}}
                                        {{-- <input type="hidden" name="add-to-cart" value="2452" />
                                        <input type="hidden" name="product_id" value="2452" />
                                        <input type="hidden" name="variation_id" class="variation_id" value="0" /> --}}
                                    </div>
                                </div>

                            </div>

                            <!-- .summary -->
                            @if (count($vendor_pro) > 0)
                                <div class="pro-detail-side">
                                    <h3>See all buying options</h3>
                                    @foreach ($vendor_pro as $pro)
                                        @php
                                            $user = App\User::find($pro->user_id);
                                        @endphp
                                        <div class="vendor-sec">
                                            <input type="radio" name="vendor_id" id="vendor_id"
                                                value="{{ $pro->user_id }}" />
                                            <label for="vendor_id">${{ number_format($pro->price, 2) }} By:
                                                {{ $user->name }}</label>

                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </form>
                    </div>
                    <!-- /.single-product-wrapper -->
                    <div class="woocommerce-tabs wc-tabs-wrapper">
                        <ul class="nav nav-tabs electro-nav-tabs tabs wc-tabs" role="tablist">
                            <li class="nav-item description_tab"> <a href="#tab-description" class="active"
                                    data-toggle="tab">Description</a> </li>
                            {{-- <li class="nav-item reviews_tab"> <a href="#tab-reviews" data-toggle="tab">Reviews</a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active in panel entry-content wc-tab" id="tab-description">
                                <div class="electro-description">
                                    <h2>Detail Description</h2>

                                    <?= html_entity_decode($product_detail->description) ?>
                                </div>
                                <!-- /.electro-description -->

                                <!-- /.product_meta -->
                            </div>

                            <!-- /.panel -->

                            <!-- /.panel -->
                        </div>
                    </div>


                    <div class="review-form">
                        <div class="but-rev-box">
                            <h3>Reviews<h3><a class="but-rev">Leave a Review</a>
                        </div>
                        <div class="review-form-box">
                            <form class="form-box" method="POST" action="{{ route('reviewFormSubmit') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control forms-control" name="name"
                                        value="{{ Auth::check() ? Auth::user()->name : '' }}" />
                                </div>
                                <!--<div class="form-group">-->
                                <!--<label>Designation</label>    -->
                                <!--<input type="text" class="form-control forms-control" name="designation" />-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label>Rating</label>
                                    <select type="text" class="form-control forms-control" name="rating" />
                                    <option value="1">1 Star</option>
                                    <option value="2">2 Star</option>
                                    <option value="3">3 Star</option>
                                    <option value="4">4 Star</option>
                                    <option value="5">5 Star</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Review</label>
                                    <textarea class="form-control forms-control" name="review" /></textarea>
                                </div>
                                <button type="submit" class="btn btn-review">Submit</button>
                            </form>
                        </div>
                    </div>





                </div>
                <!-- /.product -->
            </main>
            <!-- /.site-main -->
        </div>
        <!-- /.content-area -->
    </div>
    <!-- /.container -->
    @if (count($reviews) > 0)
        <section class="top_products">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-products-content">
                            <div class="top-products-heading">
                                <h4>
                                    Product Reviews
                                </h4>
                            </div>
                            <!-- TESTIMONIALS -->
                            <section class="testimonials">
                                <div class="container">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div id="customers-testimonials" class="owl-carousel">
                                                @foreach ($reviews as $rev)
                                                    <!--TESTIMONIAL 1 -->
                                                    <div class="item">
                                                        <div class="shadow-effect">
                                                            <ul class="rating-star-ul">
                                                                @for ($i = 0; $i < $rev->rating; $i++)
                                                                    <li><i class="fas fa-star"></i></li>
                                                                @endfor
                                                            </ul>
                                                            <p>{{ $rev->review }}</p>
                                                        </div>
                                                        <div class="testimonial-name">{{ $rev->name }}</div>
                                                    </div>
                                                    <!--END OF TESTIMONIAL 1 -->
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- END OF TESTIMONIALS -->
                        </div>
                    </div>
                </div>


            </div>
        </section>
    @endif
</div>
<!-- /.site-content -->
<!-- /.site-content -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sell on EPD World</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sell-on-epd') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product_detail->id }}" />
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                    <div class="form-group">
                        <label for="">Stock Quantity</label>
                        <input type="text" class="form-control" name="stock_inventory"
                            placeholder="Enter Stock Quantity">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter Price">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLongTitle">Sell on EPD World</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>Already Added</h2>
            </div>

        </div>
    </div>
</div>

@endsection
@section('css')
<style>
    strong.chunks {
        color: #5cb85c;
    }

    .modal-body h2 {
        text-align: center;
        font-weight: 600;
    }


    input#vendor_id {
        margin-right: 5px;
    }

    .btn-seller {
        background: #fed700;
        padding: 10px 20px;
        color: #000;
        border-radius: 25px;
        margin-left: 10px;
    }

    .btn-seller:hover {
        background: #000;
        color: #fff;
    }


    .qty.center {
        display: flex;
        width: 40%;
    }

    .btnMinus {
        background: #000000;
        color: #fff;
        padding: 5px 18px;
        border-radius: 35px;
        font-size: 28px;
    }

    .slecter {
        display: flex;
        justify-content: space-around;
    }

    .owl-carousel .owl-item img {
        -webkit-transform-style: preserve-3d;
        display: block;
        width: 100%;
        height: 400px;
    }

    .do-entry-list {
        display: flex;
        flex-wrap: wrap;
    }

    dl.do-entry-item {
        flex: 0 0 33.33333%;
    }



    .image1 {
        opacity: 1;
        height: auto;
        width: 100%;
        padding: 5px 0;
        left: 0;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        border: 1px solid #000;
        background-position: center center;
        margin: 5px;
        cursor: pointer;


    }

    .image2 {
        opacity: 1;
        height: 50px;
        width: 50px;
        left: 0;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        border: 1px solid #000;
        background-position: center center;
        margin: 10px;
        cursor: pointer;


    }

    .radio-box {
        cursor: pointer;
    }



    label.radio-img {
        transition: all 0.5s ease;
    }

    input.radio-box {
        z-index: -1;
        position: absolute;
        /* top: 35%; */
        opacity: 0;
        /* right: 50%; */
        transform: translate(-50%, -50%);
    }

    .image1 span {
        position: relative;
        display: block;
        z-index: 4;
    }

    input.radio-box:checked~div.image1 {
        border: 2px solid #FED700 !important;
    }

    input.radio-box:checked~div.image2 {
        border: 2px solid #FED700 !important;
    }


    .image1,
    .image2 {
        margin-left: 0px;
    }



    .summary.entry-summary {
        width: 38% !important;
    }

    .pro-detail-side {
        border: 1px solid #e5e5e5 !important;
        height: 500px;
        width: 20%;
        float: right;
        padding: 10px;
    }

    .vendor-sec {
        padding: 10px;
        border-bottom: 1px solid #e5e5e5;
    }


    .pro-detail-side h3 {
        color: #000;
        font-size: 18px;
        font-weight: 600;
    }

    input#counter {
        text-align: center;
        color: #000 !important;
        background: transparent;
        width: 50%;
    }

    .forms-control {
        padding: 0.857em 1.214em;
        background-color: transparent;
        color: #818181;
        line-height: 1.286em;
        outline: none;
        border: 0;
        -webkit-appearance: none;
        border-radius: 0px !important;
        box-sizing: border-box;
        border-width: 1px;
        border-style: solid;
        border-color: #dddddd;
    }

    a.but-rev {
        font-size: 0.875rem;
        border-radius: 1.571em;
        padding: 1.036em 4.134em;
        border-width: 0;
        display: inline-block;
        color: #333e48;
        background-color: #fed700;
        border-color: #efecec;
        font-weight: 600;
        cursor: pointer;
    }

    .but-rev-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }


    form.form-box {
        width: 60%;
        margin: 0 auto;
    }

    .but-rev-box h3 {
        font-size: 40px;
    }

    .shadow-effect {
        background: #fff;
        padding: 20px;
        border-radius: 4px;
        text-align: center;
        border: 1px solid #ECECEC;
        box-shadow: 0 19px 38px rgba(0, 0, 0, 0.10), 0 15px 12px rgba(0, 0, 0, 0.02);
    }

    #customers-testimonials .shadow-effect p {
        font-family: inherit;
        font-size: 14px;
        color: #000;
        line-height: 1.5;
        margin: 0 0 17px 0;
        font-weight: 300;
    }

    .testimonial-name {
        margin: -17px auto 0;
        display: table;
        width: auto;
        background: #000;
        padding: 9px 35px;
        border-radius: 12px;
        text-align: center;
        color: #fff;
        box-shadow: 0 9px 18px rgba(0, 0, 0, 0.12), 0 5px 7px rgba(0, 0, 0, 0.05);
    }

    #customers-testimonials .item {
        text-align: center;
        padding: 0px;
        margin-bottom: 80px;
        opacity: .2;
        -webkit-transform: scale3d(0.8, 0.8, 1);
        transform: scale3d(0.8, 0.8, 1);
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    #customers-testimonials .owl-item.active.center .item {
        opacity: 1;
        -webkit-transform: scale3d(1.0, 1.0, 1);
        transform: scale3d(1.0, 1.0, 1);
    }

    #customers-testimonials.owl-carousel .owl-dots .owl-dot.active span,
    #customers-testimonials.owl-carousel .owl-dots .owl-dot:hover span {
        background: #000;
        transform: translate3d(0px, -50%, 0px) scale(0.7);
    }

    #customers-testimonials.owl-carousel .owl-dots {
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    #customers-testimonials.owl-carousel .owl-dots .owl-dot {
        display: inline-block;
    }

    #customers-testimonials.owl-carousel .owl-dots .owl-dot span {
        background: #fff;
        display: inline-block;
        height: 20px;
        margin: 0 2px 5px;
        transform: translate3d(0px, -50%, 0px) scale(0.3);
        transform-origin: 50% 50% 0;
        transition: all 250ms ease-out 0s;
        width: 20px;
    }

    .owl-dots .owl-dot {
        width: 8px;
        height: 8px;
        background-color: transparent !important;
        display: inline-block;
        border-radius: 50%;
    }

    .top-products-heading h4 {
        font-size: 50px;
        font-weight: 800;
        text-align: center;
        border-bottom: 2px solid transparent;
        border-color: #ccc;
        padding-bottom: 15px;
        margin: auto;
        width: 80%;
        margin-bottom: -2px;
        color: #fff;
    }

    section.testimonials {
        padding: 50px 0px;
    }

    ul.rating-star-ul {
        list-style: none;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0px;
    }

    ul.rating-star-ul li {}

    ul.rating-star-ul li {
        color: gold;
        margin-left: 5px;
        font-size: 18px;
    }

    .review-form-box {
        display: none;
    }

    .attribute-list {
        display: flex;
        flex-wrap: wrap;
        /* border: 1px solid #000; */
        margin-bottom: 30px;
    }

    .attribute-item {
        display: flex;
        flex: 0 0 100%;
        /* padding: 10px; */
        /* border: 1px solid #000; */
        align-items: center;
        margin-bottom: 10px
    }

    .attribute-item .left {
        width: 20%;
        font-weight: 700;
    }

    .attribute-item div {
        border: 1px solid #000;
        padding: 10px;
        /* height: 100px; */
    }

    .attribute-item .right {
        width: 80%;
    }

    .more-bg {
        display: none;
    }

    .att_vals {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }


    .site-content .id-grid.id-grid-cols-2.id-border-\[0\.5px\].id-border-\[\#ddd\].id-mt-3 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        border: 1px solid #0000003b;
    }

    .site-content .id-grid.id-max-h-\[68px\].id-overflow-hidden.id-grid-cols-\[2fr_3fr\].id-border-b-\[0\.5px\].id-border-\[\#ddd\] {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0px;
        border: 1px solid #0000003b;
        height: 65px;
    }

    .site-content .id-text-sm.id-p-4.id-bg-\[\#f8f8f8\].id-flex.id-items-center {
        width: 50%;
        height: 65px;
        display: flex;
        align-items: center;
        border: 1px solid #0000003b;
        padding-left: 20px;

    }

    .site-content .id-text-sm.id-font-medium.id-p-4.id-flex.id-items-center.id-flex-wrap {
        width: 50%;
        height: 65px;
        display: flex;
        align-items: center;
        border: 1px solid #0000003b;
        padding-left: 20px;
        overflow-y: hidden;
    }

    .site-content id-grid.id-max-h-\[68px\].id-overflow-hidden.id-grid-cols-\[2fr_3fr\] {}

    .site-content .id-grid.id-max-h-\[68px\].id-overflow-hidden.id-grid-cols-\[2fr_3fr\] {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0px;
        border: 1px solid #0000003b;
        height: 65px;
    }


    .site-content .id-text-sm.id-font-medium.id-p-4.id-flex.id-items-center.id-flex-wrap .id-flex.id-items-center.id-gap-1 {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .site-content .id-text-sm.id-font-medium.id-p-4.id-flex.id-items-center.id-flex-wrap .id-flex.id-items-center.id-gap-1 button {
        padding: 0;
        border-radius: 0;
        background: transparent;
        width: 50%;
    }

    .site-content .id-text-sm.id-font-medium.id-p-4.id-flex.id-items-center.id-flex-wrap .id-flex.id-items-center.id-gap-1 button img {
        width: 50%;
    }

    .single-product .price {
        font-size: 20px;
        color: black;
        font-weight: 600;
    }

    .variations span.selected-price {
        font-size: 20px;
    }
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
<script type="text/javascript">
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
        $('.plus').click(function() {
            // console.log($('#counter').val());
            $('#counter').val(parseInt($('#counter').val()) + 1);
        });
        $('.minus').click(function() {
            $('#counter').val(parseInt($('#counter').val()) - 1);
            if ($('#counter').val() == 0) {
                $('#counter').val(1);
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


    $('.but-rev').click(function() {
        $('.review-form-box').slideToggle();
    });


    $(document).ready(function($) {
        "use strict";
        //  TESTIMONIALS CAROUSEL HOOK
        $('#customers-testimonials').owlCarousel({
            loop: true,
            center: true,
            items: 3,
            margin: 0,
            autoplay: true,
            dots: true,
            autoplayTimeout: 8500,
            smartSpeed: 450,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1170: {
                    items: 3
                }
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll(".att_vals").forEach(function(group) {

            const selected = group.querySelector('input[type="radio"]:checked');
            if (!selected) {
                const firstRadio = group.querySelector('input[type="radio"]');
                if (firstRadio) {
                    firstRadio.checked = true;
                }
            }
        });
    });
</script>

<script>
    // $(document).ready(function() {
    //     let basePrice = parseFloat(`{{ $product_detail->price }}`);
    //     let variationPrices = {};

    //     function updateVariationPriceLabel(attributeName, price) {
    //         $(`h3.variation-title[data-attribute="${attributeName}"] .selected-price`)
    //             .html(price > 0 ? `($${price.toFixed(2)})` : '');
    //     }

    //     $('input.radio-box:checked').each(function() {
    //         const attributeName = $(this).attr('name').replace('variation[', '').replace(']', '');
    //         const selectedPrice = parseFloat($(this).data('price')) || 0;
    //         variationPrices[attributeName] = selectedPrice;
    //         basePrice += selectedPrice;
    //         updateVariationPriceLabel(attributeName, selectedPrice);
    //     });

    //     updatePriceDisplay(basePrice);

    //     $('input.radio-box').on('change', function() {
    //         const attributeName = $(this).attr('name').replace('variation[', '').replace(']', '');
    //         const selectedPrice = parseFloat($(this).data('price')) || 0;

    //         if (variationPrices[attributeName]) {
    //             basePrice -= variationPrices[attributeName];
    //         }

    //         basePrice += selectedPrice;
    //         variationPrices[attributeName] = selectedPrice;

    //         updateVariationPriceLabel(attributeName, selectedPrice);
    //         updatePriceDisplay(basePrice);
    //     });

    //     function updatePriceDisplay(price) {
    //         const base = parseFloat(`{{ $product_detail->price }}`);
    //         const variationTotal = price - base;

    //         $('#basePriceDisplay').html(base.toFixed(2));
    //         $('#variationPriceDisplay').html(variationTotal.toFixed(2));
    //         $('#totalPriceDisplay').html(price.toFixed(2));
    //         $('meta[itemprop="price"]').attr('content', price.toFixed(2));
    //     }
    // });
    $(document).ready(function () {
        let variations = JSON.parse($('#variation-data').val());
        let basePrice = parseFloat('{{ $product_detail->price }}');
        let selectedAttributes = {};

        // Dynamically get all unique attribute IDs and find the last one
        let uniqueAttributeIds = $('.variation-selector').map(function () {
            return $(this).data('attribute-id');
        }).get().filter((v, i, a) => a.indexOf(v) === i);

        let firstAttributeId = uniqueAttributeIds[0];
        let lastAttributeId = uniqueAttributeIds[uniqueAttributeIds.length - 1];

        let variationMap = {};

        // Group variations based on first attribute
        variations.forEach(variation => {
            let firstAttrValueId = null;

            variation.variation_values.forEach(vv => {
                if (vv.attribute_id === firstAttributeId) {
                    firstAttrValueId = vv.attribute_value_id;
                }
            });

            if (firstAttrValueId) {
                if (!variationMap[firstAttrValueId]) {
                    variationMap[firstAttrValueId] = [];
                }
                variationMap[firstAttrValueId].push(variation);
            }
        });

        $('.variation-selector').on('change', function () {
            let attributeId = $(this).data('attribute-id');
            let valueId = parseInt($(this).val());

            selectedAttributes[attributeId] = valueId;

            // If first attribute is changed, reset all next selections
            if (attributeId === firstAttributeId) {
                let availableVariations = variationMap[valueId];

                if (availableVariations) {
                    let allowedChildValues = [];

                    availableVariations.forEach(variation => {
                        variation.variation_values.forEach(vv => {
                            if (vv.attribute_id !== firstAttributeId) {
                                allowedChildValues.push(vv.attribute_value_id);
                            }
                        });
                    });

                    $('.variation-selector').each(function () {
                        if ($(this).data('attribute-id') !== firstAttributeId) {
                            let optionValue = parseInt($(this).val());

                            if (allowedChildValues.includes(optionValue)) {
                                $(this).closest('label').show();
                            } else {
                                $(this).closest('label').hide();
                                $(this).prop('checked', false);

                                let attrId = $(this).data('attribute-id');
                                delete selectedAttributes[attrId];
                            }
                        }
                    });

                    // Always reset price on parent change
                    $('#productPriceDisplay').text(`$${basePrice.toFixed(2)}`);
                    $('#productPrice').val(basePrice.toFixed(2));
                }
            }

            // Check if ALL attributes are selected (including last)
            let totalSelected = Object.keys(selectedAttributes).length;
            let requiredSelections = uniqueAttributeIds.length;

            // ✅ Price will update ONLY if last attribute is selected
            if (selectedAttributes.hasOwnProperty(lastAttributeId)) {
                // Find the matching variation
                let matchedVariation = variations.find(variation => {
                    let isMatch = true;

                    variation.variation_values.forEach(vv => {
                        // ✅ Only check attributes that are selected
                        if (selectedAttributes.hasOwnProperty(vv.attribute_id)) {
                            if (selectedAttributes[vv.attribute_id] != vv.attribute_value_id) {
                                isMatch = false;
                            }
                        }
                    });

                    return isMatch;
                });

                if (matchedVariation) {
                    $('#productPriceDisplay').text(`$${parseFloat(matchedVariation.price).toFixed(2)}`);
                    $('#productPrice').val(parseFloat(matchedVariation.price).toFixed(2));
                } else {
                    $('#productPriceDisplay').text(`$${basePrice.toFixed(2)}`);
                    $('#productPrice').val(basePrice.toFixed(2));
                }
            }
        });

        function getVariationImage(attributeId, attributeValueId) {
            const variations = JSON.parse(document.getElementById('variation-data').value);

            for (let i = 0; i < variations.length; i++) {
                let variation = variations[i];

                for (let j = 0; j < variation.variation_values.length; j++) {
                    let vValue = variation.variation_values[j];

                    if (vValue.attribute_id == attributeId && vValue.attribute_value_id == attributeValueId) {
                        return variation.image; // Return the image from ProductAttribute
                    }
                }
            }
            return null;
        }

    });
</script>

@endsection
