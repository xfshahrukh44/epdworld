@extends('layouts.main')
@section('content')
@section('canonical_tag_href', 'https://epdworld.com/contact')
@section('title', 'Contact Us')
@section('meta_descriptoion', 'EPD World offers stylish product distribution services. Please get in touch with us with any questions, concerns, or suggestions for collaboration.')
<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->




<section class="bginner ContactPage" id="box1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="conta-head">
                    <h1>contact us</h1>
                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
                    <!--    labore et dolore magna aliqua ipsum </p>-->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="COntactinfo" data-aos="fade-up" data-aos-duration="1000">
                    <h5>Fill the Form</h5>
                    <form id="contactform">
                        @csrf
                        <input type="hidden" name="form_name" value="Contact Form Submission">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="innerForm">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" required>
                                    <!--<label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp" required>
                                <label for="exampleInputEmail1">Address</label>
                                <input type="email" class="form-control" aria-describedby="emailHelp" required> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="innerForm">

                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="innerForm">

                                    <label for="exampleInputEmail1">Mobile Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp" required>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="innerForm">
                                    <label for="exampleInputEmail1">Message</label>
                                    <textarea class="form-control" id="notes" name="notes"
                                        rows="8"></textarea>
                                </div>
                                <button class="btn btnShop" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="contactformsresult"></div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection
@section('css')
<style>

.header-with-cover-image {
    background-size: cover;
    background-position: center top;
    width: 100vw;
    margin-left: -50vw;
    left: 50%;
    position: relative;
    min-height: 589px;
    margin-bottom: 0;
}

.caption {
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.caption h1 {
    font-weight: 700;
    margin-bottom: 0;
    text-align: center;
}

.caption .entry-subtitle {
    color: #434343;
    font-size: 1.286em;
    position: relative;
    top: 1.667em;
    text-align: center;
}


</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
