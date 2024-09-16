@extends('layouts.main')
@section('content')
@section('canonical_tag_href', 'https://epdworld.com/about-us')
@section('title', 'About Us')
@section('meta_descriptoion', 'Our collection of stylish shoes, bags, and jewelry is carefully chosen to reflect our passion for quality and fashion.')
<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->




<div id="content" class="site-content" tabindex="-1">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <article class="has-post-thumbnail hentry">
                    <header class="entry-header header-with-cover-image"
                        style="background-image: url({!! asset($page->image) !!});">
                        <div class="caption">
                            {!! $page->content !!}
                        </div>
                    </header>
                    <!-- .entry-header -->
                    <div class="entry-content">
                        <div class="row about-features inner-top-md inner-bottom-sm">
                            <div class="col-xs-12 col-md-4">
                                <figure class="wpb_wrapper vc_figure outer-bottom-xs">
                                    <div class="vc_single_image-wrapper"> <img src="images/blank.gif"
                                            data-echo="{!! asset($section[0]->value) !!}" class="img-responsive" alt="">
                                    </div>
                                </figure>
                                <div class="text-content">
                                    <h2 class="align-top">{!! $section[1]->value !!}</h2>
                                    <p>{!! $section[2]->value !!}
                                    </p>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="col-xs-12 col-md-4">
                                <figure class="wpb_wrapper vc_figure outer-bottom-xs">
                                    <div class="vc_single_image-wrapper"> <img src="images/blank.gif"
                                            data-echo="{!! asset($section[3]->value) !!}" class="img-responsive" alt="">
                                    </div>
                                </figure>
                                <div class="text-content">
                                    <h2 class="align-top">{!! $section[4]->value !!}</h2>
                                    <p>{!! $section[5]->value !!}
                                    </p>
                                </div>
                            </div>
                            <!-- .col -->
                            <div class="col-xs-12 col-md-4">
                                <figure class="wpb_wrapper vc_figure outer-bottom-xs">
                                    <div class="vc_single_image-wrapper"> <img src="images/blank.gif"
                                            data-echo="{!! asset($section[6]->value) !!}" class="img-responsive" alt="">
                                    </div>
                                </figure>
                                <div class="text-content">
                                    <h2 class="align-top">{!! $section[7]->value !!}</h2>
                                    <p>{!! $section[8]->value !!}
                                    </p>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- .row -->
                        <!--<div class="light-bg team-member-wrapper ">-->
                        <!--    <div class="container">-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/1.jpg" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>Thomas Snow <small class="description">CEO/Founder</small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                    
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/2.jpg" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>Anna Baranov <small class="description">Client Care</small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                    
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/3.jpg" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>Andre Kowalsy <small class="description">Support-->
                        <!--                                Boss</small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                   
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/4.jpg" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>Pamela Doe <small class="description">Delivery-->
                        <!--                                Driver</small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                    
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/5.jpg" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>Susan McCain <small class="description">Packaging-->
                        <!--                                Girl</small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                    
                        <!--            <div class="col-sm-2">-->
                        <!--                <div class="team-member circle"> <img src="images/blank.gif"-->
                        <!--                        data-echo="images/team-member/7.png" class="img-responsive" alt="">-->
                        <!--                    <div class="profile">-->
                        <!--                        <h3>See Details <small class="description"></small>-->
                        <!--                        </h3>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                                  
                        <!--        </div>-->
                                
                        <!--    </div>-->
                            
                        <!--</div>-->
                        <!-- .row -->
                        <div class="vc_row-full-width vc_clearfix"></div>
                        <div class="row">
                            <!--<div class="text-boxes col-sm-7">-->
                            <!--    <div class="row inner-bottom-xs">-->
                            <!--        <div class="col-sm-6">-->
                            <!--            <div class="wpb_wrapper">-->
                            <!--                <h3 class="highlight">{!! $section[1]->value !!}</h3>-->
                            <!--                <p>{!! $section[2]->value !!}</p>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--        <div class="col-sm-6">-->
                            <!--            <div class="wpb_wrapper">-->
                            <!--                <h3 class="highlight">{!! $section[4]->value !!}</h3>-->
                            <!--                <p>{!! $section[5]->value !!}</p>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="row inner-bottom-xs">-->
                            <!--        <div class="col-sm-6">-->
                            <!--            <div class="wpb_wrapper">-->
                            <!--                <h3 class="highlight">{!! $section[7]->value !!}</h3>-->
                            <!--                <p>{!! $section[8]->value !!}</p>-->
                            <!--            </div>-->
                            <!--        </div>-->
                                    
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="wpb-accordion col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <h2>What can we do for you ?</h2>
                                        <div class="vc_general vc_tta vc_tta-accordion" id="accordion">
                                            <div class="vc_tta-panels">
                                                <div class="vc_tta-panel vc_active">
                                                    <div class="vc_tta-panel-heading">
                                                        <h4 class="vc_tta-panel-title">
                                                            <a aria-controls="collapseOne" aria-expanded="false"
                                                                href="#collapseOne" data-parent="#accordion"
                                                                data-toggle="collapse" role="button">
                                                                <span class="text">{!! $section[9]->value !!}</span>
                                                                <i
                                                                    class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="vc_tta-panel-body collapse in">
                                                        <p>{!! $section[10]->value !!}</p>
                                                    </div>
                                                </div>
                                                <div class="vc_tta-panel">
                                                    <div class="vc_tta-panel-heading">
                                                        <h4 class="vc_tta-panel-title">
                                                            <a aria-controls="collapseTwo" aria-expanded="false"
                                                                href="#collapseTwo" class="collapsed"
                                                                data-parent="#accordion" data-toggle="collapse"
                                                                role="button">
                                                                <span class="text">{!! $section[11]->value !!}</span>
                                                                <i
                                                                    class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseTwo" class="vc_tta-panel-body collapse">
                                                        <p>{!! $section[12]->value !!}</p>
                                                    </div>
                                                </div>
                                                <div class="vc_tta-panel">
                                                    <div class="vc_tta-panel-heading">
                                                        <h4 class="vc_tta-panel-title">
                                                            <a aria-controls="collapseThree" aria-expanded="false"
                                                                href="#collapseThree" class="collapsed"
                                                                data-parent="#accordion" data-toggle="collapse"
                                                                role="button">
                                                                <span class="text">{!! $section[13]->value !!}</span>
                                                                <i
                                                                    class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="vc_tta-panel-body collapse">
                                                        <p>{!! $section[14]->value !!}</p>
                                                    </div>
                                                </div>
                                                <div class="vc_tta-panel">
                                                    <div class="vc_tta-panel-heading">
                                                        <h4 class="vc_tta-panel-title">
                                                            <a aria-controls="collapseFour" aria-expanded="false"
                                                                href="#collapseFour" class="collapsed"
                                                                data-parent="#accordion" data-toggle="collapse"
                                                                role="button">
                                                                <span class="text">{!! $section[15]->value !!}</span>
                                                                <i
                                                                    class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFour" class="vc_tta-panel-body collapse">
                                                        <p>{!! $section[16]->value !!}</p>
                                                    </div>
                                                </div>
                                                {{-- <div class="vc_tta-panel">
                                                    <div class="vc_tta-panel-heading">
                                                        <h4 class="vc_tta-panel-title">
                                                            <a aria-controls="collapseFive" aria-expanded="false"
                                                                href="#collapseFive" class="collapsed"
                                                                data-parent="#accordion" data-toggle="collapse"
                                                                role="button">
                                                                <span class="text">Support 24/7</span>
                                                                <i
                                                                    class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFive" class="vc_tta-panel-body collapse">
                                                        <p>Vestibulum velit nibh, egestas vel faucibus vitae,
                                                            feugiat sollicitudin urna. Praesent iaculis id ipsum
                                                            sit amet pretium. Aliquam tristique sapien nec enim
                                                            euismod, scelerisque facilisis arcu consectetur.</p>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
