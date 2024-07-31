@extends('layouts.main')
@section('title', $blog->meta_title ?? '')
@section('meta_title', $blog->meta_title ?? '')
@section('meta_descriptoion', $blog->meta_descriptoion ?? '')
@section('canonical_tag_href', $blog->canonical_tag_href ?? '')

@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->




<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article class="has-post-thumbnail hentry">
                    <!-- .entry-header -->
                    <div class="entry-content">
                        <div class="row about-features inner-top-md inner-bottom-sm">
                            <div class="col-md-12" style="text-align: left;">
                                {!! $blog->detail !!}
                            </div>
                        </div>
                    </div>
                    <!-- .entry-content -->
                </article>
                <!-- #post-## -->
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
    <!-- .col-full -->
</div>
<!-- #content -->

<!--<section class="brands-carousel">-->
<!--    <h2 class="sr-only">Brands Carousel</h2>-->
<!--    <div class="container">-->
<!--        <div id="owl-brands" class="owl-brands owl-carousel unicase-owl-carousel owl-outer-nav">-->

<!--            <div class="item">-->

<!--                <a href="#">-->

<!--                    <figure>-->
<!--                        <figcaption class="text-overlay">-->
<!--                            <div class="info">-->
<!--                                <h4>Acer</h4>-->
<!--                            </div>-->
<!--                        </figcaption>-->

<!--                        <img src="images/blank.gif" data-echo="images/brands/1.png" class="img-responsive" alt="">-->

<!--                    </figure>-->
<!--                </a>-->
<!--            </div>-->


<!--        </div>-->

<!--    </div>-->
<!--</section>-->



@endsection
@section('css')
<style>

.header-with-cover-image {
    background-size: cover;
    background-position: center top;
    width: 100vw;
    margin-left: -50vw;
    left: 50%;
    position: relative;
    min-height: 589px;
    margin-bottom: 0;
}

.caption {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.caption h1 {
    font-weight: 700;
    margin-bottom: 0;
    text-align: center;
}

.caption h1{
    color: #fff;
}

.caption .entry-subtitle {
    color: #fff;
    font-size: 1.286em;
    position: relative;
    top: 1.667em;
    text-align: center;
}


</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
