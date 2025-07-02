@extends('layouts.main')
@section('title', 'Order')
@section('content')

    <?php $segment = Request::segments(); ?>


    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-wrapper inner-banner-wrapper">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="section-heading text-center">
                                    <h1>Products</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <main class="my-cart">

        <!-- my account wrapper start -->
        <div class="my-account-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                @include('account.sidebar')
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">

                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane show active" id="orders" role="#">
                                            <div class="myproductform">
                                                <form
                                                    action="{{ $data == null ? route('storeproduct') : route('updateproduct', $data->id) }}"
                                                    enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="title">Select Category</label>
                                                                @php
                                                                    $category = App\Category::all();
                                                                @endphp
                                                                <select name="category" class="form-control" id="">
                                                                    @foreach ($category as $item)
                                                                        <option
                                                                            {{ $data->category == $item->id ? 'selected' : '' }}
                                                                            value="{{ $item->id }}">{{ $item->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>





                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="title">Product Title</label>
                                                                <input type="text" name="product_title"
                                                                    class="form-control" value="{{ $data->product_title }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="title">Price</label>
                                                                <input type="number" name="price" step='0.01'
                                                                    placeholder='5.00' class="form-control"
                                                                    value="{{ $data->price }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea name="description" value="{{ $data->description }}" id="ckedtior" cols="30" rows="10">{!! $data->description !!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="description">Image</label>
                                                                <input id="demo" type="file" class="dropify"
                                                                    name="image"
                                                                    {{ $data->image != '' ? "data-default-file = /$data->image" : '' }}
                                                                    {{ $data->image == '' ? 'required' : '' }}
                                                                    value="{{ $data->image }}" required>


                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">

                                                                <label for="description">Gallary Image</label>
                                                                <div class="gallery Images">
                                                                    @foreach ($product_images as $product_image)
                                                                        <div class="image-single">
                                                                            <img src="{{ asset($product_image->image) }}"
                                                                                alt="" id="image_id">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-repeater-delete=""
                                                                                onclick="getInputValue({{ $product_image->id }}, this);">
                                                                                <i class="ft-x"></i>Delete</button>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <input class="form-control dropify" name="images[]"
                                                                    type="file" id="images"
                                                                    {{ $product->additional_image != '' ? "data-default-file = /$product->additional_image" : '' }}
                                                                    value="{{ $product->additional_image }}" multiple>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <h4 class="card-title" id="repeat-form">Add Variation</h4>
                                                        </div>
                                                        @foreach ($product->attributes as $pro_att_edits)
                                                            <div class="col-md-12">
                                                                <div data-repeater-list="attribute">
                                                                    <div data-repeater-item="" class="row">
                                                                        <input type="hidden"
                                                                            value="{{ $pro_att_edits->id }}"
                                                                            name="product_attribute[]">
                                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                            <label for="email-addr">Attribute</label>
                                                                            <br>
                                                                            <select class="form-control" id="attribute_id"
                                                                                name="attribute_id[]"
                                                                                onchange="getval(this)" disabled>
                                                                                <option
                                                                                    value="{{ $pro_att_edits->attribute_id }}">
                                                                                    {{ $pro_att_edits->attribute->name }}
                                                                                </option>
                                                                                <!-- @foreach ($att as $atts)
    <option value="{{ $atts->id }}">{{ $atts->name }}</option>
    @endforeach -->
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                            <label for="pass">value</label>
                                                                            <br>
                                                                            <select class="form-control value"
                                                                                id="value" name="value[]" disabled>
                                                                                <option
                                                                                    value="{{ $pro_att_edits->value }}">
                                                                                    {{ $pro_att_edits->attributesValues->value }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                            <label for="bio"
                                                                                class="cursor-pointer">Price</label>
                                                                            <br>
                                                                            <input type="number" name="v_price[]"
                                                                                class="form-control" id="price"
                                                                                value="{{ $pro_att_edits->price }}">
                                                                        </div>
                                                                        <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                            <label for="bio"
                                                                                class="cursor-pointer">qty</label>
                                                                            <br>
                                                                            <input type="number" name="qty[]"
                                                                                class="form-control" id="qty"
                                                                                value="{{ $pro_att_edits->qty }}">
                                                                        </div>
                                                                        <div
                                                                            class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                            <button
                                                                                onclick="deleteAttr({{ $pro_att_edits->id }}, this)"
                                                                                type="button" class="btn btn-danger"
                                                                                data-repeater-delete=""> <i
                                                                                    class="ft-x"></i>
                                                                                Delete</button>
                                                                        </div>

                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="repeater-default col-md-12">
                                                            <div data-repeater-list="attribute">
                                                                <div data-repeater-item="" class="row">

                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label for="email-addr">Attribute</label>
                                                                        <br>
                                                                        <select class="form-control" id="attribute_id"
                                                                            name="attribute_id" onchange="getval(this)">
                                                                            @foreach ($att as $atts)
                                                                                <option value="{{ $atts->id }}">
                                                                                    {{ $atts->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-3">
                                                                        <label for="pass">value</label>
                                                                        <br>
                                                                        <select class="form-control value" id="value"
                                                                            name="value">

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                        <label for="bio"
                                                                            class="cursor-pointer">Price</label>
                                                                        <br>
                                                                        <input type="number" name="v-price"
                                                                            class="form-control" id="price"
                                                                            value="{{ $pro_att_edits->attributesValues->price }}">
                                                                    </div>
                                                                    <div class="form-group mb-1 col-sm-12 col-md-2">
                                                                        <label for="bio"
                                                                            class="cursor-pointer">qty</label>
                                                                        <br>
                                                                        <input type="number" name="qty"
                                                                            class="form-control" id="qty">
                                                                    </div>
                                                                    <div
                                                                        class="form-group col-sm-12 col-md-2 text-center mt-2">
                                                                        <label for="bio"
                                                                            class="cursor-pointer">Action</label>
                                                                        <br>
                                                                        <button type="button"
                                                                            class="btn btn-danger att-del"
                                                                            data-repeater-delete=""> <i
                                                                                class="ft-x"></i>
                                                                            Delete</button>
                                                                    </div>

                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <div class="form-group overflow-hidden">
                                                                <div class="">
                                                                    <button type="button" data-repeater-create=""
                                                                        class="btn btn-primary att-add">
                                                                        <i class="ft-plus"></i> Add
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button class="btn btn-green"
                                                                    type="submit">{{ $data == null ? 'Save' : 'Update' }}</button>
                                                            </div>
                                                        </div>




                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->


                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->


        <!-- main content end -->
    </main>

@endsection
@section('css')
    <style type="text/css">
        .myaccount-table.table-responsive.text-center {
            margin-top: 30px;
        }

        a.add-new.donate-btn {
            float: right;
            color: white;
            padding: 7px;
            margin-bottom: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .form-group .form-control {
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-top: 5px;
            border-radius: 0;
        }

        .form-group .form-control:focus {
            border: 1px solid #fed700;
        }

        button.btn.btn-green {
            border-radius: 50px;
            width: 25%;
            background: #fed700;
            color: black;
            font-size: 20px;
            margin-top: 14px;
            font-weight: 500;
            padding: 15px 30px;
            float: left !important;
        }

        .gallery.Images {
            display: flex;
            margin-bottom: 45px;
        }

        .image-single {
            height: 100px;
            width: 100px;
        }

        .image-single img {
            width: 100%;
            height: 100%;
        }

        .image-single button {
            padding: 5px;
            margin-top: 10px;
            border-radius: 0px;
            background: red;
            color: #fff;
        }

        .att-del {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            padding: 8px 6px;
            width: 65%;
            margin-top: 6px;
            background: red;
            color: #fff;
        }

        .att-add {
            background: #000;
            color: #fff;
            padding: 10px 35px;
        }

       
    </style>
@endsection
@section('js')
    <script></script>

    <script type="text/javascript">
        $('.dropify').dropify();

        CKEDITOR.replace('ckedtior');

        $(document).on('click', ".btn1", function(e) {
            // alert('it works');
            $('.loginForm').submit();
        });
    </script>
@endsection
