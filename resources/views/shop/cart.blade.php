@extends('layouts.main')
@section('title', 'Cart')
@section('css')
    <style type="text/css">
        a.checkout_css {
            color: #fff;
            -moz-border-radius: 3px;
            border-radius: 3px;
            text-transform: uppercase;
            background: #FDEE20;
            font-family: 'Oswald', sans-serif;
        }

        .cart-table img {
            width: 100%;
        }

        .cart-table td {
            vertical-align: middle;
        }

        .cart-table h5 {
            font-size: 18px;
            line-height: 30px;
            margin-bottom: 0px;
        }

        .cart-table h4 {
            margin-bottom: 0px;
            font-size: 20px;
        }

        /* .cart-table tbody td:first-child {
            width: 50%;
        } */
        .row {
            align-items: center;
        }

        .cart-table tbody td i {
            color: #000000;
        }

        .table-bordered thead th {
            background-color: white;
            color: black;
        }

        a.shopping {
            color: white;
            font-size: 18px;
        }

        input.qtystyle {
            text-align: center;
        }

        .check-out-detail {
            background-color: #f2f2f2;
            color: #000;
            padding: 25px;
            padding-bottom: 2px;
            border-radius: 3px;
        }

        a.updateCart.btn.btnDonate {
            background: #fdee20;
            color: #000;
        }

        input.qtystyle {
            padding: 5px 0;
        }

        section.cartsec {
            padding: 50px 0;
        }

        a.updateCart.btn.btnDonate {
            background: #fdee20;
            color: #000;
            padding: 10px 20px;
            font-size: 20px;
        }

        .check-out-detail.card {
            padding: 50px 30px;
            border-radius: 25px;
        }

        td.p_name {
            width: 40%;
        }

        td.p-quantity {
            width: 25%;
        }

        input.count {
            border: 1px solid #000 !important;
            padding: 10px 10px;
            border-radius: inherit;
        }

        .cartcount {
            background: #000;
            color: #fff;
            padding: 10px 15px;
        }

    </style>
@endsection
@section('content')
<section class="about1 pl-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-hea">
                    {{-- <h2>CART</h2> --}}
                </div>
            </div>
        </div>
    </div>
</section>




    <section class="cartsec">
        <div class="container">
            <form method="post" action="{{ route('update_cart') }}" id="update-cart">
                {{ csrf_field() }}
                <input type="hidden" name="type" id="type" value="">
                <?php $subtotal = 0;
                $addon_total = 0;
                $total_variation = 0; ?>
                <div class="row row pb-5 pt-5">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive cart-table">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Item</th>
                                        <th class="">Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Sub Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($cart as $key => $value)
                                        @php
                                            $count = $count + 1;
                                        @endphp
                                        <?php
                                        if ($key == 'shipping') {
                                            //continue;
                                        }
                                        $prod_image = App\Product::where('id', $value['id'])->first();
                                        ?>
                                        <tr>
                                            <td>

                                                <a href="javascript:void(0)"
                                                    onclick="window.location.href='{{ route('remove_cart', [$value['id']]) }}'"
                                                    class="remove"><i class="fas fa-xmark"></i></a>
                                            </td>
                                            <td class="p_name">
                                                <div class="row">
                                                    <div class="col-md-3 no-margin">
                                                        <img src="{{ asset($prod_image->image) }}" alt=""
                                                            class="img-responsive">
                                                    </div>
                                                    <div class="col-md-9">

                                                        <h5>{{ $value['name'] }}</h5>
                                                        @foreach ($value['variation'] as $key => $values)
                                                            <p class="m-0">{{ $values['attribute'] }} -
                                                                {{ $values['attribute_val'] }} -
                                                                {{ $values['attribute_price'] }}</p>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center p-quantity">
                                                <div class="qty center">
                                                    <span id={{ $count }} class="minus bg-dark cartcount"
                                                        onclick="change(this.id,'-')">-</span>
                                                    <input id="{{ 'counter ' . $count }}" type="number"
                                                        class="count cartinput qtystyle" name="row[]"
                                                        value="{{ $value['qty'] }}">
                                                    <span id={{ $count }} class=" plus bg-dark cartcount"
                                                        onclick="change(this.id,'+')">+</span>
                                                </div>
                                            </td>
                                            <td class="p_sub">
                                                <h4>${!! $value['baseprice'] !!}</h4>
                                            </td>
                                            <td class="p_total">
                                                <h4>${!!$value['baseprice'] * $value['qty'] + $value['variation_price'] !!}
                                                </h4>
                                            </td>

                                        </tr>
                                        <input type="hidden" name="product_id" id="" value="<?php echo $value['id']; ?>">
                                        <?php $subtotal += $value['baseprice'] * $value['qty'];
                                        $total_variation += $value['variation_price']; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="checkoutsec">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="shopping"><i class="fa fa-angle-left"></i>
                                        Continue Shopping</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="javascript:void(0)" class="updateCart btn btnDonate">Proceed to Checkout</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-5">
                        <div class="check-out-detail card">

                            <h2>Sub Total: <span>${!! $subtotal !!}</span></h2>
                            <hr>
                            <h2 class="price">Total: <span
                                    class="price">${!! $subtotal + $total_variation !!} </span></h2>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('js')

    <script type="text/javascript">
        $(document).on('click', ".updateCart", function(e) {

            $('#type').val($(this).attr('data-attr'));
            $('#update-cart').submit();

        });

        $(document).on('keydown keyup', ".qtystyle", function(e) {
            if ($(this).val() <= 1) {
                e.preventDefault();
                $(this).val(1);
            }

        });
    </script>

    <script>
        function validate(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        $(document).on('click', ".addCoupon", function(e) {
            $('#addCoupon').submit();
        });


        $('input.qtystyle').on('input', function(e) {
            // alert('Changed!')
            // alert($(this).val());
            // alert($(this).attr('data-attr-stock'));

            if (parseInt($(this).val()) > parseInt($(this).attr('data-attr-stock'))) {
                $(this).val(parseInt($(this).attr('data-attr-stock')));
                generateNotification('danger', 'please select only available ' + parseInt($(this).attr(
                    'data-attr-stock')) + ' items in stock');
            }

        });
        // $(document).ready(function(IDofObject) {
        //     $(document).on('click', '.plus', function() {
        //         console.log(IDofObject);
        //         $('.count').val(parseInt($('.count').val()) + 1);
        //     });
        //     $(document).on('click', '.minus', function() {
        //         $('.count').val(parseInt($('.count').val()) - 1);
        //         if ($('.count').val() == 0) {
        //             $('.count').val(1);
        //         }
        //     });
        // });

        function change(IDofObject, sign) {
            if (sign == "+") {


                document.getElementById(('counter '.concat((IDofObject).toString()))).value = parseInt(document
                    .getElementById((
                        'counter '
                        .concat(
                            IDofObject.toString()))).value) + 1
            } else {
                if (parseInt(document
                        .getElementById((
                            'counter '
                            .concat(
                                IDofObject.toString()))).value) > 1) {

                    console.log(document.getElementById(('counter '.concat((IDofObject).toString()))).value)

                    document.getElementById(('counter '.concat((IDofObject).toString()))).value = parseInt(document
                        .getElementById((
                            'counter '
                            .concat(
                                IDofObject.toString()))).value) - 1
                }
            }
        }
    </script>

    <script>
        function myFunction() {
            alert("Please Calculate Shipping First!");
        }
    </script>

@endsection
