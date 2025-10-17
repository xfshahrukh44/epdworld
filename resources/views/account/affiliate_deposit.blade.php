@extends('layouts.main')
@section('title', 'Order')
@section('content')


    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-wrapper inner-banner-wrapper">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="section-heading text-center">
                                    <h1>Affiliate Deposit</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            @include('account.sidebar')

                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <div class="tab-pane show active" id="orders" role="#">
                                        <div class="myaccount-content">
                                            {{-- <div class="section-heading mb-4">
                                                <h2>Affiliate</h2>
                                            </div> --}}

                                            <!-- Affiliate Deposit Form Start -->
                                            <section class="affiliate-deposit-section">
                                                <div class="affiliate-deposit-container">
                                                    <h3 class="form-title">Affiliate Direct Deposit Authorization Form</h3>
                                                    <p class="form-subtitle">
                                                        Set up your direct deposit account to receive commissions from Elite
                                                        Product Distributors.
                                                    </p>

                                                    <form action="{{ route('affiliate.store') }}" method="POST">
                                                        @csrf

                                                        <!-- Affiliate Information -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Affiliate Information</h4>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Full Legal Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="full_name" placeholder="Enter your full name"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Business Name (if
                                                                        applicable)</label>
                                                                    <input type="text" class="form-input"
                                                                        name="business_name"
                                                                        placeholder="Enter business name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Email Address</label>
                                                                    <input type="email" class="form-input" name="email"
                                                                        placeholder="your@email.com" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="text" class="form-input" name="phone"
                                                                        placeholder="+92 300 0000000">
                                                                </div>
                                                                <div class="form-group full-width">
                                                                    <label class="form-label">Full Mailing Address</label>
                                                                    <textarea class="form-input" name="address" rows="3" placeholder="Your complete address"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Affiliate Tax Agreement -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Affiliate Tax Agreement</h4>
                                                            <p class="form-text">
                                                                The affiliate is an independent contractor and is not an
                                                                employee, agent, or partner of
                                                                <strong>Elite Product Distributors World</strong>. The
                                                                affiliate shall be solely responsible for all
                                                                taxes, including but not limited to self-employment taxes,
                                                                income taxes, and any other taxes due
                                                                as a result of their participation in the affiliate program.
                                                            </p>
                                                        </div>

                                                        <!-- Bank Account Information -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Bank Account Information</h4>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Account Holder Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="account_holder_name"
                                                                        placeholder="As on your bank account" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Bank Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="bank_name" placeholder="Bank name" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Account Number</label>
                                                                    <input type="text" class="form-input"
                                                                        name="account_number"
                                                                        placeholder="Your account number" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Routing/SWIFT/BIC Code</label>
                                                                    <input type="text" class="form-input"
                                                                        name="routing_swift_bic_code"
                                                                        placeholder="Enter code" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Account Type</label>
                                                                    <select class="form-input" name="account_type">
                                                                        <option value="">Select type</option>
                                                                        <option value="Checking">Checking</option>
                                                                        <option value="Savings">Savings</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Bank Location</label>
                                                                    <input type="text" class="form-input"
                                                                        name="bank_location" placeholder="e.g., USA">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Currency</label>
                                                                    <input type="text" class="form-input"
                                                                        name="currency" placeholder="e.g., USD, PKR, EUR">
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Authorization and Agreement -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Authorization and Agreement</h4>
                                                            <p class="form-text">
                                                                I, [Affiliate's Full Legal Name], authorize <strong>Elite
                                                                    Product Distributors</strong> to initiate
                                                                credit entries (deposits) into the bank account specified
                                                                above for commissions earned from my
                                                                participation in the affiliate program. Commissions will be
                                                                calculated as 30% of net profit from
                                                                sales attributed to my affiliate link.
                                                            </p>
                                                            <p class="form-text">
                                                                <strong>Recoupment Clause:</strong> In the event that funds
                                                                are deposited in error, I authorize
                                                                Elite Product Distributors to debit the erroneous amount
                                                                from my account.
                                                            </p>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Printed Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="printed_name" placeholder="Full name"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Signature</label>
                                                                    <input type="text" class="form-input"
                                                                        name="signature"
                                                                        placeholder="Type your signature">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="date" id="dateField" class="form-input"
                                                                        name="date">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Submit -->
                                                        <div class="form-submit text-center">
                                                            <button type="submit" class="submit-btn">Submit Form</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </section>
                                            <!-- Affiliate Deposit Form End -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .affiliate-deposit-section {
            background: #f4f5fa;
            padding: 30px;
            border-radius: 12px;
        }

        .affiliate-deposit-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            border-top: 4px solid #ffd500;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 22px;
            font-weight: 700;
            color: #040404;
            text-align: center;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #6b6b6b;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-section {
            margin-bottom: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #eee;
        }

        .form-heading {
            color: #040404;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #ffd500;
            padding-bottom: 5px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #040404;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus {
            border-color: #ffd500;
            box-shadow: 0 0 0 3px rgba(255, 213, 0, 0.3);
            outline: none;
        }

        .form-text {
            color: #444;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .submit-btn {
            background-color: #ffd500;
            color: #040404;
            font-weight: 600;
            padding: 12px 40px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background-color: #040404;
            color: #ffd500;
        }
    </style>
@endsection

@section('js')
    <script>
        // Get today's date in YYYY-MM-DD format
        const today = new Date().toISOString().split('T')[0];
        // Set the minimum allowed date to today
        document.getElementById('dateField').setAttribute('min', today);
    </script>
@endsection
