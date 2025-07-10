@extends('layouts.main')
@section('title', 'Order')
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
                                    <h1>Products</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <main class="my-cart">

        <!-- my account wrapper start -->
        <div class="my-account-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                @include('account.sidebar')
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane show active" id="orders" role="#">
                                            <div class="myaccount-content">
                                                <div class="section-heading">
                                                    <a href="{{ route('addnewproduct') }}" class="add-new donate-btn">Add
                                                        New Product</a>
                                                </div>

                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product Title</th>
                                                                <th>Image</th>
                                                                <th>Price</th>

                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            @if ($products)
                                                                @php
                                                                    $count = 1;
                                                                @endphp
                                                                @foreach ($vendor_pro as $pros)
                                                                    @php
                                                                        $product = App\Product::where(
                                                                            'id',
                                                                            $pros->product_id,
                                                                        )->first();
                                                                    @endphp

                                                                    <tr>
                                                                        <td>{{ $count }}</td>

                                                                        <td>{{ $product->product_title }}</td>
                                                                        <td><img src="{{ asset($product->image) }}"> </td>
                                                                        <td>${{ $pros->price }}</td>

                                                                        <td class="viewbtn"><button class="btn-seller"
                                                                                type="button" data-toggle="modal"
                                                                                data-target="#exampleModalCenter-{{ $pros->id }}">Edit</button>
                                                                        </td>

                                                                    </tr>
                                                                    @php
                                                                        $count++;
                                                                    @endphp
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
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
    <!-- Modal -->
    @foreach ($vendor_pro as $pros)
        <div class="modal fade" id="exampleModalCenter-{{ $pros->id }}" tabindex="-1" role="dialog"
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
                        <form action="{{ route('sell-on-epd-edit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $pros->product_id }}" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                            <div class="form-group">
                                <label for="">Stock Quantity</label>
                                <input type="text" class="form-control" name="stock_inventory"
                                    value="{{ $pros->stock_inventory }}">
                            </div>
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control" name="price" value="{{ $pros->price }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('css')
    <style type="text/css">
        .myaccount-table.table-responsive.text-center {
            margin-top: 30px;
        }

        a.add-new.donate-btn {
            float: right;
            color: white;
            padding: 7px;
            margin-bottom: 15px;
            background: #fed700;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }

        a.add-new.donate-btn:hover {
            color: #fff;
            background: #000;
        }

        td img {
            width: 150px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', ".btn1", function(e) {
            // alert('it works');
            $('.loginForm').submit();
        });
    </script>
@endsection
