@extends('layouts.main')
@section('title', 'Account')
@section('css')
<style>
    .card-body {
        padding: 10px;
    }
</style>
@endsection
@section('content')

<?php $segment = Request::segments(); ?>

<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-wrapper inner-banner-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="section-heading text-center">
                                <h1>Account</h1>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@php

$subtotal = 0;

foreach($seller_order_products as $sell){

    $profit_margin = 40;
    $shipping_fee = 25;
    $stripe_fee = 1.5;
    $supplier_fee = 5;
    $advertisment = 3;
    
    $margin_final = (($profit_margin / 100) * $sell->order_products_subtotal);
    
    $shipping_final = (($shipping_fee / 100) * $margin_final);
    $stripe_final = (($stripe_fee / 100) * $margin_final);
    $supplier_final = (($supplier_fee / 100) * $margin_final);
    $advertisment_final = (($advertisment / 100) * $margin_final);
    
    $final = $margin_final - $shipping_final - $supplier_final - $advertisment_final;
   

    $subtotal += $final;
}


$total_sales += $subtotal

@endphp



<main class="my-cart">
    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            @include('account.sidebar')
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane show active" id="dashboad">
                                        <div class="myaccount-content">
                                            <div class="row white-text">

                                                <!-- Grid column -->
                                                <div class="col-xl-6 col-md-6 mb-4">

                                                  <!-- Card Primary -->
                                                  <div class="card classic-admin-card primary-color">
                                                    <div class="card-body py-3">
                                                      <i class="far fa-money-bill-alt"></i>
                                                      <p class="small">SALES</p>
                                                      
                                                      <h4>${{ $total_sales }}</h4>
                                                    </div>


                                                  </div>
                                                  <!-- Card Primary -->

                                                </div>
                                                <!-- Grid column -->

                                                <!-- Grid column -->
                                                <div class="col-xl-6 col-md-6 mb-4">

                                                  <!-- Card Yellow -->
                                                  <div class="card classic-admin-card warning-color">
                                                    <div class="card-body py-3">
                                                      <i class="fas fa-chart-line"></i>
                                                      <p class="small">ORDERS</p>
                                                      <h4>{{ count($seller_order) }}</h4>
                                                    </div>


                                                  </div>
                                                  <!-- Card Yellow -->

                                                </div>
                                                <!-- Grid column -->





                                              </div>
                                            <div class="section-heading">
                                                <h2>Dashboard</h2>
    
                                                <div class="welcome">
                                                
                                                    <p>Hello, <strong>{{ Auth::user()->name }}</strong> (If Not <strong>{{ Auth::user()->name }} !</strong><a href="{{ url('logout') }}" class="logout"> Logout</a>)</p>
                                                </div>
        
                                                <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
    
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


<!-- main content end -->   
</main>

@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click', ".btn1", function(e){
            // alert('it works');
            $('.loginForm').submit();
     });
</script>
@endsection