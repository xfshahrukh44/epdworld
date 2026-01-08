@extends('layouts.main')
@section('title', 'Checkout')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
        integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
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
                                <input type="text" name="country" id="country" class="form-control left"
                                    placeholder="Country" value="{{ old('country') ?? 'US' }}">
                                <span class="invalid-feedback {{ $errors->first('country') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            </div>

                            <!-- STATE/PROVINCE dropdown -->
                            <div class="form-group" id="state-wrapper">
                                <select class="form-control" name="stateOrProvinceCode" id="stateOrProvinceCode">
                                    <option value="">Select State</option>
                                    <!-- US States dynamically filled by JS -->
                                </select>
                                <span class="invalid-feedback {{ $errors->first('stateOrProvinceCode') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('stateOrProvinceCode') }}</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <input class="form-control right" placeholder="Town / City *" name="city" id="city"
                                    type="text" required>
                                <span class="invalid-feedback {{ $errors->first('city') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <input class="form-control" id="zip_code" name="zip_code" placeholder="Postcode"
                                    type="text" value="{{ old('zip_code') }}">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="address_input" name="address_line_1"
                                    placeholder="Type any address" required>
                                <span class="invalid-feedback {{ $errors->first('address_line_1') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('address_line_1') }}</strong>
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

                            <input type="hidden" name="shipping_amount" id="shipping">
                            <input type="hidden" name="tracking_number" id="tracking_number">
                            <input type="hidden" id="total_price">
                            <input type="hidden" id="hidden_address">
                            <input type="hidden" id="hidden_city">
                            <input type="hidden" id="hidden_state">
                            <input type="hidden" id="hidden_postal">
                            <input type="hidden" id="hidden_fedex_token" value="">
                            <input type="hidden" id="hidden_country" value="US">


                            <div class="form-group">
                                <textarea class="form-control" id="comment" name="order_notes" placeholder="Order Note" rows="5">{{ old('order_notes') }}</textarea>
                            </div>
                        @else
                            <!-- Non-auth form code (kept intact) -->
                            <a href="{{ url('signin') }}" target="_blank" class="runningBtn">Returning customer? Click
                                here
                                to login</a>
                            <!-- ... keep all your non-auth fields here exactly as before ... -->
                        @endif
                    </form>
                </div>

                <!-- Order summary & payment (kept intact) -->
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
                            $variation += $value['variation_price']; ?>
                        @endforeach
                        <div class="amount-wrapper">
                            <h2>Item Subtotal <span id="subtotal_amount">${{ number_format($subtotal, 2) }}</span></h2>
                            <h2>Shipping & Handling <span id="shipping_amount_display">Free</span></h2>
                            <div id="shipping-methods-container"></div>
                            @php $tax = 0.0; @endphp
                            <h3>Order Total Amount <span id="total_amount"
                                    class="span_total">${{ number_format($subtotal + $tax, 2) }}</span></h3>
                        </div>

                        <!-- Hidden inputs for form submission -->
                        <input type="hidden" name="shipping_amount" id="shipping" value="0">
                        <input type="hidden" name="total_price" id="total_price" value="{{ $subtotal + $tax }}">
                    </div>
                    <div id="accordion" class="payment-accordion">
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
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js?disable-funding=credit"></script>
    <script src="https://js.stripe.com/v3/"></script>




    <script>
        // $(document).on('click', ".btn", function(e){
        //   $('#order-place').submit();
        // });

        $('#accordion .btn-link').on('click', function(e) {
            if (!$(this).hasClass('collapsed')) {
                e.stopPropagation();
            }
            $('#payment_method').val($(this).attr('data-payment'));
        });

        $('.bttn').on('change', function() {
            var count = 0;
            if ($(this).prop("checked") == true) {
                if ($('#f-name').val() == "") {
                    $('.fname').text('first name is required field');
                } else {
                    $('.fname').text("");
                    count++;
                }
                if ($('#l-name').val() == "") {
                    $('.lname').text('last name is required field');
                } else {
                    $('.lname').text("");
                    count++;
                }

                if (count == 2) {
                    $('#paypal-button-container-popup').show();
                } else {
                    $(this).prop("checked", false);

                    $.toast({
                        heading: 'Alert!',
                        position: 'bottom-right',
                        text: 'Please fill the required fields before proceeding to pay',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });

                    return false;

                }

            } else {
                $('#paypal-button-container-popup').hide();
                // $('.btn').show();
            }

            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            //$(this).siblings('input[type="checkbox"]').prop('checked', false);
        });

        const renderPaypalButton = (amount = {{ number_format((float) $subtotal + $tax, 2, '.', '') }}) => {
            paypal.Button.render({
                env: 'sandbox', //production

                style: {
                    label: 'checkout',
                    size: 'responsive',
                    shape: 'rect',
                    color: 'gold',
                    tagline: false
                },
                client: {
                    sandbox: 'AV06KMdIerC8pd6_i1gQQlyVoIwV8e_1UZaJKj9-aELaeNXIGMbdR32kDDEWS4gRsAis6SRpUVYC9Jmf',
                    // production:'ARIYLCFJIoObVCUxQjohmqLeFQcHKmQ7haI-4kNxHaSwEEALdWABiLwYbJAwAoHSvdHwKJnnOL3Jlzje',
                },
                validate: function(actions) {
                    actions.disable();
                    paypalActions = actions;
                },

                onClick: function(e) {
                    var errorCount = checkEmptyFileds();

                    if (errorCount == 1) {
                        $.toast({
                            heading: 'Alert!',
                            position: 'bottom-right',
                            text: 'Please fill the required fields before proceeding to pay',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            stack: 6
                        });
                        paypalActions.disable();
                    } else {
                        paypalActions.enable();
                    }
                },
                payment: function(data, actions) {
                    return actions.payment.create({
                        payment: {
                            transactions: [{
                                {{-- amount: {total: {{number_format(((float)$subtotal),2, '.', '')}}, currency: 'USD'} --}}
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
                        // generateNotification('success','Payment Authorized');

                        $.toast({
                            heading: 'Success!',
                            position: 'bottom-right',
                            text: 'Payment Authorized',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 1000,
                            stack: 6
                        });

                        var params = {
                            payment_status: 'Completed',
                            paymentID: data.paymentID,
                            payerID: data.payerID
                        };

                        // console.log(data.paymentID);
                        // return false;
                        $('input[name="payment_status"]').val('Completed');
                        $('input[name="payment_id"]').val(data.paymentID);
                        $('input[name="payer_id"]').val(data.payerID);
                        $('input[name="payment_method"]').val('paypal');
                        $('#order-place').submit();
                    });
                },
                onCancel: function(data, actions) {
                    var params = {
                        payment_status: 'Failed',
                        paymentID: data.paymentID
                    };
                    $('input[name="payment_status"]').val('Failed');
                    $('input[name="payment_id"]').val(data.paymentID);
                    $('input[name="payer_id"]').val('');
                    $('input[name="payment_method"]').val('paypal');
                }
            }, '#paypal-button-container-popup');
        }
        renderPaypalButton();



        var stripe = Stripe('{{ env('STRIPE_KEY') }}');

        // Create an instance of Elements.
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
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

        var form = document.getElementById('order-place');

        $('#stripe-submit').click(function() {
            stripe.createToken(card).then(function(result) {
                var errorCount = checkEmptyFileds();
                if ((result.error) || (errorCount == 1)) {
                    // Inform the user if there was an error.
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        $(errorElement).show();
                        errorElement.textContent = result.error.message;
                    } else {
                        $.toast({
                            heading: 'Alert!',
                            position: 'bottom-right',
                            text: 'Please fill the required fields before proceeding to pay',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            stack: 6
                        });
                    }
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('order-place');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }


        function checkEmptyFileds() {
            var errorCount = 0;
            $('form#order-place').find('.form-control').each(function() {
                if ($(this).prop('required')) {
                    if (!$(this).val()) {
                        $(this).parent().find('.invalid-feedback').addClass('d-block');
                        $(this).parent().find('.invalid-feedback strong').html('Field is Required');
                        errorCount = 1;
                    }
                }
            });
            return errorCount;
        }
    </script>

    {{-- <script>
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
                // onClick: function() {
                //     if (checkEmptyFields() === 1) {
                //         showToast('Please fill the required fields before proceeding to pay', 'error');
                //         paypalActions.disable();
                //     } else {
                //         paypalActions.enable();
                //     }
                // },
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
    </script> --}}


    <script>
        $(document).ready(function() {

            // --------------------------
            // RESET SHIPPING FUNCTION
            // --------------------------
            function resetShipping(reason = '') {
                console.warn('Shipping reset:', reason);
                $('#shipping-methods-wrapper').hide();
                $('#shipping-methods-container').html('');

                $('#shipping').val(0);
                $('#tracking_number').val('');

                // Purana span me show
                $('#shipping_amount_display').text('Free');

                updateTotal(0);
            }

            // --------------------------
            // COUNTRIES & US STATES
            // --------------------------
            const countries = {
                "AF": "Afghanistan",
                "AL": "Albania",
                "DZ": "Algeria",
                "AS": "American Samoa",
                "AD": "Andorra",
                "AO": "Angola",
                "AR": "Argentina",
                "AU": "Australia",
                "AT": "Austria",
                "BD": "Bangladesh",
                "BE": "Belgium",
                "BR": "Brazil",
                "CA": "Canada",
                "CN": "China",
                "FR": "France",
                "DE": "Germany",
                "IN": "India",
                "IR": "Iran",
                "IT": "Italy",
                "JP": "Japan",
                "MY": "Malaysia",
                "MX": "Mexico",
                "NL": "Netherlands",
                "NZ": "New Zealand",
                "NO": "Norway",
                "PK": "Pakistan",
                "QA": "Qatar",
                "SA": "Saudi Arabia",
                "SG": "Singapore",
                "ZA": "South Africa",
                "KR": "South Korea",
                "ES": "Spain",
                "SE": "Sweden",
                "CH": "Switzerland",
                "TR": "Turkey",
                "AE": "United Arab Emirates",
                "GB": "United Kingdom",
                "US": "United States"
            };

            const usStates = {
                "AL": "Alabama",
                "AK": "Alaska",
                "AZ": "Arizona",
                "AR": "Arkansas",
                "CA": "California",
                "CO": "Colorado",
                "CT": "Connecticut",
                "DE": "Delaware",
                "FL": "Florida",
                "GA": "Georgia",
                "HI": "Hawaii",
                "ID": "Idaho",
                "IL": "Illinois",
                "IN": "Indiana",
                "IA": "Iowa",
                "KS": "Kansas",
                "KY": "Kentucky",
                "LA": "Louisiana",
                "ME": "Maine",
                "MD": "Maryland",
                "MA": "Massachusetts",
                "MI": "Michigan",
                "MN": "Minnesota",
                "MS": "Mississippi",
                "MO": "Missouri",
                "MT": "Montana",
                "NE": "Nebraska",
                "NV": "Nevada",
                "NH": "New Hampshire",
                "NJ": "New Jersey",
                "NM": "New Mexico",
                "NY": "New York",
                "NC": "North Carolina",
                "ND": "North Dakota",
                "OH": "Ohio",
                "OK": "Oklahoma",
                "OR": "Oregon",
                "PA": "Pennsylvania",
                "RI": "Rhode Island",
                "SC": "South Carolina",
                "SD": "South Dakota",
                "TN": "Tennessee",
                "TX": "Texas",
                "UT": "Utah",
                "VT": "Vermont",
                "VA": "Virginia",
                "WA": "Washington",
                "WV": "West Virginia",
                "WI": "Wisconsin",
                "WY": "Wyoming"
            };

            // --------------------------
            // US STATE - CITY VALIDATION
            // --------------------------
            const stateCities = {
                "AL": ["Birmingham", "Montgomery", "Mobile"],
                "AK": ["Anchorage", "Fairbanks"],
                "AZ": ["Phoenix", "Tucson"],
                "AR": ["Little Rock", "Fayetteville"],
                "CA": ["Los Angeles", "San Francisco", "San Diego", "Sacramento"],
                "CO": ["Denver", "Colorado Springs"],
                "CT": ["Hartford", "New Haven"],
                "DE": ["Wilmington", "Dover"],
                "FL": ["Miami", "Orlando", "Tampa"],
                "GA": ["Atlanta", "Savannah", "Augusta"],
                "HI": ["Honolulu", "Hilo"],
                "ID": ["Boise", "Meridian"],
                "IL": ["Chicago", "Springfield"],
                "IN": ["Indianapolis", "Fort Wayne"],
                "IA": ["Des Moines", "Cedar Rapids"],
                "KS": ["Wichita", "Topeka"],
                "KY": ["Louisville", "Lexington"],
                "LA": ["New Orleans", "Baton Rouge"],
                "ME": ["Portland", "Augusta"],
                "MD": ["Baltimore", "Annapolis"],
                "MA": ["Boston", "Worcester"],
                "MI": ["Detroit", "Lansing", "Grand Rapids"],
                "MN": ["Minneapolis", "Saint Paul"],
                "MS": ["Jackson", "Gulfport"],
                "MO": ["Kansas City", "St. Louis"],
                "MT": ["Billings", "Missoula"],
                "NE": ["Omaha", "Lincoln"],
                "NV": ["Las Vegas", "Reno"],
                "NH": ["Manchester", "Concord"],
                "NJ": ["Newark", "Trenton"],
                "NM": ["Albuquerque", "Santa Fe"],
                "NY": ["New York", "Buffalo", "Rochester", "Albany"],
                "NC": ["Charlotte", "Raleigh", "Greensboro"],
                "ND": ["Fargo", "Bismarck"],
                "OH": ["Columbus", "Cleveland", "Cincinnati", "Toledo"],
                "OK": ["Oklahoma City", "Tulsa"],
                "OR": ["Portland", "Salem"],
                "PA": ["Philadelphia", "Pittsburgh", "Harrisburg"],
                "RI": ["Providence", "Warwick"],
                "SC": ["Charleston", "Columbia"],
                "SD": ["Sioux Falls", "Pierre"],
                "TN": ["Nashville", "Memphis"],
                "TX": ["Houston", "Dallas", "Austin", "San Antonio"],
                "UT": ["Salt Lake City", "Provo"],
                "VT": ["Burlington", "Montpelier"],
                "VA": ["Richmond", "Virginia Beach"],
                "WA": ["Seattle", "Spokane", "Tacoma"],
                "WV": ["Charleston", "Morgantown"],
                "WI": ["Milwaukee", "Madison", "Green Bay", "Kenosha"],
                "WY": ["Cheyenne", "Casper"]
            };

            function isCityValidForState(state, city) {
                if (!state || !city) return false;
                let cities = stateCities[state];
                if (!cities) return false;
                return cities.some(c => c.toLowerCase() === city.toLowerCase());
            }

            // --------------------------
            // COUNTRY DROPDOWN
            // --------------------------
            let countryInput = $('#country');
            countryInput.prop('type', 'hidden');
            let countrySelect = $('<select id="country_select" class="form-control left" name="country"></select>');
            $.each(countries, function(code, name) {
                countrySelect.append(`<option value="${code}">${name}</option>`);
            });
            countryInput.after(countrySelect);
            countrySelect.val(countryInput.val() || 'US');

            function populateStates() {
                let state = $('#stateOrProvinceCode');
                state.html('<option value="">Select State</option>');
                $.each(usStates, function(code, name) {
                    state.append(`<option value="${code}">${name}</option>`);
                });
            }

            function toggleState() {
                if ($('#country_select').val() === 'US') {
                    $('#state-wrapper').show();
                    populateStates();
                } else {
                    $('#state-wrapper').hide();
                    $('#stateOrProvinceCode').val('');
                }
            }

            toggleState();
            $('#country_select').on('change', toggleState);

            // --------------------------
            // ADDRESS VALIDATION
            // --------------------------
            function validateAddress() {
                let address = $('#address_input').val().trim();
                if (address === '') {
                    showAddressError('Address is required');
                    return false;
                } else {
                    clearAddressError();
                    return true;
                }
            }

            function showAddressError(msg) {
                $('#address_input').addClass('is-invalid');
                $('#address_input').siblings('.invalid-feedback').html(msg).addClass('d-block');
            }

            function clearAddressError() {
                $('#address_input').removeClass('is-invalid');
                $('#address_input').siblings('.invalid-feedback').removeClass('d-block').html('');
            }

            $('#address_input').on('keyup change', validateAddress);

            // --------------------------
            // FEDEX ERROR MAPPING
            // --------------------------
            const fedexErrors = {
                "RECIPIENTS.ADDRESSSTATEORPROVINCECODE.MISMATCH": "State aur ZIP match nahi kar rahe. State check karein.",
                "RECIPIENTS.POSTALCODE.INVALID": "ZIP / Postal Code ghalat lag raha hai.",
                "RECIPIENTS.ADDRESSLINE1.INVALID": "Address ghalat lag raha hai.",
                "RECIPIENTS.COUNTRY.INVALID": "Country invalid hai."
            };

            // --------------------------
            // FETCH FEDEX SHIPPING
            // --------------------------
            function fetchFedexShipping() {
                let addressFull = $('#address_input').val().trim();
                let city = $('#city').val().trim();
                let postal = $('#zip_code').val().trim();
                let country = $('#country_select').val();
                let state = $('#stateOrProvinceCode').val();

                if (!addressFull || !city || !postal || !country) {
                    resetShipping('Required field empty');
                    return;
                }

                if (country === 'US' && !state) {
                    resetShipping('US state missing');
                    return;
                }

                // City validation
                if (!isCityValidForState(state, city)) {
                    resetShipping('City does not match selected state');
                    $('#shipping-methods-container').html(
                        '<span style="color:red;">City does not match selected state</span>');
                    return;
                }

                let essentialAddress = addressFull.split(/\s+/).slice(0, 3).join(' ');

                $('#shipping-methods-wrapper').show();
                $('#shipping-methods-container').html('Calculating shipping...');

                $.ajax({
                    url: "{{ route('fedex.shipping') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        address: essentialAddress,
                        city,
                        postal,
                        country,
                        state
                    },
                    success: function(res) {
                        // ✅ Fix: Check FedEx response errors properly
                        if (!res.status || (res.details && res.details.errors && res.details.errors
                                .length > 0)) {
                            resetShipping('FedEx error');
                            let code = res.details?.errors?.[0]?.code || '';
                            let msg = fedexErrors[code] ||
                            'Address check karein aur dobara try karein.';
                            $('#shipping-methods-container').html(
                                `<span style="color:red;">${msg}</span>`);
                            return; // shipping show nahi hogi
                        }

                        let shipping = parseFloat(res.shippingPrice) || 0;
                        let tracking = res.tracking_number ?? '';

                        $('#shipping').val(shipping);
                        $('#tracking_number').val(tracking);

                        let display = shipping === 0 ? 'Free' : '$' + shipping.toFixed(2);
                        $('#shipping_amount_display').text(display);

                        $('#shipping-methods-container').html('<strong>FedEx Shipping</strong>');
                        updateTotal(shipping);
                    },
                    error: function() {
                        resetShipping('AJAX failed');
                        $('#shipping-methods-container').html(
                            '<span style="color:red;">FedEx service unavailable</span>');
                    }
                });
            }

            // --------------------------
            // UPDATE TOTAL
            // --------------------------
            function updateTotal(shipping) {
                let subtotal = parseFloat("{{ $subtotal }}");
                let tax = parseFloat("{{ $tax }}");
                let total = subtotal + tax + shipping;

                $('.span_total').text('$' + total.toFixed(2));
                $('#total_price').val(total.toFixed(2));
                $('#stripe-submit').text('Pay $' + total.toFixed(2));
            }

            // --------------------------
            // EVENTS
            // --------------------------
            $('#address_input,#city,#zip_code,#stateOrProvinceCode,#country_select').on('keyup change', function() {
                if (!$(this).val().trim()) {
                    resetShipping('Field cleared: ' + this.id);
                    return;
                }
                clearTimeout(window.shipTimer);
                window.shipTimer = setTimeout(fetchFedexShipping, 600);
            });

        });
    </script>









@endsection
