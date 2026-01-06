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
                                <input type="text" name="country" id="country" class="form-control left"
                                    placeholder="Country" value="{{ old('country') ?? 'US' }}">
                                <span class="invalid-feedback {{ $errors->first('country') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address_input" name="address_line_1"
                                    placeholder="Type any address" required>
                                <span class="invalid-feedback {{ $errors->first('address_line_1') ? 'd-block' : '' }}">
                                    <strong>{{ $errors->first('address_line_1') }}</strong>
                                </span>
                            </div>

                            <!-- STATE/PROVINCE dropdown -->
                            <div class="form-group" id="state-wrapper">
                                <select class="form-control" name="stateOrProvinceCode" id="stateOrProvinceCode">
                                    <option value="">Select State</option>
                                    <!-- US States dynamically filled by JS -->
                                </select>
                                <span
                                    class="invalid-feedback {{ $errors->first('stateOrProvinceCode') ? 'd-block' : '' }}">
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
                            <input type="hidden" id="hidden_address">
                            <input type="hidden" id="hidden_city">
                            <input type="hidden" id="hidden_state">
                            <input type="hidden" id="hidden_postal">
                            <input type="hidden" id="hidden_fedex_token" value="">
                            <input type="hidden" id="hidden_country" value="US">

                            <div class="form-group">
                                <input class="form-control" id="zip_code" name="zip_code" placeholder="Postcode"
                                    type="text" value="{{ old('zip_code') }}">
                            </div>
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
                            <h2>Item Subtotal <span>${{ number_format($subtotal, 2) }}</span></h2>
                            <h2>Shipping & Handling <span>Free</span></h2>
                            @php $tax = 0.0; @endphp
                            <h3> Order Total Amount <span
                                    class="span_total">${{ number_format($subtotal + $tax, 2) }}</span></h3>
                        </div>
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
    <script src="https://www.paypalobjects.com/api/checkout.js?disable-funding=credit"></script>
    <script src="https://js.stripe.com/v3/"></script>


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
                        country
                    },
                    success: function(res) {
                        $('#shipping-methods-container').html('');

                        if (!res.status || !res.shipment || !res.shipment.output || !res.shipment.output
                            .transactionShipments) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }

                        let shipment = res.shipment.output.transactionShipments[0];
                        if (!shipment || !shipment.completedShipmentDetail || !shipment
                            .completedShipmentDetail.shipmentRating) {
                            $('#shipping-methods-container').html('No shipping available');
                            return;
                        }

                        // Get total net charge and service name
                        let rateDetails = shipment.completedShipmentDetail.shipmentRating
                            .shipmentRateDetails[0];
                        let amount = rateDetails.totalNetCharge?.amount || 0;
                        let currency = rateDetails.totalNetCharge?.currency || 'USD';
                        let serviceName = shipment.serviceName || 'FedEx Shipping';

                        // Render shipping option
                        $('#shipping-methods-container').append(`
                    <div>
                        <label>
                            <input type="radio" name="shipping" data-amount="${amount}" checked>
                            ${serviceName} - ${currency} ${amount.toFixed(2)}
                        </label>
                    </div>
                `);

                        // Set default shipping in hidden input
                        $('#shipping').val(amount);

                        // Update total price immediately
                        updateTotal(amount);
                    },
                    error: function(err) {
                        console.error("FedEx error: ", err.responseJSON || err);
                        $('#shipping-methods-container').html('FedEx error');
                    }
                });
            }

            // Update total price
            function updateTotal(shippingAmount) {
                let subtotal = parseFloat("{{ $subtotal ?? 0 }}");
                let tax = parseFloat("{{ $tax ?? 0 }}");
                let total = (subtotal + tax + parseFloat(shippingAmount || 0)).toFixed(2);

                $('#total_price').val(total);
                $('.span_total').text('$' + total);
                $('#stripe-submit').text('Pay Now $' + total);
            }

            // Typing delay
            let typingTimer;
            let doneTypingInterval = 800;

            $('#address_input, #city, #zip_code').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(fetchShipping, doneTypingInterval);
            });

            // Fetch FedEx token when typing address
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
                        } else {
                            console.error("No token returned from FedEx");
                        }
                    },
                    error: function(err) {
                        console.error("Error fetching FedEx token", err);
                    }
                });
            });

            // Update hidden shipping when user selects different option
            $(document).on('change', 'input[name="shipping"]', function() {
                let amount = parseFloat($(this).data('amount')) || 0;
                $('#shipping').val(amount);
                updateTotal(amount);
            });

        });
    </script>




    <script>
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

        // Populate US states dropdown
        function populateStates() {
            let stateSelect = $('#stateOrProvinceCode');
            stateSelect.html('<option value="">Select State</option>');
            $.each(usStates, function(code, name) {
                stateSelect.append(`<option value="${code}">${name}</option>`);
            });
        }

        // Show state dropdown if country is US
        $('#country').on('change keyup', function() {
            if ($(this).val().toUpperCase() === 'US') {
                $('#state-wrapper').show();
                populateStates();
            } else {
                $('#state-wrapper').hide();
            }
        });

        // Initialize state field on page load if US
        if ($('#country').val().toUpperCase() === 'US') {
            $('#state-wrapper').show();
            populateStates();
        } else {
            $('#state-wrapper').hide();
        }
    </script>

@endsection
