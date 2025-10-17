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


                                                    {{-- ✅ SUCCESS MESSAGE (TOP) --}}
                                                    @if (session('success'))
                                                        <div
                                                            style="
                                                                background-color: #f4f5fa;
                                                                border-left: 5px solid #ffd500;
                                                                color: #040404;
                                                                padding: 15px 20px;
                                                                border-radius: 8px;
                                                                font-weight: 500;
                                                                margin-bottom: 20px;
                                                                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                                                                display: flex;
                                                                align-items: center;
                                                                gap: 10px;
                                                            ">
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='22'
                                                                height='22' fill='#ffd500' viewBox='0 0 24 24'>
                                                                <path
                                                                    d='M12 0C5.373 0 0 5.373 0 12c0 6.627 5.373 12 12 12s12-5.373 12-12C24 5.373 18.627 0 12 0zm-1 17.414-4.707-4.707 1.414-1.414L11 14.586l5.293-5.293 1.414 1.414L11 17.414z' />
                                                            </svg>
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif

                                                    {{-- ✅ ERROR MESSAGE --}}
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger text-center"
                                                            style="border-radius:10px;">
                                                            <ul class="mb-0" style="list-style:none;">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>⚠️ {{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <form action="{{ route('affiliate.store') }}" method="POST">
                                                        @csrf

                                                        <!-- Affiliate Information -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Affiliate Information</h4>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Full Legal Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="full_name"
                                                                        value="{{ old('full_name', $affiliate->full_name ?? '') }}"
                                                                        placeholder="{{ $affiliate->full_name ?? 'Enter your full name' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Business Name (if
                                                                        applicable)</label>
                                                                    <input type="text" class="form-input"
                                                                        name="business_name"
                                                                        value="{{ old('business_name', $affiliate->business_name ?? '') }}"
                                                                        placeholder="{{ $affiliate->business_name ?? 'Enter business name' }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Email Address</label>
                                                                    <input type="email" class="form-input" name="email"
                                                                        value="{{ old('email', $affiliate->email ?? '') }}"
                                                                        placeholder="{{ $affiliate->email ?? 'your@email.com' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Phone Number</label>
                                                                    <input type="text" class="form-input" name="phone"
                                                                        value="{{ old('phone', $affiliate->phone ?? '') }}"
                                                                        placeholder="{{ $affiliate->phone ?? '+92 300 0000000' }}">
                                                                </div>

                                                                <div class="form-group full-width">
                                                                    <label class="form-label">Full Mailing Address</label>
                                                                    <textarea class="form-input" name="address" rows="3"
                                                                        placeholder="{{ $affiliate->address ?? 'Your complete address' }}">{{ old('address', $affiliate->address ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Bank Account Information -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Bank Account Information</h4>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Account Holder Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="account_holder_name"
                                                                        value="{{ old('account_holder_name', $affiliate->account_holder_name ?? '') }}"
                                                                        placeholder="{{ $affiliate->account_holder_name ?? 'As on your bank account' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Bank Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="bank_name"
                                                                        value="{{ old('bank_name', $affiliate->bank_name ?? '') }}"
                                                                        placeholder="{{ $affiliate->bank_name ?? 'Bank name' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Account Number</label>
                                                                    <input type="text" class="form-input"
                                                                        name="account_number"
                                                                        value="{{ old('account_number', $affiliate->account_number ?? '') }}"
                                                                        placeholder="{{ $affiliate->account_number ?? 'Your account number' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Routing/SWIFT/BIC Code</label>
                                                                    <input type="text" class="form-input"
                                                                        name="routing_swift_bic_code"
                                                                        value="{{ old('routing_swift_bic_code', $affiliate->routing_swift_bic_code ?? '') }}"
                                                                        placeholder="{{ $affiliate->routing_swift_bic_code ?? 'Enter code' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Account Type</label>
                                                                    <select class="form-input" name="account_type">
                                                                        <option value="">Select type</option>
                                                                        <option value="Checking"
                                                                            {{ isset($affiliate) && $affiliate->account_type == 'Checking' ? 'selected' : '' }}>
                                                                            Checking</option>
                                                                        <option value="Savings"
                                                                            {{ isset($affiliate) && $affiliate->account_type == 'Savings' ? 'selected' : '' }}>
                                                                            Savings</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Bank Location</label>
                                                                    <input type="text" class="form-input"
                                                                        name="bank_location"
                                                                        value="{{ old('bank_location', $affiliate->bank_location ?? '') }}"
                                                                        placeholder="{{ $affiliate->bank_location ?? 'e.g., USA' }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Currency</label>
                                                                    <input type="text" class="form-input"
                                                                        name="currency"
                                                                        value="{{ old('currency', $affiliate->currency ?? '') }}"
                                                                        placeholder="{{ $affiliate->currency ?? 'e.g., USD, PKR, EUR' }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Authorization -->
                                                        <div class="form-section">
                                                            <h4 class="form-heading">Authorization and Agreement</h4>
                                                            <div class="form-grid">
                                                                <div class="form-group">
                                                                    <label class="form-label">Printed Name</label>
                                                                    <input type="text" class="form-input"
                                                                        name="printed_name"
                                                                        value="{{ old('printed_name', $affiliate->printed_name ?? '') }}"
                                                                        placeholder="{{ $affiliate->printed_name ?? 'Full name' }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Signature</label>
                                                                    <input type="text" class="form-input"
                                                                        name="signature"
                                                                        value="{{ old('signature', $affiliate->signature ?? '') }}"
                                                                        placeholder="{{ $affiliate->signature ?? 'Type your signature' }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="form-label">Date</label>
                                                                    <input type="date" id="dateField"
                                                                        class="form-input" name="date"
                                                                        value="{{ old('date', $affiliate->date ?? '') }}"
                                                                        min="{{ now()->toDateString() }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-submit text-center mt-4">
                                                            <button type="submit" class="submit-btn btn btn-primary">
                                                                {{ $affiliate ? 'Update Form' : 'Submit Form' }}
                                                            </button>
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
