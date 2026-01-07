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
            // Country & US States Setup
            // --------------------------
            const countries = {
                "AF": "Afghanistan",
                "AL": "Albania",
                "DZ": "Algeria",
                "AS": "American Samoa",
                "AD": "Andorra",
                "AO": "Angola",
                "AI": "Anguilla",
                "AQ": "Antarctica",
                "AG": "Antigua and Barbuda",
                "AR": "Argentina",
                "AM": "Armenia",
                "AW": "Aruba",
                "AU": "Australia",
                "AT": "Austria",
                "AZ": "Azerbaijan",
                "BS": "Bahamas",
                "BH": "Bahrain",
                "BD": "Bangladesh",
                "BB": "Barbados",
                "BY": "Belarus",
                "BE": "Belgium",
                "BZ": "Belize",
                "BJ": "Benin",
                "BM": "Bermuda",
                "BT": "Bhutan",
                "BO": "Bolivia",
                "BA": "Bosnia and Herzegovina",
                "BW": "Botswana",
                "BR": "Brazil",
                "BN": "Brunei",
                "BG": "Bulgaria",
                "BF": "Burkina Faso",
                "BI": "Burundi",
                "KH": "Cambodia",
                "CM": "Cameroon",
                "CA": "Canada",
                "CV": "Cape Verde",
                "KY": "Cayman Islands",
                "CF": "Central African Republic",
                "TD": "Chad",
                "CL": "Chile",
                "CN": "China",
                "CO": "Colombia",
                "KM": "Comoros",
                "CG": "Congo",
                "CR": "Costa Rica",
                "CI": "Côte d'Ivoire",
                "HR": "Croatia",
                "CU": "Cuba",
                "CY": "Cyprus",
                "CZ": "Czech Republic",
                "DK": "Denmark",
                "DJ": "Djibouti",
                "DM": "Dominica",
                "DO": "Dominican Republic",
                "EC": "Ecuador",
                "EG": "Egypt",
                "SV": "El Salvador",
                "GQ": "Equatorial Guinea",
                "ER": "Eritrea",
                "EE": "Estonia",
                "SZ": "Eswatini",
                "ET": "Ethiopia",
                "FJ": "Fiji",
                "FI": "Finland",
                "FR": "France",
                "GA": "Gabon",
                "GM": "Gambia",
                "GE": "Georgia",
                "DE": "Germany",
                "GH": "Ghana",
                "GR": "Greece",
                "GD": "Grenada",
                "GU": "Guam",
                "GT": "Guatemala",
                "GN": "Guinea",
                "GW": "Guinea-Bissau",
                "GY": "Guyana",
                "HT": "Haiti",
                "HN": "Honduras",
                "HK": "Hong Kong",
                "HU": "Hungary",
                "IS": "Iceland",
                "IN": "India",
                "ID": "Indonesia",
                "IR": "Iran",
                "IQ": "Iraq",
                "IE": "Ireland",
                "IL": "Israel",
                "IT": "Italy",
                "JM": "Jamaica",
                "JP": "Japan",
                "JO": "Jordan",
                "KZ": "Kazakhstan",
                "KE": "Kenya",
                "KI": "Kiribati",
                "KW": "Kuwait",
                "KG": "Kyrgyzstan",
                "LA": "Laos",
                "LV": "Latvia",
                "LB": "Lebanon",
                "LS": "Lesotho",
                "LR": "Liberia",
                "LY": "Libya",
                "LI": "Liechtenstein",
                "LT": "Lithuania",
                "LU": "Luxembourg",
                "MO": "Macau",
                "MG": "Madagascar",
                "MW": "Malawi",
                "MY": "Malaysia",
                "MV": "Maldives",
                "ML": "Mali",
                "MT": "Malta",
                "MH": "Marshall Islands",
                "MR": "Mauritania",
                "MU": "Mauritius",
                "MX": "Mexico",
                "FM": "Micronesia",
                "MD": "Moldova",
                "MC": "Monaco",
                "MN": "Mongolia",
                "ME": "Montenegro",
                "MA": "Morocco",
                "MZ": "Mozambique",
                "MM": "Myanmar",
                "NA": "Namibia",
                "NR": "Nauru",
                "NP": "Nepal",
                "NL": "Netherlands",
                "NZ": "New Zealand",
                "NI": "Nicaragua",
                "NE": "Niger",
                "NG": "Nigeria",
                "KP": "North Korea",
                "MK": "North Macedonia",
                "NO": "Norway",
                "OM": "Oman",
                "PK": "Pakistan",
                "PW": "Palau",
                "PA": "Panama",
                "PG": "Papua New Guinea",
                "PY": "Paraguay",
                "PE": "Peru",
                "PH": "Philippines",
                "PL": "Poland",
                "PT": "Portugal",
                "PR": "Puerto Rico",
                "QA": "Qatar",
                "RO": "Romania",
                "RU": "Russia",
                "RW": "Rwanda",
                "KN": "Saint Kitts and Nevis",
                "LC": "Saint Lucia",
                "VC": "Saint Vincent and the Grenadines",
                "WS": "Samoa",
                "SM": "San Marino",
                "ST": "Sao Tome and Principe",
                "SA": "Saudi Arabia",
                "SN": "Senegal",
                "RS": "Serbia",
                "SC": "Seychelles",
                "SL": "Sierra Leone",
                "SG": "Singapore",
                "SK": "Slovakia",
                "SI": "Slovenia",
                "SB": "Solomon Islands",
                "SO": "Somalia",
                "ZA": "South Africa",
                "KR": "South Korea",
                "SS": "South Sudan",
                "ES": "Spain",
                "LK": "Sri Lanka",
                "SD": "Sudan",
                "SR": "Suriname",
                "SE": "Sweden",
                "CH": "Switzerland",
                "SY": "Syria",
                "TW": "Taiwan",
                "TJ": "Tajikistan",
                "TZ": "Tanzania",
                "TH": "Thailand",
                "TL": "Timor-Leste",
                "TG": "Togo",
                "TO": "Tonga",
                "TT": "Trinidad and Tobago",
                "TN": "Tunisia",
                "TR": "Turkey",
                "TM": "Turkmenistan",
                "TV": "Tuvalu",
                "UG": "Uganda",
                "UA": "Ukraine",
                "AE": "United Arab Emirates",
                "GB": "United Kingdom",
                "US": "United States",
                "UY": "Uruguay",
                "UZ": "Uzbekistan",
                "VU": "Vanuatu",
                "VA": "Vatican City",
                "VE": "Venezuela",
                "VN": "Vietnam",
                "YE": "Yemen",
                "ZM": "Zambia",
                "ZW": "Zimbabwe"
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
            // Country Dropdown
            // --------------------------
            let countrySelect = $('#country');
            countrySelect.prop('type', 'hidden');
            let countryDropdown = $(
                '<select class="form-control left" id="country_select" name="country"></select>');
            $.each(countries, function(code, name) {
                let selected = code === (countrySelect.val() || 'US') ? 'selected' : '';
                countryDropdown.append(`<option value="${code}" ${selected}>${name}</option>`);
            });
            countrySelect.after(countryDropdown);

            function populateStates() {
                let stateSelect = $('#stateOrProvinceCode');
                stateSelect.html('<option value="">Select State</option>');
                $.each(usStates, function(code, name) {
                    stateSelect.append(`<option value="${code}">${name}</option>`);
                });
            }

            function toggleStateDropdown() {
                if ($('#country_select').val() === 'US') {
                    $('#state-wrapper').show();
                    populateStates();
                } else {
                    $('#state-wrapper').hide();
                }
            }
            toggleStateDropdown();
            $('#country_select').on('change', toggleStateDropdown);

            // --------------------------
            // Simple Address Validation (Required only)
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
            // FedEx Errors Mapping
            // --------------------------
            const fedexErrors = {
                "RECIPIENTS.ADDRESSSTATEORPROVINCECODE.MISMATCH": "State does not match country. Please check your state.",
                "RECIPIENTS.POSTALCODE.INVALID": "ZIP/Postal code seems invalid. Please check your ZIP code.",
                "RECIPIENTS.ADDRESSLINE1.INVALID": "Address seems invalid. Please check your address.",
                "RECIPIENTS.COUNTRY.INVALID": "Country is invalid. Please select a valid country."
            };

            // --------------------------
            // Fetch FedEx Shipping
            // --------------------------
            function fetchFedexShipping() {
                if (!validateAddress()) {
                    $('#shipping-methods-wrapper').hide();
                    return;
                }

                let addressFull = $('#address_input').val().trim(); // Full user input
                let city = $('#city').val().trim();
                let postal = $('#zip_code').val().trim();
                let country = $('#country_select').val();
                let state = $('#stateOrProvinceCode').val();

                if (!addressFull || !city || !postal || !country) {
                    $('#shipping-methods-wrapper').hide();
                    return;
                }

                $('#shipping-methods-wrapper').show();
                $('#shipping-methods-container').html('Calculating shipping...');

                // Only send essential part of address to FedEx (first 3 words or street number + name)
                let essentialAddress = addressFull.split(/\s+/).slice(0, 3).join(' ');

                console.log("Sending to FedEx:", {
                    address: essentialAddress,
                    city,
                    postal,
                    country,
                    state
                });

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
                        console.log("FedEx Response:", res);
                        let shipping = 0;
                        let tracking = '';

                        if (res.status) {
                            shipping = parseFloat(res.shippingPrice) || 0;
                            tracking = res.tracking_number ?? '';
                        } else {
                            let code = res.details?.errors?.[0]?.code || '';
                            let userMsg = fedexErrors[code] ||
                                "Unable to calculate shipping. Please check your address.";
                            $('#shipping-methods-container').html(
                                `<span style="color:red;">${userMsg}</span>`);
                            $('#shipping').val(0);
                            $('#tracking_number').val('');
                            updateTotal(0);
                            return;
                        }

                        let displayShipping = shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`;
                        $('#shipping-methods-container').html(
                            `<label>FedEx Shipping</label>`
                        );

                        $('#shipping').val(shipping);
                        $('#tracking_number').val(tracking);
                        updateTotal(shipping);
                    },
                    error: function(xhr) {
                        console.error("FedEx AJAX Error:", xhr);
                        let errMsg = "Unable to calculate shipping. Please check your address.";
                        $('#shipping-methods-container').html(
                            `<span style="color:red;">${errMsg}</span>`);
                        $('#shipping').val(0);
                        $('#tracking_number').val('');
                        updateTotal(0);
                    }
                });
            }

            // --------------------------
            // Update Order Total
            // --------------------------
            function updateTotal(shipping) {
                let subtotal = parseFloat("{{ $subtotal }}");
                let tax = parseFloat("{{ $tax }}");
                let total = subtotal + tax + shipping;

                $('.span_total').text('$' + total.toFixed(2));
                let displayShipping = shipping === 0 ? 'Free' : '$' + shipping.toFixed(2);
                $('.amount-wrapper h2:nth-child(2) span').text(displayShipping);

                $('#total_price').val(total.toFixed(2));
                $('#stripe-submit').text('Pay $' + total.toFixed(2));
            }

            // --------------------------
            // Trigger shipping fetch
            // --------------------------
            $('#address_input,#city,#zip_code,#stateOrProvinceCode,#country_select').on('keyup change', function() {
                clearTimeout(window.shipTimer);
                window.shipTimer = setTimeout(fetchFedexShipping, 700);
            });

        });
    </script>




@endsection
