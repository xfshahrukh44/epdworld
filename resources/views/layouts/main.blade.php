<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="@yield('meta_title')">
    <meta name="description" content="@yield('meta_descriptoion')">
    <link rel="canonical" href="@yield('canonical_tag_href')" />
    <meta name="author" content="Admin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--<meta name="google-site-verification" content="f9t6uOoo5Xkcul28cXfrCjZewfNhOifG4X6TFO6TeAo" />-->
    <meta name="google-site-verification" content="f9t6uOoo5Xkcul28cXfrCjZewfNhOifG4X6TFO6TeAo" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H21WNMHKBX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-H21WNMHKBX');
    </script>



    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset(!empty($favicon->img_path) ? $favicon->img_path : '') }}">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.min.css') }}">



    <script type="application/ld+json">
                     {
                    "@context": "https://schema.org",
                    "@type": "ShoppingCenter",
                    "name": "EPD World",
                    "image": "https://epdworld.com/uploads/imagetable/logo-2_1672685160.webp",
                      "@id": "",
                      "url": "https://epdworld.com/",
                        "telephone": "508-820-0648",
                    "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "123 Avenue Abc Street",
                    "addressLocality": "Mississippi",
                        "postalCode": "38801",
                        "addressCountry": "US"
                         }  
                        }
            </script>



    <!-- ============================================================== -->
    <!-- All CSS LINKS IN BELOW FILE -->
    <!-- ============================================================== -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <style>
        .toast-title {
            font-weight: bold;
        }

        .toast-message {
            -ms-word-wrap: break-word;
            word-wrap: break-word;
        }

        .toast-message a,
        .toast-message label {
            color: #FFFFFF;
        }

        .toast-message a:hover {
            color: #CCCCCC;
            text-decoration: none;
        }

        .toast-close-button {
            position: relative;
            right: -0.3em;
            top: -0.3em;
            float: right;
            font-size: 20px;
            font-weight: bold;
            color: #FFFFFF;
            -webkit-text-shadow: 0 1px 0 #ffffff;
            text-shadow: 0 1px 0 #ffffff;
            opacity: 0.8;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
            filter: alpha(opacity=80);
            line-height: 1;
        }

        .toast-close-button:hover,
        .toast-close-button:focus {
            color: #000000;
            text-decoration: none;
            cursor: pointer;
            opacity: 0.4;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=40);
            filter: alpha(opacity=40);
        }

        .rtl .toast-close-button {
            left: -0.3em;
            float: left;
            right: 0.3em;
        }

        button.toast-close-button {
            padding: 0;
            cursor: pointer;
            background: transparent;
            border: 0;
            -webkit-appearance: none;
        }

        .toast-top-center {
            top: 0;
            right: 0;
            width: 100%;
        }

        .toast-bottom-center {
            bottom: 0;
            right: 0;
            width: 100%;
        }

        .toast-top-full-width {
            top: 0;
            right: 0;
            width: 100%;
        }

        .toast-bottom-full-width {
            bottom: 0;
            right: 0;
            width: 100%;
        }

        .toast-top-left {
            top: 12px;
            left: 12px;
        }

        .toast-top-right {
            top: 12px;
            right: 12px;
        }

        .toast-bottom-right {
            right: 12px;
            bottom: 12px;
        }

        .toast-bottom-left {
            bottom: 12px;
            left: 12px;
        }

        #toast-container {
            position: fixed;
            z-index: 999999;
            pointer-events: none;
        }

        #toast-container * {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        #toast-container>div {
            position: relative;
            pointer-events: auto;
            overflow: hidden;
            margin: 0 0 6px;
            padding: 15px 15px 15px 50px;
            width: 300px;
            -moz-border-radius: 3px 3px 3px 3px;
            -webkit-border-radius: 3px 3px 3px 3px;
            border-radius: 3px 3px 3px 3px;
            background-position: 15px center;
            background-repeat: no-repeat;
            -moz-box-shadow: 0 0 12px #999999;
            -webkit-box-shadow: 0 0 12px #999999;
            box-shadow: 0 0 12px #999999;
            color: #FFFFFF;
            opacity: 0.8;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=80);
            filter: alpha(opacity=80);
        }

        #toast-container>div.rtl {
            direction: rtl;
            padding: 15px 50px 15px 15px;
            background-position: right 15px center;
        }

        #toast-container>div:hover {
            -moz-box-shadow: 0 0 12px #000000;
            -webkit-box-shadow: 0 0 12px #000000;
            box-shadow: 0 0 12px #000000;
            opacity: 1;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            filter: alpha(opacity=100);
            cursor: pointer;
        }

        #toast-container>.toast-info {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGwSURBVEhLtZa9SgNBEMc9sUxxRcoUKSzSWIhXpFMhhYWFhaBg4yPYiWCXZxBLERsLRS3EQkEfwCKdjWJAwSKCgoKCcudv4O5YLrt7EzgXhiU3/4+b2ckmwVjJSpKkQ6wAi4gwhT+z3wRBcEz0yjSseUTrcRyfsHsXmD0AmbHOC9Ii8VImnuXBPglHpQ5wwSVM7sNnTG7Za4JwDdCjxyAiH3nyA2mtaTJufiDZ5dCaqlItILh1NHatfN5skvjx9Z38m69CgzuXmZgVrPIGE763Jx9qKsRozWYw6xOHdER+nn2KkO+Bb+UV5CBN6WC6QtBgbRVozrahAbmm6HtUsgtPC19tFdxXZYBOfkbmFJ1VaHA1VAHjd0pp70oTZzvR+EVrx2Ygfdsq6eu55BHYR8hlcki+n+kERUFG8BrA0BwjeAv2M8WLQBtcy+SD6fNsmnB3AlBLrgTtVW1c2QN4bVWLATaIS60J2Du5y1TiJgjSBvFVZgTmwCU+dAZFoPxGEEs8nyHC9Bwe2GvEJv2WXZb0vjdyFT4Cxk3e/kIqlOGoVLwwPevpYHT+00T+hWwXDf4AJAOUqWcDhbwAAAAASUVORK5CYII=") !important;
        }

        #toast-container>.toast-error {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHOSURBVEhLrZa/SgNBEMZzh0WKCClSCKaIYOED+AAKeQQLG8HWztLCImBrYadgIdY+gIKNYkBFSwu7CAoqCgkkoGBI/E28PdbLZmeDLgzZzcx83/zZ2SSXC1j9fr+I1Hq93g2yxH4iwM1vkoBWAdxCmpzTxfkN2RcyZNaHFIkSo10+8kgxkXIURV5HGxTmFuc75B2RfQkpxHG8aAgaAFa0tAHqYFfQ7Iwe2yhODk8+J4C7yAoRTWI3w/4klGRgR4lO7Rpn9+gvMyWp+uxFh8+H+ARlgN1nJuJuQAYvNkEnwGFck18Er4q3egEc/oO+mhLdKgRyhdNFiacC0rlOCbhNVz4H9FnAYgDBvU3QIioZlJFLJtsoHYRDfiZoUyIxqCtRpVlANq0EU4dApjrtgezPFad5S19Wgjkc0hNVnuF4HjVA6C7QrSIbylB+oZe3aHgBsqlNqKYH48jXyJKMuAbiyVJ8KzaB3eRc0pg9VwQ4niFryI68qiOi3AbjwdsfnAtk0bCjTLJKr6mrD9g8iq/S/B81hguOMlQTnVyG40wAcjnmgsCNESDrjme7wfftP4P7SP4N3CJZdvzoNyGq2c/HWOXJGsvVg+RA/k2MC/wN6I2YA2Pt8GkAAAAASUVORK5CYII=") !important;
        }

        #toast-container>.toast-success {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAADsSURBVEhLY2AYBfQMgf///3P8+/evAIgvA/FsIF+BavYDDWMBGroaSMMBiE8VC7AZDrIFaMFnii3AZTjUgsUUWUDA8OdAH6iQbQEhw4HyGsPEcKBXBIC4ARhex4G4BsjmweU1soIFaGg/WtoFZRIZdEvIMhxkCCjXIVsATV6gFGACs4Rsw0EGgIIH3QJYJgHSARQZDrWAB+jawzgs+Q2UO49D7jnRSRGoEFRILcdmEMWGI0cm0JJ2QpYA1RDvcmzJEWhABhD/pqrL0S0CWuABKgnRki9lLseS7g2AlqwHWQSKH4oKLrILpRGhEQCw2LiRUIa4lwAAAABJRU5ErkJggg==") !important;
        }

        #toast-container>.toast-warning {
            background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGYSURBVEhL5ZSvTsNQFMbXZGICMYGYmJhAQIJAICYQPAACiSDB8AiICQQJT4CqQEwgJvYASAQCiZiYmJhAIBATCARJy+9rTsldd8sKu1M0+dLb057v6/lbq/2rK0mS/TRNj9cWNAKPYIJII7gIxCcQ51cvqID+GIEX8ASG4B1bK5gIZFeQfoJdEXOfgX4QAQg7kH2A65yQ87lyxb27sggkAzAuFhbbg1K2kgCkB1bVwyIR9m2L7PRPIhDUIXgGtyKw575yz3lTNs6X4JXnjV+LKM/m3MydnTbtOKIjtz6VhCBq4vSm3ncdrD2lk0VgUXSVKjVDJXJzijW1RQdsU7F77He8u68koNZTz8Oz5yGa6J3H3lZ0xYgXBK2QymlWWA+RWnYhskLBv2vmE+hBMCtbA7KX5drWyRT/2JsqZ2IvfB9Y4bWDNMFbJRFmC9E74SoS0CqulwjkC0+5bpcV1CZ8NMej4pjy0U+doDQsGyo1hzVJttIjhQ7GnBtRFN1UarUlH8F3xict+HY07rEzoUGPlWcjRFRr4/gChZgc3ZL2d8oAAAAASUVORK5CYII=") !important;
        }

        #toast-container.toast-top-center>div,
        #toast-container.toast-bottom-center>div {
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        #toast-container.toast-top-full-width>div,
        #toast-container.toast-bottom-full-width>div {
            width: 96%;
            margin-left: auto;
            margin-right: auto;
        }

        .toast {
            background-color: #030303;
        }

        .toast-success {
            background-color: #51A351;
        }

        .toast-error {
            background-color: #BD362F;
        }

        .toast-info {
            background-color: #2F96B4;
        }

        .toast-warning {
            background-color: #F89406;
        }

        .toast-progress {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            background-color: #000000;
            opacity: 0.4;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=40);
            filter: alpha(opacity=40);
        }

        @media all and (max-width: 240px) {
            #toast-container>div {
                padding: 8px 8px 8px 50px;
                width: 11em;
            }

            #toast-container>div.rtl {
                padding: 8px 50px 8px 8px;
            }

            #toast-container .toast-close-button {
                right: -0.2em;
                top: -0.2em;
            }

            #toast-container .rtl .toast-close-button {
                left: -0.2em;
                right: 0.2em;
            }
        }

        @media all and (min-width: 241px) and (max-width: 480px) {
            #toast-container>div {
                padding: 8px 8px 8px 50px;
                width: 18em;
            }

            #toast-container>div.rtl {
                padding: 8px 50px 8px 8px;
            }

            #toast-container .toast-close-button {
                right: -0.2em;
                top: -0.2em;
            }

            #toast-container .rtl .toast-close-button {
                left: -0.2em;
                right: 0.2em;
            }
        }

        @media all and (min-width: 481px) and (max-width: 768px) {
            #toast-container>div {
                padding: 15px 15px 15px 50px;
                width: 25em;
            }

            #toast-container>div.rtl {
                padding: 15px 50px 15px 15px;
            }
        }

        button.select2-selection__choice__remove span {
            position: absolute;
            z-index: 0;
            left: -5px;
            top: -5px;
        }

        .attributeRepeaterContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .d-flex {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .form-inline-item {
            display: flex;
            flex-direction: column;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-inline-item label {
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .gap-2 {
            gap: 10px;
        }

        .mainAttributeSelectsec {
            width: 100% !important;
        }

        .mainAttributeSelectsec span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }

        .variationBlock .form-inline-item {
            width: 20%;
        }

        .variationBlock {
            margin-bottom: 40px;
            border: 1px solid #cacfe7;
            padding: 20px;
            border-radius: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            margin: 2px !important;
        }

        .variationBlock select.form-control.mx-2 {
            margin: 0 !important;
        }
    </style>

    @include('layouts.front.css')
    @yield('css')
    <style>
        .myaccount-tab-menu.nav a {
            display: block;
            padding: 20px;
            font-size: 16px;
            align-items: center;
            width: 100%;
            font-weight: bold;
            color: black;
            border-radius: 50px;
            margin-bottom: 20px
        }

        .myaccount-tab-menu.nav a i {
            padding-right: 10px;
        }

        .myaccount-tab-menu.nav .active,
        .myaccount-tab-menu.nav a:hover {
            background-color: #fed700;
            color: white;
        }

        .account-details-form label.required {
            width: 100%;
            font-weight: 500;
            font-size: 18px;
        }

        .account-details-form input {
            border-width: 1px;
            border-color: white;
            border-style: solid;
            padding-left: 15px;
            color: black;
            width: 100%;
            border-radius: 3px;
            background-color: rgb(255, 255, 255);
            height: 52px;
            padding-left: 15px;
            margin-bottom: 30px;
            color: #000000;
            font-size: 15px;
            border: 1px solid #000;
        }

        .account-details-form legend {
            font-family: CottonCandies;
            font-size: 50px;
        }

        .editable {
            position: relative;
        }

        .editable-wrapper {
            position: absolute;
            right: 0px;
            top: -50px;
        }

        .editable-wrapper a {
            background-color: #17a2b8;
            border-radius: 50px;
            width: 35px;
            height: 35px;
            display: inline-block;
            text-align: center;
            line-height: 35px;
            color: white;
            margin-left: 10px;
            font-size: 16px;
        }

        .editable-wrapper a.edit {
            background-color: #007bff;
        }

        section.banner {
            padding-top: 50px;
        }

        .menu-item-has-children a {
            border-bottom: 1px solid rgba(0, 0, 0, 0.242);
            padding: 9px 0 9px 8px !important;
        }

        .gymDiv img {
            width: 100% !important;
            height: 170px !important;
            margin: auto;
        }

        ul#menu-vertical-menu {
            opacity: 0;
            transition: all 1s ease;
        }

        li.nav-item.dropdown:hover .dropdown-menu {
            opacity: 1;
            transition: all 1s ease;
        }

        ul#menu-vertical-menu {
            opacity: 0;
            transition: all 1s ease;
        }

        .home-v2-slider .owl-nav {
            position: relative;
            z-index: 0;
        }

        .home-v2-slider .owl-nav .owl-prev i {
            position: absolute;
            z-index: 0;
            left: 30px;
            bottom: 350px;
            font-size: 40px;
            background: white;
            border-radius: 60%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .home-v2-slider .owl-nav .owl-next i {
            position: absolute;
            z-index: 0;
            right: 30px;
            bottom: 350px;
            font-size: 40px;
            background: white;
            border-radius: 60%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mian-browse-category-show {
            overflow-y: scroll;
            height: 475px;
        }


        .mian-browse-category-show li a {
            color: #333e48 !important;
            padding-left: 20px !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mian-browse-category-show li {
            margin-bottom: 5px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.min.css') }}">
</head>

<body class="responsive">


    @include('layouts/front.header')




    @yield('content')


    @include('layouts/front.footer')
    <!-- ============================================================== -->
    <!-- All SCRIPTS ANS JS LINKS IN BELOW FILE -->
    <!-- ============================================================== -->
    @include('layouts/front.scripts')

    @yield('js')
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    <script async>
        /*
         * Note that this is toastr v2.1.3, the "latest" version in url has no more maintenance,
         * please go to https://cdnjs.com/libraries/toastr.js and pick a certain version you want to use,
         * make sure you copy the url from the website since the url may change between versions.
         * */
        ! function(e) {
            e(["jquery"], function(e) {
                return function() {
                    function t(e, t, n) {
                        return g({
                            type: O.error,
                            iconClass: m().iconClasses.error,
                            message: e,
                            optionsOverride: n,
                            title: t
                        })
                    }

                    function n(t, n) {
                        return t || (t = m()), v = e("#" + t.containerId), v.length ? v : (n && (v = d(t)), v)
                    }

                    function o(e, t, n) {
                        return g({
                            type: O.info,
                            iconClass: m().iconClasses.info,
                            message: e,
                            optionsOverride: n,
                            title: t
                        })
                    }

                    function s(e) {
                        C = e
                    }

                    function i(e, t, n) {
                        return g({
                            type: O.success,
                            iconClass: m().iconClasses.success,
                            message: e,
                            optionsOverride: n,
                            title: t
                        })
                    }

                    function a(e, t, n) {
                        return g({
                            type: O.warning,
                            iconClass: m().iconClasses.warning,
                            message: e,
                            optionsOverride: n,
                            title: t
                        })
                    }

                    function r(e, t) {
                        var o = m();
                        v || n(o), u(e, o, t) || l(o)
                    }

                    function c(t) {
                        var o = m();
                        return v || n(o), t && 0 === e(":focus", t).length ? void h(t) : void(v.children()
                            .length && v.remove())
                    }

                    function l(t) {
                        for (var n = v.children(), o = n.length - 1; o >= 0; o--) u(e(n[o]), t)
                    }

                    function u(t, n, o) {
                        var s = !(!o || !o.force) && o.force;
                        return !(!t || !s && 0 !== e(":focus", t).length) && (t[n.hideMethod]({
                            duration: n.hideDuration,
                            easing: n.hideEasing,
                            complete: function() {
                                h(t)
                            }
                        }), !0)
                    }

                    function d(t) {
                        return v = e("<div/>").attr("id", t.containerId).addClass(t.positionClass), v.appendTo(
                            e(t.target)), v
                    }

                    function p() {
                        return {
                            tapToDismiss: !0,
                            toastClass: "toast",
                            containerId: "toast-container",
                            debug: !1,
                            showMethod: "fadeIn",
                            showDuration: 300,
                            showEasing: "swing",
                            onShown: void 0,
                            hideMethod: "fadeOut",
                            hideDuration: 1e3,
                            hideEasing: "swing",
                            onHidden: void 0,
                            closeMethod: !1,
                            closeDuration: !1,
                            closeEasing: !1,
                            closeOnHover: !0,
                            extendedTimeOut: 1e3,
                            iconClasses: {
                                error: "toast-error",
                                info: "toast-info",
                                success: "toast-success",
                                warning: "toast-warning"
                            },
                            iconClass: "toast-info",
                            positionClass: "toast-top-right",
                            timeOut: 5e3,
                            titleClass: "toast-title",
                            messageClass: "toast-message",
                            escapeHtml: !1,
                            target: "body",
                            closeHtml: '<button type="button">&times;</button>',
                            closeClass: "toast-close-button",
                            newestOnTop: !0,
                            preventDuplicates: !1,
                            progressBar: !1,
                            progressClass: "toast-progress",
                            rtl: !1
                        }
                    }

                    function f(e) {
                        C && C(e)
                    }

                    function g(t) {
                        function o(e) {
                            return null == e && (e = ""), e.replace(/&/g, "&amp;").replace(/"/g, "&quot;")
                                .replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
                        }

                        function s() {
                            c(), u(), d(), p(), g(), C(), l(), i()
                        }

                        function i() {
                            var e = "";
                            switch (t.iconClass) {
                                case "toast-success":
                                case "toast-info":
                                    e = "polite";
                                    break;
                                default:
                                    e = "assertive"
                            }
                            I.attr("aria-live", e)
                        }

                        function a() {
                            E.closeOnHover && I.hover(H, D), !E.onclick && E.tapToDismiss && I.click(b), E
                                .closeButton && j && j.click(function(e) {
                                    e.stopPropagation ? e.stopPropagation() : void 0 !== e.cancelBubble && e
                                        .cancelBubble !== !0 && (e.cancelBubble = !0), E.onCloseClick && E
                                        .onCloseClick(e), b(!0)
                                }), E.onclick && I.click(function(e) {
                                    E.onclick(e), b()
                                })
                        }

                        function r() {
                            I.hide(), I[E.showMethod]({
                                duration: E.showDuration,
                                easing: E.showEasing,
                                complete: E.onShown
                            }), E.timeOut > 0 && (k = setTimeout(b, E.timeOut), F.maxHideTime = parseFloat(E
                                    .timeOut), F.hideEta = (new Date).getTime() + F.maxHideTime, E
                                .progressBar && (F.intervalId = setInterval(x, 10)))
                        }

                        function c() {
                            t.iconClass && I.addClass(E.toastClass).addClass(y)
                        }

                        function l() {
                            E.newestOnTop ? v.prepend(I) : v.append(I)
                        }

                        function u() {
                            if (t.title) {
                                var e = t.title;
                                E.escapeHtml && (e = o(t.title)), M.append(e).addClass(E.titleClass), I.append(
                                    M)
                            }
                        }

                        function d() {
                            if (t.message) {
                                var e = t.message;
                                E.escapeHtml && (e = o(t.message)), B.append(e).addClass(E.messageClass), I
                                    .append(B)
                            }
                        }

                        function p() {
                            E.closeButton && (j.addClass(E.closeClass).attr("role", "button"), I.prepend(j))
                        }

                        function g() {
                            E.progressBar && (q.addClass(E.progressClass), I.prepend(q))
                        }

                        function C() {
                            E.rtl && I.addClass("rtl")
                        }

                        function O(e, t) {
                            if (e.preventDuplicates) {
                                if (t.message === w) return !0;
                                w = t.message
                            }
                            return !1
                        }

                        function b(t) {
                            var n = t && E.closeMethod !== !1 ? E.closeMethod : E.hideMethod,
                                o = t && E.closeDuration !== !1 ? E.closeDuration : E.hideDuration,
                                s = t && E.closeEasing !== !1 ? E.closeEasing : E.hideEasing;
                            if (!e(":focus", I).length || t) return clearTimeout(F.intervalId), I[n]({
                                duration: o,
                                easing: s,
                                complete: function() {
                                    h(I), clearTimeout(k), E.onHidden && "hidden" !== P.state &&
                                        E.onHidden(), P.state = "hidden", P.endTime = new Date,
                                        f(P)
                                }
                            })
                        }

                        function D() {
                            (E.timeOut > 0 || E.extendedTimeOut > 0) && (k = setTimeout(b, E.extendedTimeOut), F
                                .maxHideTime = parseFloat(E.extendedTimeOut), F.hideEta = (new Date).getTime() +
                                F.maxHideTime)
                        }

                        function H() {
                            clearTimeout(k), F.hideEta = 0, I.stop(!0, !0)[E.showMethod]({
                                duration: E.showDuration,
                                easing: E.showEasing
                            })
                        }

                        function x() {
                            var e = (F.hideEta - (new Date).getTime()) / F.maxHideTime * 100;
                            q.width(e + "%")
                        }
                        var E = m(),
                            y = t.iconClass || E.iconClass;
                        if ("undefined" != typeof t.optionsOverride && (E = e.extend(E, t.optionsOverride), y =
                                t.optionsOverride.iconClass || y), !O(E, t)) {
                            T++, v = n(E, !0);
                            var k = null,
                                I = e("<div/>"),
                                M = e("<div/>"),
                                B = e("<div/>"),
                                q = e("<div/>"),
                                j = e(E.closeHtml),
                                F = {
                                    intervalId: null,
                                    hideEta: null,
                                    maxHideTime: null
                                },
                                P = {
                                    toastId: T,
                                    state: "visible",
                                    startTime: new Date,
                                    options: E,
                                    map: t
                                };
                            return s(), r(), a(), f(P), E.debug && console && console.log(P), I
                        }
                    }

                    function m() {
                        return e.extend({}, p(), b.options)
                    }

                    function h(e) {
                        v || (v = n()), e.is(":visible") || (e.remove(), e = null, 0 === v.children().length &&
                            (v.remove(), w = void 0))
                    }
                    var v, C, w, T = 0,
                        O = {
                            error: "error",
                            info: "info",
                            success: "success",
                            warning: "warning"
                        },
                        b = {
                            clear: r,
                            remove: c,
                            error: t,
                            getContainer: n,
                            info: o,
                            options: {},
                            subscribe: s,
                            success: i,
                            version: "2.1.3",
                            warning: a
                        };
                    return b
                }()
            })
        }("function" == typeof define && define.amd ? define : function(e, t) {
            "undefined" != typeof module && module.exports ? module.exports = t(require("jquery")) : window.toastr = t(
                window.jQuery)
        });
        //# sourceMappingURL=toastr.js.map
    </script>

    <!--lazy load  -->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@12.0.0/dist/lazyload.min.js"></script>

    <script>
        $(function() {
            var myLazyLoad = new LazyLoad({
                elements_selector: ".lazy"
            });
        });
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KHH9ZPZF');
    </script>
    <!-- End Google Tag Manager -->

</body>

</html>
