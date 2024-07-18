<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#site-navigation">Skip to navigation</a>
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

    <div class="top-bar hidden-md-down">
        <div class="container">
            <div class="row" >
            <div class="col-md-12 col-12">
                <div class="top-bar-parent">
            <nav>
                <ul id="menu-top-bar-left" class="nav nav-inline pull-left animate-dropdown flip">
                    <li class="menu-item animate-dropdown"><a title="Welcome to Worldwide Electronics Store"
                            href="#">{!! App\Http\Traits\HelperTrait::returnFlag(1967) !!}</a></li>
                </ul>
            </nav>

            <nav>
                <ul id="menu-top-bar-right" class="nav nav-inline pull-right animate-dropdown flip">
                    <!--<li class="menu-item animate-dropdown"><a title="Store Locator" href="#"><i-->
                    <!--            class="ec ec-map-pointer"></i>Store Locator</a></li>-->
                    <!--<li class="menu-item animate-dropdown"><a title="Track Your Order" href="#"><i-->
                    <!--            class="ec ec-transport"></i>Track Your Order</a></li>-->
                    <li class="menu-item animate-dropdown"><a title="Shop" href="{!! route('shop') !!}"><i
                                class="ec ec-shopping-bag"></i>Shop</a></li>
                    @if (Auth::user())
                        <li class="menu-item animate-dropdown"><a title="My Account" href="{{ route('account') }}"><i
                                    class="ec ec-user"></i>Hi, {{ Auth::user()->name }}</a></li>
                    @else
                        <li class="menu-item animate-dropdown"><a title="My Account" href="{{ route('signin') }}"><i
                                    class="ec ec-user"></i>My
                                Account</a></li>
                    @endif
                    @if(Auth::check())
                    <li class="menu-item animate-dropdown"><a href="{{ route('account') }}"><i
                                    class="ec ec-user"></i>Request to be an affiliate seller</a></li>
                    @else
                    <li class="menu-item animate-dropdown"><a href="{{ route('seller-signup') }}"><i
                                    class="ec ec-user"></i>Request to be an affiliate seller</a></li>
                    @endif

                </ul>
            </nav>
            </div>
            </div>
            </div>
        </div>
    </div><!-- /.top-bar -->

    <header id="masthead" class="site-header header-v2">
        <div class="container hidden-md-down">
            <div class="row headerRow">

                <!-- ============================================================= Header Logo ============================================================= -->
                <div class="header-logo">
                    <a href="{{ route('home') }}" aria-label="logo" class="header-logo-link">

                        <img src="{{ asset($logo->img_path) }}" width="100%" height="100%" alt="">
                    </a>
                </div>
                <!-- ============================================================= Header Logo : End============================================================= -->

                <div class="primary-nav animate-dropdown">
                    <div class="clearfix">
                        <button class="navbar-toggler hidden-sm-up pull-right flip" type="button"
                            data-toggle="collapse" data-target="#default-header">
                            &#9776;
                        </button>
                    </div>

                    <div class="collapse navbar-toggleable-xs" id="default-header">
                        <nav>
                            <ul id="menu-main-menu" class="nav nav-inline yamm">
                                <li class="menu-item menu-item-has-children nav-item"><a href="{!! route('home') !!}"
                                        class="nav-link">Home</a>
                                </li>
                                <li class="menu-item animate-dropdown"><a href="{!! route('about') !!}">About
                                        Us</a></li>

                                <li class="menu-item animate-dropdown"><a href="{!! route('shop') !!}">Shop</a>
                                </li>

                                <li class="menu-item"><a title="Features" href="{!! route('features') !!}">Features</a>
                                </li>
                                <li class="menu-item"><a title="Contact Us" href="{!! route('contact') !!}">Contact
                                        Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="header-support-info">
                    <div class="media">
                        <span class="media-left support-icon media-middle"><i class="ec ec-support"></i></span>
                        <div class="media-body">
                            <span class="support-number"><strong>Support</strong> {!! App\Http\Traits\HelperTrait::returnFlag(59) !!}</span><br />
                            <span class="support-email">Email: {!! App\Http\Traits\HelperTrait::returnFlag(218) !!}</span>
                        </div>
                    </div>
                </div>

            </div><!-- /.row -->
        </div>

        <div class="container hidden-lg-up">
            <div class="handheld-header">

                <!-- ============================================================= Header Logo ============================================================= -->
                <div class="header-logo">
                    <a href="{{ route('home') }}" aria-label="logo" class="header-logo-link">
                        <img src="{{ asset($logo->img_path) }}" alt="" width="100%" height="100%" >
                    </a>
                </div>
                <!-- ============================================================= Header Logo : End============================================================= -->


            </div>
        </div>

    </header>

    @php
        $parentCategories = App\Category::where('parent', 0)
            ->with('children')
            ->get();
        
    @endphp

    <body class="home-v2">
        <nav class="navbar navbar-primary navbar-full hidden-md-down">
            <div class="container">
                <ul class="nav navbar-nav departments-menu animate-dropdown">
                    <li class="nav-item dropdown hrvbtr">

                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"
                            id="departments-menu-toggle">BROWSE
                            CATEGORY</a>
                        <ul id="menu-vertical-menu"
                            class="dropdown-menu yamm departments-menu-dropdown animated-dropdown">
                            @foreach ($parentCategories as $item)
                                @if ($item->children->isEmpty())
                                    <li class="menu-item animate-dropdown"><a title="Accessories"
                                            href="">{{ $item->name }}</a></li>
                                @else
                                    <li class="yamm-tfw menu-item menu-item-has-children  menu-item-2590 dropdown">

                                        <a title="Beauty &amp; Health" href=""
                                            data-toggle="dropdown" class="dropdown-toggle"
                                            aria-haspopup="true">{{ $item->name }}</a>
                                        <ul role="menu" class=" dropdown-menu"
                                            style="min-height: 389.004px; visibility: hidden; display: none; width: 600px !important; opacity: 1;">
                                            <li class="menu-item animate-dropdown menu-item-object-static_block"
                                                style="min-height: 385.004px;">
                                                <div class="yamm-content">
                                                    <div class="vc_row row wpb_row vc_row-fluid">
                                                        <div
                                                            class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                            <div class="vc_column-inner ">
                                                                <div class="wpb_wrapper">
                                                                    <div class="wpb_text_column wpb_content_element ">
                                                                        <div class="wpb_wrapper custom-wbp-wrapper">

                                                                            @foreach ($item->children as $children)
                                                                                @if (!$children->children->isEmpty())
                                                                                    <ul>
                                                                                        <li class="nav-title"><a
                                                                                                href="{{ route('categoryDetail', ['id' => $children->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $children->name)))]) }}">{{ $children->name }}</a>
                                                                                        </li>
                                                                                        @foreach ($children->children as $forechildren)
                                                                                            <li><a
                                                                                                    href="{{ route('categoryDetail', ['id' => $forechildren->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $forechildren->name)))]) }}">{{ $forechildren->name }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            @endforeach


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <form class="navbar-search"action="{{ route('shop') }}" method="get">
                    <label class="sr-only screen-reader-text" for="search">Search for:</label>
                    <div class="input-group">
                        <input type="text" id="name" class="form-control search-field" dir="ltr"
                            value="{{ ucwords(str_replace("-"," ",Request::get('name'))) }}" name="name" placeholder="Search for products" />
                        <div class="input-group-addon search-categories">
                            <select name='product_cat' id='product_cat' class='postform resizeselect'>
                                @php
                                    $cat = App\Category::all();
                                @endphp
                                <option value='0' selected='selected'>All Categories</option>
                                @foreach ($cat as $cats)
                                    <option class="level-0" value='{!! $cats->id !!}' {!! Request::get('product_cat') == $cats->id ? 'selected' : '' !!}>{!! $cats->name !!}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                        </div>
                    </div>
                </form>

                <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
                    <li class="nav-item dropdown">
                        <a href="{!! route('cart') !!}" class="nav-link">
                           <i class="fas fa-shopping-cart"></i>
                            <span class="cart-items-count count">{!! count(Session::get('cart')) !!}</span>
                            <span class="cart-items-total-price total-price">
                                @php
                                    $total = 0;
                                    foreach (Session::get('cart') as $key => $value) {
                                        $total += $value['baseprice'];
                                    }
                                @endphp
                                @if ($total > 0)
                                    <span class="amount">&#36;{{ $total }}</span>
                                @endif
                            </span>
                        </a>

                    </li>
                </ul>

                <ul class="navbar-wishlist nav navbar-nav pull-right flip">
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="ec ec-favorites"></i></a>
                    </li>
                </ul>
                <ul class="navbar-compare nav navbar-nav pull-right flip">
                    <li class="nav-item">
                        <a href="" class="nav-link"><i class="ec ec-compare"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
