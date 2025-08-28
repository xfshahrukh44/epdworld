@extends('layouts.main')
@section('content')
    <div class="top-prog-sec top-prog-sec2 contact-sec">
        <section class="inpage featurePro">
            <div class="container">
                <div class="row">



                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                        <div class="account_form">
                            <div class="form_head">
                                <h3>Affiliate seller Request Form </h3>
                                <h6> Company Name: Elite Product Distributors </h6>
                                <h6> Affiliate Program Application </h6>

                                <p>Thank you for your interest in partnering with Elite product Distributors! Please fill out the following form to apply for our affiliate program. We will review your application and contact you within with a decision.</p>
                            </div>
                            <form class="affiliateForm" method="POST" action="{{ route('register') }}">
                                @csrf

                                <input type="hidden" id="is_seller" name="is_seller" value="1">

                                <h3 class="mb-3">Affiliate Program Application</h3>
                                <p>Thank you for your interest in partnering with <strong>Elite Product Distributors</strong>!
                                Please fill out the following form to apply. We will review your application and contact you with a decision.</p>

                                {{-- Contact and Business Information --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name *" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name *" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address *" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="company_name" placeholder="Company/Blog/Brand/Website URL (if applicable)">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number *" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Address *" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="zip" placeholder="Zip/Postal Code">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="country" placeholder="Country *" required>
                                </div>

                                {{-- Experience & Strategy --}}
                                <div class="form-group">
                                    <textarea class="form-control" name="why_join" placeholder="Why do you want to join our affiliate program? *" required></textarea>
                                </div>

                                <label class="d-block">Previous Affiliate Marketing Experience *</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affiliate_experience" id="experienceYes" value="yes">
                                    <label class="form-check-label" for="experienceYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affiliate_experience" id="experienceNo" value="no">
                                    <label class="form-check-label" for="experienceNo">No</label>
                                </div>

                                <div class="form-group mt-2">
                                    <textarea class="form-control" name="experience_details" placeholder="If yes: number of years, types of products"></textarea>
                                </div>

                                {{-- Online Presence --}}
                                <label class="d-block">Social Media Handles/Profiles:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="instagram" id="instagram">
                                    <label class="form-check-label" for="instagram">Instagram</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="facebook" id="facebook">
                                    <label class="form-check-label" for="facebook">Facebook</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="youtube" id="youtube">
                                    <label class="form-check-label" for="youtube">YouTube</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="tiktok" id="tiktok">
                                    <label class="form-check-label" for="tiktok">TikTok</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="snapchat" id="snapchat">
                                    <label class="form-check-label" for="snapchat">Snapchat</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="social_media[]" value="other" id="other">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>

                                <div class="form-group mt-2">
                                    <input type="text" class="form-control" name="competing_brands" placeholder="Are you currently an affiliate for any competing brands?">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hear_about" placeholder="How did you hear about our affiliate program?">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="payment_method" placeholder="Preferred Payment Method for Commission">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="about_yourself" placeholder="Tell us about yourself and why you’d like to join our affiliate program"></textarea>
                                </div>

                                {{-- Legal & Compliance --}}
                                <h5 class="mt-3">Legal & Compliance</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree_terms" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        I have read, understand and agree to the
                                        <a href="#" target="_blank">Affiliate Program Terms, Non-Compete & Conditions</a> *
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree_noncompete" id="agreeNoncompete" required>
                                    <label class="form-check-label" for="agreeNoncompete">
                                        I agree to the terms, non-compete, and conditions *
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree_disclosure" id="agreeDisclosure" required>
                                    <label class="form-check-label" for="agreeDisclosure">
                                        I agree to clearly disclose my affiliate relationship with Elite Product Distributors in all promotions *
                                    </label>
                                </div>

                                {{-- Password --}}
                                <div class="form-group mt-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password *" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password *" required>
                                </div>

                                {{-- Signature --}}
                                <div class="form-group">
                                    <input type="text" class="form-control" name="signature" placeholder="Signature">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="application_date" placeholder="Date">
                                </div>

                                {{-- Submit --}}
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary">Submit Application</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- END: Checkout Section -->
    </div>
    <!-- product page end-->
@endsection
@section('css')
    <style type="text/css">
        .account_form {
            margin: 70px 0px;
        }

        input.log.submit-btn {
            padding: 15px 30px;
            margin-right: 12px;
            background-image: #fed700;
            margin-bottom: 12px;
            float: left;
            border-radius: 25px;
            border-color: unset;
            color: rgb(0, 0, 0);
            text-transform: none;
            width: 100%;
            font-size: 18px;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', ".btn1", function(e) {
            $('.loginForm').submit();
        });
    </script>
@endsection
