@extends('layouts.main')
@section('title', 'Checkout')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .payment-accordion img {
            display: inline-block;
            margin-left: 10px;
            background-color: white;
        }

        form#order-place .form-control {
            border-width: 1px;
            border-color: rgb(150, 163, 218);
            border-style: solid;
            border-radius: 8px;
            background-color: transparent;
            height: 54px;
            padding-left: 15px;
            color: black;
        }

        form#order-place textarea.form-control {
            height: auto !important;
        }

        .checkoutPage {
            padding: 50px 0px;
        }

        .checkoutPage .section-heading h3 {
            margin-bottom: 30px;
        }

        .YouOrder {
            background-color: #333e48;
            color: white;
            padding: 25px;
            padding-bottom: 2px;
            min-height: 300px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .amount-wrapper {
            padding-top: 12px;
            border-top: 2px solid white;
            text-align: left;
            margin-top: 90px;
        }

        .amount-wrapper h2 {
            font-size: 20px;
            display: flex;
            justify-content: space-between;
        }

        .amount-wrapper h3 {
            display: FLEX;
            justify-content: SPACE-BETWEEN;
            font-size: 22px;
            border-top: 2px solid white;
            padding-top: 10px;
            margin-top: 14px;
        }

        .checkoutPage span.invalid-feedback strong {
            color: #333e48;
            /* background-color: #f8d7da;
                                                                                            border-color: #f5c6cb; */
            display: block;
            width: 100%;
            font-size: 15px;
            padding: 5px 15px;
            border-radius: 6px;
        }

        .payment-accordion .btn-link {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px 19px;
            color: black;
        }

        .payment-accordion .card-header {
            padding: 0px !important;
        }

        .payment-accordion .card-header:first-child {
            border-radius: 0px;
        }

        .payment-accordion .card {
            border-radius: 0px;
        }

        .form-group.hide {
            display: none;
        }

        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            border-width: 1px;
            border-color: rgb(150, 163, 218);
            border-style: solid;
            margin-bottom: 10px;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #333e48;
        }

        .StripeElement--invalid {
            border-color: #333e48;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        div#card-errors {
            color: #333e48;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            display: block;
            width: 100%;

            font-size: 15px;
            padding: 5px 15px;
            border-radius: 6px;
            display: none;
            margin-bottom: 10px;
        }

        .btn:hover,
        .hero-action-btn:hover,
        .button:hover,
        button:hover,
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover {
            color: #fff !important;
            background-color: black;
            border-color: black;
        }

        .card-header h5.mb-0 {
            padding: 20px 5px;
        }

        span.paypal-button-text {
            display: none;
        }
    </style>
