<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin">
        <meta name="author" content="Admin">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset(!empty($favicon->img_path)?$favicon->img_path:'')}}">
        <title>{{ config('app.name') }}</title>
        <!-- ============================================================== -->
        <!-- All CSS LINKS IN BELOW FILE -->
        <!-- ============================================================== -->
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

            /* .myaccount-tab-menu.nav {
                border: 1px solid;
                border-radius:10px;
            } */

            .myaccount-tab-menu.nav .active, .myaccount-tab-menu.nav a:hover {
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
            .editable-wrapper a.edit{
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
/*
            ul#menu-vertical-menu {
                display: none !important;
            } */
        </style>
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

    </body>
</html>
