@extends('layouts.main')
@section('content')
    <div class="top-prog-sec top-prog-sec2 contact-sec">
        <section class="inpage featurePro">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                        <div class="account_form">
                            <div class="form_head">
                                <h3>Affiliate seller Request Form</h3>
                                <h6>Company Name: Elite Product Distributors</h6>
                                <h6>Affiliate Program Application</h6>
                                <p>Thank you for your interest in partnering with Elite product Distributors! Please fill
                                    out the following form to apply for our affiliate program. We will review your
                                    application and contact you within with a decision.</p>
                            </div>

                            <!-- Validation Errors Display -->
                            @if($errors->registerForm->any())
                                <div class="alert alert-danger">
                                    <h4>Please fix the following errors:</h4>
                                    <ul>
                                        @foreach($errors->registerForm->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form class="affiliateForm" method="POST" action="{{ route('register') }}">
                                @csrf
                                <input type="hidden" id="is_seller" name="is_seller" value="1">

                                {{-- Contact and Business Information --}}
                                <div class="form-group">
                                    <label>Contact and business information:</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name *"
                                        required value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name *"
                                        required value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address *"
                                        required value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="company_name"
                                        placeholder="Company/Blog/Brand/Website URL (if applicable)"
                                        value="{{ old('company_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number *"
                                        required value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Address *" required
                                        value="{{ old('address') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="zip" placeholder="Zip/Postal Code"
                                        value="{{ old('zip') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="country" placeholder="Country *" required
                                        value="{{ old('country') }}">
                                </div>

                                {{-- Experience & Strategy --}}
                                <div class="form-group">
                                    <label>Experience & Strategy:</label>
                                    <textarea class="form-control" name="why_join"
                                        placeholder="Why do you want to join our affiliate program? *"
                                        required>{{ old('why_join') }}</textarea>
                                </div>

                                <label class="d-block">Previous Affiliate Marketing Experience *</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affiliate_experience"
                                        id="experienceYes" value="yes" {{ old('affiliate_experience') == 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="experienceYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="affiliate_experience"
                                        id="experienceNo" value="no" {{ old('affiliate_experience') == 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="experienceNo">No</label>
                                </div>

                                <div class="form-group mt-2" id="experienceFields"
                                    style="display: {{ old('affiliate_experience') == 'yes' ? 'block' : 'none' }};">
                                    <input type="text" class="form-control" name="experience_details"
                                        placeholder="If yes: number of years" value="{{ old('experience_details') }}">
                                    <input type="text" class="form-control mt-2" name="experience_details2"
                                        placeholder="If yes: types of products" value="{{ old('experience_details2') }}">
                                </div>

                                {{-- Online Presence & Marketing Platforms --}}
                                <h5 class="mt-4">Online Presence & Marketing Platforms</h5>
                                <p class="mb-3"><strong>Social Media Handles/Profiles:</strong></p>

                                {{-- Instagram --}}
                                <div class="form-group">
                                    <label class="d-block">Instagram</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input instagram-radio" type="radio" name="instagram_yesno"
                                            id="instagramYes" value="yes" {{ old('instagram_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="instagramYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input instagram-radio" type="radio" name="instagram_yesno"
                                            id="instagramNo" value="no" {{ old('instagram_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="instagramNo">No</label>
                                    </div>
                                    <div class="instagram-field mt-2"
                                        style="display: {{ old('instagram_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="instagram_handle"
                                            placeholder="Your Instagram Handle" value="{{ old('instagram_handle') }}">
                                    </div>
                                </div>

                                {{-- Facebook --}}
                                <div class="form-group">
                                    <label class="d-block">Facebook</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input facebook-radio" type="radio" name="facebook_yesno"
                                            id="facebookYes" value="yes" {{ old('facebook_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="facebookYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input facebook-radio" type="radio" name="facebook_yesno"
                                            id="facebookNo" value="no" {{ old('facebook_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="facebookNo">No</label>
                                    </div>
                                    <div class="facebook-field mt-2"
                                        style="display: {{ old('facebook_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="facebook_name"
                                            placeholder="Your Facebook Name" value="{{ old('facebook_name') }}">
                                    </div>
                                </div>

                                {{-- YouTube --}}
                                <div class="form-group">
                                    <label class="d-block">YouTube</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input youtube-radio" type="radio" name="youtube_yesno"
                                            id="youtubeYes" value="yes" {{ old('youtube_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="youtubeYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input youtube-radio" type="radio" name="youtube_yesno"
                                            id="youtubeNo" value="no" {{ old('youtube_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="youtubeNo">No</label>
                                    </div>
                                    <div class="youtube-field mt-2"
                                        style="display: {{ old('youtube_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="youtube_page"
                                            placeholder="Your YouTube Page" value="{{ old('youtube_page') }}">
                                    </div>
                                </div>

                                {{-- TikTok --}}
                                <div class="form-group">
                                    <label class="d-block">TikTok</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tiktok-radio" type="radio" name="tiktok_yesno"
                                            id="tiktokYes" value="yes" {{ old('tiktok_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tiktokYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input tiktok-radio" type="radio" name="tiktok_yesno"
                                            id="tiktokNo" value="no" {{ old('tiktok_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tiktokNo">No</label>
                                    </div>
                                    <div class="tiktok-field mt-2"
                                        style="display: {{ old('tiktok_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="tiktok_channel"
                                            placeholder="Your TikTok Channel" value="{{ old('tiktok_channel') }}">
                                    </div>
                                </div>

                                {{-- Other Social Media --}}
                                <div class="form-group">
                                    <label class="d-block">Other? (Social media presence)</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input other-radio" type="radio" name="other_yesno"
                                            id="otherYes" value="yes" {{ old('other_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="otherYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input other-radio" type="radio" name="other_yesno"
                                            id="otherNo" value="no" {{ old('other_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="otherNo">No</label>
                                    </div>
                                    <div class="other-field mt-2"
                                        style="display: {{ old('other_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="other_social"
                                            placeholder="Please specify" value="{{ old('other_social') }}">
                                    </div>
                                </div>

                                {{-- Competing Brands --}}
                                <div class="form-group">
                                    <label class="d-block">Are you currently an affiliate for any competing brands?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input competing-radio" type="radio"
                                            name="competing_brands_yesno" id="competingYes" value="yes" {{ old('competing_brands_yesno', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="competingYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input competing-radio" type="radio"
                                            name="competing_brands_yesno" id="competingNo" value="no" {{ old('competing_brands_yesno', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="competingNo">No</label>
                                    </div>
                                    <div class="competing-field mt-2"
                                        style="display: {{ old('competing_brands_yesno', 'no') == 'yes' ? 'block' : 'none' }};">
                                        <input type="text" class="form-control" name="competing_brands_details"
                                            placeholder="Please specify" value="{{ old('competing_brands_details') }}">
                                    </div>
                                </div>

                                {{-- Commission Transfer --}}
                                <div class="form-group">
                                    <label class="d-block">Should you earn a commission, it will automatically transfer into
                                        your bank that you provide?</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="commission_transfer"
                                            id="commissionYes" value="yes" {{ old('commission_transfer', 'no') == 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="commissionYes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="commission_transfer"
                                            id="commissionNo" value="no" {{ old('commission_transfer', 'no') == 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="commissionNo">No</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <textarea class="form-control" name="about_yourself"
                                        placeholder="About yourself (Tell us about yourself and why you'd like to join our affiliate program)"
                                        rows="4">{{ old('about_yourself') }}</textarea>
                                </div>

                                {{-- Legal & Compliance --}}
                                <h5 class="mt-4">Legal and compliance</h5>

                                {{-- Terms and Conditions --}}
                                <div class="form-group">
                                    <label class="d-block mb-2"><strong>Terms and Conditions agreement:</strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agree_terms" id="agreeTerms"
                                            required {{ old('agree_terms') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreeTerms">
                                            I have read, understand and agree to <a href="#" target="_blank">Affiliate
                                                Program Terms, Non-compete agreement, & Conditions</a> *
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agree_noncompete"
                                            id="agreeNoncompete" required {{ old('agree_noncompete') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreeNoncompete">
                                            I agree to the terms, non-compete and conditions *
                                        </label>
                                    </div>
                                </div>

                                {{-- Disclosure Agreement --}}
                                <div class="form-group mt-3">
                                    <label class="d-block mb-2"><strong>Disclosure agreement:</strong></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agree_disclosure"
                                            id="agreeDisclosure" required {{ old('agree_disclosure') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreeDisclosure">
                                            I agree to clearly and competitively disclose my affiliate relationship with
                                            [Elite Product Distributors] in all promoters, associations with any
                                            companies/or entities. *
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="agree_promote"
                                            id="agreePromote" required {{ old('agree_promote') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreePromote">
                                            I agree to promote [Elite Product Distributors] on all platforms, social media,
                                            events, etc. *
                                        </label>
                                    </div>
                                </div>

                                {{-- Review and Submission --}}
                                <h5 class="mt-4">Review and submission:</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="printed_name" placeholder="Printed Name *"
                                        required value="{{ old('printed_name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="signature" placeholder="Signature *"
                                        required value="{{ old('signature') }}">
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="application_date" placeholder="Date *"
                                        required min="{{ date('Y-m-d') }}" value="{{ old('application_date') }}">
                                </div>

                                {{-- Password --}}
                                <div class="form-group mt-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password *"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirm Password *" required>
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
    </div>
@endsection

@section('css')
    <style type="text/css">
        .account_form {
            margin: 70px 0px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 1px 0 20px 2px #00000099;
        }

        .account_form form textarea {
            border: 2px solid black;
            border-radius: 10px;
            font-size: 15px;
            color: black;
            height: 150px !important;
            background: transparent;
            font-weight: 600;
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


        .form_head h6 {
            color: black;
            font-weight: 600;
        }

        .account_form h3 {
            color: black;
            margin-bottom: 20px;
        }

        .account_form p {
            color: black;
            font-weight: 600;
            font-size: 14px;
            margin: 18px 0;
        }

        .account_form form input {
            border: 2px solid black;
            border-radius: 10px;
            height: 55px;
            font-size: 15px;
            color: black;
            font-weight: 600;
        }

        .account_form form input::placeholder {
            color: black;
        }

        .account_form form textarea::placeholder {
            color: black;
        }

        .account_form .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .account_form .form-check label {
            margin: 0;
            font-size: 16px;
            color: black;
        }
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click', ".btn1", function (e) {
            $('.loginForm').submit();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Previous Affiliate Marketing Experience
            const experienceYes = document.getElementById('experienceYes');
            const experienceNo = document.getElementById('experienceNo');
            const experienceFields = document.getElementById('experienceFields');

            function toggleExperienceFields() {
                if (experienceYes.checked) {
                    experienceFields.style.display = 'block';
                } else {
                    experienceFields.style.display = 'none';
                }
            }

            experienceYes.addEventListener('change', toggleExperienceFields);
            experienceNo.addEventListener('change', toggleExperienceFields);

            // Social Media Yes/No Toggle Functions
            function createToggleHandler(yesRadioClass, fieldClass) {
                const yesRadios = document.querySelectorAll(`.${yesRadioClass}`);
                const field = document.querySelector(`.${fieldClass}`);

                yesRadios.forEach(radio => {
                    radio.addEventListener('change', function () {
                        if (this.value === 'yes' && this.checked) {
                            field.style.display = 'block';
                        } else {
                            field.style.display = 'none';
                        }
                    });
                });
            }

            // Initialize all social media toggles
            createToggleHandler('instagram-radio', 'instagram-field');
            createToggleHandler('facebook-radio', 'facebook-field');
            createToggleHandler('youtube-radio', 'youtube-field');
            createToggleHandler('tiktok-radio', 'tiktok-field');
            createToggleHandler('other-radio', 'other-field');
            createToggleHandler('competing-radio', 'competing-field');
        });
    </script>
@endsection