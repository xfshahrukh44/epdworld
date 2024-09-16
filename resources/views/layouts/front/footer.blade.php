
<footer id="colophon" class="site-footer">
<div class="footer-newsletter">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7">
                <h5 class="newsletter-title">{!! App\Http\Traits\HelperTrait::returnFlag(1971) !!}</h5>
                <!--{!! App\Http\Traits\HelperTrait::returnFlag(1972) !!}-->
            </div>
            <div class="col-xs-12 col-sm-5">
                <form id="newForm">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter your email address" id="newemail">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Sign Up</button>
                        </span>
                    </div>
                </form>
                <div id="newsresult"></div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom-widgets">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-md-push-4">
                <div class="columns">
                    <aside id="nav_menu-2" class="widget clearfix widget_nav_menu">
                        <div class="body">
                            <h4 class="widget-title">Find It Fast</h4>
                            <div class="menu-footer-menu-1-container">
                                <ul id="menu-footer-menu-1" class="menu">
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/79?name=mens-shoes">Men's Shoes</a>
                                    </li>
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/2?name=womens-shoes">Women's Shoes</a></li>
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/86?name=flats">Flats</a></li>
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/3?name=pumps">Pumps</a></li>
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/9?name=evening-bags">Evening Bags</a></li>
                                    <li class="menu-item"><a href="https://epdworld.com/category-detail/58?name=eye-massage-equipment">Eye Massage Equipment</a></li>
                                    <li class="menu-item "><a href="https://epdworld.com/category-detail/109?name=fashion-jewelry">Fashion Jewelry</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div><!-- /.columns -->

                <div class="columns">
                    <aside id="nav_menu-3" class="widget clearfix widget_nav_menu">
                        <div class="body">
                            <h4 class="widget-title">&nbsp;</h4>
                            <div class="menu-footer-menu-2-container">
                                <ul id="menu-footer-menu-2" class="menu">
                                    <li class="menu-item"><a href=https://epdworld.com/category-detail/133?name=bikinis--beachwear"">Bikinis & Beachwear</a></li>
                                    <li class="menu-item "><a href="https://epdworld.com/category-detail/127?name=human-hair-wigs">Human Hair Wigs</a></li>
                                    <li
                                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2742">
                                        <a href="https://epdworld.com/category-detail/57?name=other-beauty--personal-care-productsnew">Other Beauty & Personal Care</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div><!-- /.columns -->

                <div class="columns">
                    <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                        <div class="body">
                            <h4 class="widget-title">Customer Care</h4>
                            <div class="menu-footer-menu-3-container">
                                <ul id="menu-footer-menu-3" class="menu">
                                    @if(Auth::check())
                                    <li class="menu-item"><a href="{{ route('account') }}">My Account</a></li>
                                    @else
                                    <li class="menu-item"><a href="{{ route('signin') }}">My Account</a></li>
                                    @endif
                                    <!--<li class="menu-item"><a href="">Track your Order</a></li>-->
                                    <li class="menu-item"><a href="{!! route('about') !!}">About Us</a></li>
                                    <li class="menu-item"><a href="{!! route('shop') !!}">Shop</a></li>
                                    <li class="menu-item"><a href="{!! route('features') !!}">Features</a></li>
                                    <!--<li class="menu-item"><a href="">FAQs</a></li>-->
                                    
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div><!-- /.columns -->
                
                <div class="columns columnsss">
                    <aside id="nav_menu-4" class="widget clearfix widget_nav_menu">
                        <div class="body">
                            <h4 class="widget-title">Products by Country and Region</h4>
                            <div class="menu-footer-menu-3-container">
                                <ul id="menu-footer-menu-4" class="menu">
                                    <li class="menu-item"><a href="{!! route('australia') !!}">Australia</a></li>
                                    <li class="menu-item"><a href="{!! route('brazil') !!}">Brazil</a></li>
                                    <li class="menu-item"><a href="{!! route('canada') !!}">Canada</a></li>
                                    <li class="menu-item"><a href="{!! route('france') !!}">France</a></li>
                                    <li class="menu-item"><a href="{!! route('germany') !!}">Germany</a></li>
                                    <li class="menu-item"><a href="{!! route('india') !!}">India</a></li>
                                    <li class="menu-item"><a href="{!! route('italy') !!}">Italy</a></li>
                                    <li class="menu-item"><a href="{!! route('malaysia') !!}">Malaysia</a></li>
                                    <li class="menu-item"><a href="{!! route('mexico') !!}">Mexico</a></li>
                                    <li class="menu-item"><a href="{!! route('spain') !!}">Spain</a></li>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div><!-- /.columns -->

            </div><!-- /.col -->

            <div class="footer-contact col-xs-12 col-sm-12 col-md-4 col-md-pull-8">
                <div class="footer-logo">
                    <img data-src="{!! asset($logo->img_path) !!}" class="lazy" alt="Elite Product Limited">
                </div><!-- /.footer-contact -->

                <div class="footer-call-us">
                    <div class="media">
                        <span class="media-left call-us-icon media-middle"><i class="ec ec-support"></i></span>
                        <div class="media-body">
                            <span class="call-us-text">Got Questions ? Call us 24/7!</span>
                            <span class="call-us-number">{!! App\Http\Traits\HelperTrait::returnFlag(59) !!}</span>
                        </div>
                    </div>
                </div><!-- /.footer-call-us -->


                <div class="footer-address">
                    <strong class="footer-address-title">Contact Info</strong>
                    <address>{!! App\Http\Traits\HelperTrait::returnFlag(519) !!}</address>
                </div><!-- /.footer-address -->

                <div class="footer-social-icons">
                    <ul class="social-icons list-unstyled">
                        <li>
                            <a aria-label="facebook" href="{!! App\Http\Traits\HelperTrait::returnFlag(682) !!}">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a  aria-label="twitter" href="{!! App\Http\Traits\HelperTrait::returnFlag(1960) !!}">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="pinterest" href="{!! App\Http\Traits\HelperTrait::returnFlag(1961) !!}">
                                <i class="fa-brands fa-pinterest"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="linkedin" href="{!! App\Http\Traits\HelperTrait::returnFlag(1962) !!}">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="tumblr" href="{!! App\Http\Traits\HelperTrait::returnFlag(1963) !!}">
                                <i class="fa-brands fa-tumblr"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="instagram" href="{!! App\Http\Traits\HelperTrait::returnFlag(1965) !!}">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="youtube" href="{!! App\Http\Traits\HelperTrait::returnFlag(1964) !!}">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a aria-label="rss" href="{!! App\Http\Traits\HelperTrait::returnFlag(1968) !!}">
                                <i class="fa-solid fa-rss"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="copyright-bar">
    <div class="container">
        <div class="pull-left flip copyright">&copy; <a href="">EPD WORLD 2021 - {!! Carbon\Carbon::now()->format('Y') !!}</a> - All Rights Reserved</div>
        <div class="pull-right flip payment">
            <div class="footer-payment-logo">
                <ul class="cash-card card-inline">
                    <li class="card-item"><img data-src="{!! asset('images/1.png') !!}" class="lazy" alt="card" width="52px" height="100%" ></li>
                    <li class="card-item"><img data-src="{!! asset('images/2.png') !!}" class="lazy" alt="card" width="52px" height="100%" ></li>
                    <li class="card-item"><img data-src="{!! asset('images/3.png') !!}" class="lazy" alt="card" width="52px" height="100%" ></li>
                    <li class="card-item"><img data-src="{!! asset('images/4.png') !!}" class="lazy" alt="card" width="52px" height="100%" ></li>
                    <li class="card-item"><img data-src="{!! asset('images/5.png') !!}" class="lazy" alt="card" width="52px" height="100%" ></li>
                </ul>
            </div><!-- /.payment-methods -->
        </div>
    </div><!-- /.container -->
</div><!-- /.copyright-bar -->
</footer><!-- #colophon -->

</div><!-- #page -->