@endsection
@section('content')

    <section class="form-body checkoutPage">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
                    <div class="section-heading dark-color">
                        <h3>Billing Address</h3>
                    </div>
                    @if (\Session::has('stripe_error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('stripe_error') !!}
                        </div>
                    @endif
                    <form action="{{ route('order.place') }}" method="POST" id="order-place">
                        @csrf
                        <input type="hidden" name="payment_id" value="" />
                        <input type="hidden" name="payer_id" value="" />
                        <input type="hidden" name="payment_status" value="" />
                        <input type="hidden" name="payment_method" id="payment_method" value="paypal" />
                        @if (Auth::check())
                            <?php $_getUser = DB::table('users')
                                ->where('id', '=', Auth::user()->id)
                                ->first(); ?>
                            <div class="form-group">
                                <input class="form-control" id="f-name" name="first_name"
                                    value="{{ old('first_name') ? old('first_name') : $_getUser->name }}"
                                    placeholder="First Name *" type="text" required>
                                <span class="invalid-feedback fname {{ $errors->first('first_name') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address_input" name="address_line_1"
                                    placeholder="Type any address" required>
                            </div>


                            <!-- hidden fields (backend + shipping logic ke liye) -->
                            <input type="hidden" id="hidden_address">
                            <input type="hidden" id="hidden_city">
                            <input type="hidden" id="hidden_state">
                            <input type="hidden" id="hidden_postal">
                            <input type="hidden" id="hidden_fedex_token" value="">
                            <input type="hidden" id="hidden_country" value="US">
                            <div class="form-group">
                                <input class="form-control right" placeholder="Town / City *" name="city" id="city"
                                    type="text" required>
                                <span class="invalid-feedback {{ $errors->first('city') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="country" id="country" class="form-control left"
                                    placeholder="Country">
                                <span class="invalid-feedback {{ $errors->first('country') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="form-control right" placeholder="Phone *" name="phone_no" type="text"
                                    value="{{ old('phone_no') }}" required>
                                <span class="invalid-feedback {{ $errors->first('phone_no') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('phone_no') }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <input class="form-control left" name="email" placeholder="Email *" type="email"
                                    value="{{ old('email') ? old('email') : $_getUser->email }}" required>
                                <span class="invalid-feedback {{ $errors->first('email') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                            <div class="form-group" id="shipping-placeholder">
                                <strong>Type address to see shipping options</strong>
                            </div>

                            <div id="shipping-methods-wrapper" style="display:none;">
                                <h5>Shipping Options</h5>
                                <div id="shipping-methods-container"></div>
                            </div>

                            <input type="hidden" name="shipping_amount" id="shipping">
                            <input type="hidden" id="total_price">


                            <div class="form-group">
                                <input class="form-control" id="zip_code" name="zip_code" placeholder="Postcode"
                                    type="text" value="{{ old('zip_code') }}">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" id="comment" name="order_notes" placeholder="Order Note" rows="5">{{ old('order_notes') }}</textarea>
                            </div>
                        @else
                            <a href="{{ url('signin') }}" target="_blank" class="runningBtn">Returning customer? Click
                                here to login</a>
                            <div class="form-group">
                                <span class="invalid-feedback fname">
                                    <strong>{{ $errors->first('first_name') }}</strong></span>
                                <input class="form-control right" id="f-name" name="first_name"
                                    value="{{ old('first_name') }}" placeholder="First Name" type="text">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback lname">
                                    <strong>{{ $errors->first('last_name') }}</strong></span>
                                <input class="form-control left" placeholder="Last Name" name="last_name" id="l-name"
                                    type="text" value="{{ old('last_name') }}">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address_line_1') }}</strong></span>
                                <input class="form-control" id="address" name="address_line_1" placeholder="Address"
                                    type="text" value="{{ old('address_line_1') }}">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong></span>
                                <input class="form-control right" placeholder="Town / City" name="city"
                                    id="city" type="text">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('country') }}</strong></span>
                                <input type="text" name="country" id="country" class="form-control left"
                                    placeholder="Country">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_no') }}</strong></span>
                                <input class="form-control right" placeholder="Phone" name="phone_no" type="text"
                                    value="{{ old('phone_no') }}">
                            </div>
                            <div class="form-group">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong></span>
                                <input class="form-control left" name="email" placeholder="Email" type="email"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="compnayName" name="zip_code" placeholder="Postcode"
                                    type="text" value="{{ old('zip_code') }}">
                            </div>
                            @if (!Auth::check())
                                <div class="form-group"><label class="chkbox">
                                        <input type="checkbox" name="create_account" id="create_account"
                                            {{ !empty(old('create_account')) ? 'checked' : '' }}>
                                        Create An Account?</label>

                                </div>

                                <div class="form-group">

                                    <input type="password" class="form-control left" name="password"
                                        placeholder="Password">

                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong></span>
                                </div>
                                <div class="form-group">

                                    <input type="password" class="form-control right" name="confirm_password"
                                        placeholder="Confirm Password">
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('confirm_password') }}</strong></span>

                                </div>
                            @endif
                            <div class="form-group">
                                <textarea class="form-control" id="comment" name="order_notes" placeholder="Order Note" rows="5"></textarea>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">
                    <div class="section-heading dark-color">
                        <h3>YOUR ORDER</h3>
                    </div>
                    <div class="YouOrder">
                        <?php $subtotal = 0;
                        $addon_total = 0;
                        $variation = 0; ?>
                        @foreach ($cart as $key => $value)
                            <h5>{{ $value['name'] }} x {{ $value['qty'] }}
                                <span>${{ number_format($value['baseprice'] * $value['qty'], 2) }}</span>
                            </h5>
                            <?php $subtotal += $value['baseprice'] * $value['qty'];
                            $variation += $value['variation_price'];
                            ?>
                        @endforeach
                        <div class="amount-wrapper">
                            <h2>Item Subtotal <span>${{ number_format($subtotal, 2) }}</span></h2>
                            <h2>Shipping & Handling <span>Free</span></h2>
                            {{--                            <h2> Variation <span>{{ $variation }}</span></h2> --}}
                            {{--                            <h2> Coupon Discount <span class="span_coupon_discount">0.00</span></h2> --}}
                            {{--                            <h3> Total Price <span class="span_total">${{ $subtotal +  $variation }}</span></h3> --}}
                            {{--                            <h2> Total Before Sales Tax <span>${{ $subtotal }}</span></h2> --}}
                            @php
                                //$tax = ($subtotal * 0.05) + 12.78;
                                $tax = 0.0;
                            @endphp
                            {{--                            <h2> Estimated Sales Tax <span>${{ $tax }}</span></h2> --}}
                            <h3> Order Total Amount <span
                                    class="span_total">${{ number_format($subtotal + $tax, 2) }}</span></h3>
                        </div>
                        {{--                        <div class="amount-wrapper"> --}}
                        {{--                            <input type="text" class="text_coupon" style="background: white;" placeholder="Enter coupon code"> --}}
                        {{--                            <button class="btn btn-link btn_apply_coupon">Apply coupon</button> --}}
                        {{--                        </div> --}}
                    </div>
                    <div id="accordion" class="payment-accordion">
                        {{-- <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne" data-payment="paypal">
                                        Pay with Paypal <img src="{{ asset('images/paypal.png') }}" width="60" alt="">
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <input type="hidden" name="price" value="{{ $subtotal + $tax }}"/>
                                    <input type="hidden" name="product_id" value=""/>
                                    <input type="hidden" name="qty" value="value['qty']"/>
                                    <div id="paypal-button-container-popup"></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <input type="hidden" name="price" value="{{ $subtotal + $tax }}" />
                            <div id="paypal-button-container-popup"></div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"
                                        data-payment="stripe">
                                        Pay with Credit Card <img src="{{ asset('images/payment1.png') }}" alt=""
                                            width="150">
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <div class="stripe-form-wrapper require-validation"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" data-cc-on-file="false">
                                        <div id="card-element"></div>
                                        <div id="card-errors" role="alert"></div>
                                        <div class="form-group">
                                            {{--                                            <button class="btn btn-red btn-block" type="button" id="stripe-submit">Pay Now ${{ $subtotal }}</button> --}}
                                            <button class="btn btn-red btn-block" type="button" id="stripe-submit">Pay
                                                Now ${{ number_format($subtotal + $tax, 2) }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <button type="submit" class="hvr-wobble-skew" style="display:none">place order</button>
                    <!--   <a class="PaymentMethod-a" id="paypal-button-container-popup" href="#" style="display:none"></a> -->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js?disable-funding=credit"></script>
    <script src="https://js.stripe.com/v3/"></script>
    {{-- <script>
        $(document).ready(function() {

            // 1️⃣ Payment method toggle
            $('#accordion .btn-link').on('click', function(e) {
                if (!$(this).hasClass('collapsed')) {
                    e.stopPropagation();
                }
                $('#payment_method').val($(this).attr('data-payment'));
            });

            // 2️⃣ Required fields check
            function checkEmptyFields() {
                var errorCount = 0;
                $('form#order-place').find('.form-control').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).parent().find('.invalid-feedback').addClass('d-block');
                        $(this).parent().find('.invalid-feedback strong').html('Field is Required');
                        errorCount = 1;
                    }
                });
                return errorCount;
            }

            // 3️⃣ Custom toast function (to avoid PayPal iframe issue)
            function showToast(message, type = 'error') {
                if (typeof $.toast === 'function') {
                    $.toast({
                        heading: type === 'error' ? 'Alert!' : 'Success!',
                        position: 'bottom-right',
                        text: message,
                        loaderBg: '#ff6849',
                        icon: type,
                        hideAfter: 5000,
                        stack: 6
                    });
                } else {
                    alert(message); // fallback
                }
            }

            // 4️⃣ PayPal button
            const renderPaypalButton = (amount = {{ number_format((float) $subtotal + $tax, 2, '.', '') }}) => {
                paypal.Button.render({
                    env: 'sandbox', // production
                    style: {
                        label: 'checkout',
                        size: 'responsive',
                        shape: 'rect',
                        color: 'gold',
                        tagline: false
                    },
                    client: {
                        sandbox: 'AV06KMdIerC8pd6_i1gQQlyVoIwV8e_1UZaJKj9-aELaeNXIGMbdR32kDDEWS4gRsAis6SRpUVYC9Jmf'
                    },
                    validate: function(actions) {
                        actions.disable();
                        paypalActions = actions;
                    },
                    onClick: function(e) {
                        var errorCount = checkEmptyFields();
                        if (errorCount == 1) {
                            showToast('Please fill the required fields before proceeding to pay',
                                'error');
                            paypalActions.disable();
                        } else {
                            paypalActions.enable();
                        }
                    },
                    payment: function(data, actions) {
                        return actions.payment.create({
                            payment: {
                                transactions: [{
                                    amount: {
                                        total: amount,
                                        currency: 'USD'
                                    }
                                }]
                            }
                        });
                    },
                    onAuthorize: function(data, actions) {
                        return actions.payment.execute().then(function() {
                            showToast('Payment Authorized', 'success');
                            $('input[name="payment_status"]').val('Completed');
                            $('input[name="payment_id"]').val(data.paymentID);
                            $('input[name="payer_id"]').val(data.payerID);
                            $('input[name="payment_method"]').val('paypal');
                            $('#order-place').submit();
                        });
                    },
                    onCancel: function(data, actions) {
                        $('input[name="payment_status"]').val('Failed');
                        $('input[name="payment_id"]').val(data.paymentID);
                        $('input[name="payer_id"]').val('');
                        $('input[name="payment_method"]').val('paypal');
                    }
                }, '#paypal-button-container-popup');
            }
            renderPaypalButton();

            // 5️⃣ Stripe payment
            var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };
            var card = elements.create('card', {
                style: style
            });
            card.mount('#card-element');

            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    $(displayError).show();
                    displayError.textContent = event.error.message;
                } else {
                    $(displayError).hide();
                    displayError.textContent = '';
                }
            });

            $('#stripe-submit').click(function() {
                stripe.createToken(card).then(function(result) {
                    var errorCount = checkEmptyFields();
                    if (result.error || errorCount == 1) {
                        if (result.error) {
                            var errorElement = document.getElementById('card-errors');
                            $(errorElement).show();
                            errorElement.textContent = result.error.message;
                        } else {
                            showToast('Please fill the required fields before proceeding to pay',
                                'error');
                        }
                    } else {
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                var form = document.getElementById('order-place');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }

            // 6️⃣ Shipping logic
            function fetchShipping() {
                let address = $('#address_input').val().trim();
                let city = $('#city').val().trim();
                let postal = $('#zip_code').val().trim();
                let country = $('#country').val() || 'US';
                let token = $('#hidden_fedex_token').val();

                if (address.length < 5 || city.length < 2 || postal.length < 4 || !token) return;

                $('#shipping-methods-container').html('Loading shipping...');
                $('#shipping-methods-wrapper').show();

                $.ajax({
                    url: "{{ route('fedex.shipping') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        address,
                        city,
                        postal,
                        country,
                        token
                    },
                    success: function(res) {
                        $('#shipping-methods-container').html('');
                        if (!res.status || !res.methods || !res.methods.output) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }

                        let quotes = res.methods.output.rateReplyDetails || [];
                        if (quotes.length === 0) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }

                        quotes.forEach(function(q) {
                            let serviceName = q.serviceType;
                            let amount = q.ratedShipmentDetails[0].totalNetCharge.amount || 0;
                            $('#shipping-methods-container').append(`
                        <div>
                            <label>
                                <input type="radio" name="shipping" data-amount="${amount}">
                                ${serviceName} - $${amount}
                            </label>
                        </div>
                    `);
                        });
                    },
                    error: function(err) {
                        console.error("FedEx error: ", err.responseJSON || err);
                        $('#shipping-methods-container').html('FedEx error');
                    }
                });
            }

            // Address / city / ZIP typing
            let typingTimer;
            let doneTypingInterval = 800;
            $('#address_input, #city, #zip_code').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(fetchShipping, doneTypingInterval);
            });

            // Fetch FedEx token when address input changes
            $('#address_input').on('input', function() {
                let address = $(this).val().trim();
                if (address.length < 3) return;

                $.ajax({
                    url: "{{ route('fedex.token') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.access_token) {
                            $('#hidden_fedex_token').val(res.access_token);
                            fetchShipping(); // fetch shipping after token
                            console.log("FedEx Token:", res.access_token);
                        } else {
                            console.error("No token returned from FedEx");
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching FedEx token", err);
                    }
                });
            });

            // Update total on shipping selection
            $(document).on('change', 'input[name="shipping"]', function() {
                let amount = parseFloat($(this).data('amount')) || 0;
                $('#shipping').val(amount);

                let subtotal = parseFloat("{{ $subtotal ?? 0 }}");
                let tax = parseFloat("{{ $tax ?? 0 }}");
                let total = (subtotal + tax + amount).toFixed(2);

                $('#total_price').val(total);
                $('.span_total').text('$' + total);
                $('#stripe-submit').text('Pay Now $' + total);
            });

        });
    </script> --}}


    <script>
        function renderPaypalButton(amount = {{ number_format((float) $subtotal + $tax, 2, '.', '') }}) {

            function showToast(message, type = 'error') {
                if (typeof $.toast === 'function') {
                    $.toast({
                        heading: type === 'error' ? 'Alert!' : 'Success!',
                        position: 'bottom-right',
                        text: message,
                        loaderBg: '#ff6849',
                        icon: type,
                        hideAfter: 5000,
                        stack: 6
                    });
                } else {
                    alert(message); // fallback
                }
            }

            function checkEmptyFields() {
                var errorCount = 0;
                $('form#order-place').find('.form-control').each(function() {
                    if ($(this).prop('required') && !$(this).val()) {
                        $(this).parent().find('.invalid-feedback').addClass('d-block');
                        $(this).parent().find('.invalid-feedback strong').html('Field is Required');
                        errorCount = 1;
                    }
                });
                return errorCount;
            }

            paypal.Button.render({
                env: 'sandbox', // production
                style: {
                    label: 'checkout',
                    size: 'responsive',
                    shape: 'rect',
                    color: 'gold',
                    tagline: false
                },
                client: {
                    sandbox: 'AV06KMdIerC8pd6_i1gQQlyVoIwV8e_1UZaJKj9-aELaeNXIGMbdR32kDDEWS4gRsAis6SRpUVYC9Jmf'
                },
                validate: function(actions) {
                    actions.disable();
                    paypalActions = actions;
                },
                onClick: function() {
                    if (checkEmptyFields() === 1) {
                        showToast('Please fill the required fields before proceeding to pay', 'error');
                        paypalActions.disable();
                    } else {
                        paypalActions.enable();
                    }
                },
                payment: function(data, actions) {
                    return actions.payment.create({
                        payment: {
                            transactions: [{
                                amount: {
                                    total: amount,
                                    currency: 'USD'
                                }
                            }]
                        }
                    });
                },
                onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                        showToast('Payment Authorized', 'success');
                        $('input[name="payment_status"]').val('Completed');
                        $('input[name="payment_id"]').val(data.paymentID);
                        $('input[name="payer_id"]').val(data.payerID);
                        $('input[name="payment_method"]').val('paypal');
                        $('#order-place').submit();
                    });
                },
                onCancel: function(data) {
                    $('input[name="payment_status"]').val('Failed');
                    $('input[name="payment_id"]').val(data.paymentID);
                    $('input[name="payer_id"]').val('');
                    $('input[name="payment_method"]').val('paypal');
                }
            }, '#paypal-button-container-popup');
        }
        $(document).ready(function() {
            renderPaypalButton();
        });
    </script>


    <script>
        $(document).ready(function() {

            function fetchShipping() {
                let address = $('#address_input').val().trim();
                let city = $('#city').val().trim();
                let postal = $('#zip_code').val().trim();
                let country = $('#country').val() || 'US';
                let token = $('#hidden_fedex_token').val();

                if (address.length < 5 || city.length < 2 || postal.length < 4 || !token) return;

                $('#shipping-methods-container').html('Loading shipping...');
                $('#shipping-methods-wrapper').show();

                $.ajax({
                    url: "{{ route('fedex.shipping') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        address,
                        city,
                        postal,
                        country,
                        token
                    },
                    success: function(res) {
                        $('#shipping-methods-container').html('');
                        if (!res.status || !res.methods || !res.methods.output) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }
                        let quotes = res.methods.output.rateReplyDetails || [];
                        if (quotes.length === 0) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }

                        quotes.forEach(function(q) {
                            let serviceName = q.serviceType;
                            let amount = q.ratedShipmentDetails[0].totalNetCharge.amount || 0;
                            $('#shipping-methods-container').append(`
                        <div>
                            <label>
                                <input type="radio" name="shipping" data-amount="${amount}">
                                ${serviceName} - $${amount}
                            </label>
                        </div>
                    `);
                        });
                    },
                    error: function(err) {
                        console.error("FedEx error: ", err.responseJSON || err);
                        $('#shipping-methods-container').html('FedEx error');
                    }
                });
            }

            // Typing delay
            let typingTimer;
            let doneTypingInterval = 800;
            $('#address_input, #city, #zip_code').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(fetchShipping, doneTypingInterval);
            });

            // Fetch FedEx token
            $('#address_input').on('input', function() {
                let address = $(this).val().trim();
                if (address.length < 3) return;

                $.ajax({
                    url: "{{ route('fedex.token') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.access_token) {
                            $('#hidden_fedex_token').val(res.access_token);
                            fetchShipping(); // fetch shipping after token
                            console.log("FedEx Token:", res.access_token);
                        } else {
                            console.error("No token returned from FedEx");
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching FedEx token", err);
                    }
                });
            });

            // Update total on shipping selection
            $(document).on('change', 'input[name="shipping"]', function() {
                let amount = parseFloat($(this).data('amount')) || 0;
                $('#shipping').val(amount);

                let subtotal = parseFloat("{{ $subtotal ?? 0 }}");
                let tax = parseFloat("{{ $tax ?? 0 }}");
                let total = (subtotal + tax + amount).toFixed(2);

                $('#total_price').val(total);
                $('.span_total').text('$' + total);
                $('#stripe-submit').text('Pay Now $' + total);
            });

        });
    </script>




@endsection
