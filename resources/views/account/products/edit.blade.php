@extends('layouts.main')
@section('title', 'Order')

@push('before-css')
    <style>

    </style>
@endpush
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
                                                <form action="{{ route('updateproduct', $data->id) }}"
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
                                                                <input type="number" name="base_price" step='0.01' class="form-control"
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
                                                                {!! Form::label('image', 'Image') !!}
                                                                <input class="form-control dropify" name="image"
                                                                    type="file" id="image"
                                                                    {{ $data->image != '' ? "data-default-file = /$data->image" : '' }}
                                                                    {{ $data->image == '' ? 'required' : '' }}
                                                                    value="{{ $data->image }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                {!! Form::label('additional_image', 'Gallary Image') !!}
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
                                                        <input type="hidden" id="existingVariationCount"
                                                            value="{{ count($variations ?? []) }}">
                                                        <div class="col-md-12">
                                                            <!-- Attribute Select -->
                                                            <div class="mb-3 mainAttributeSelectsec">
                                                                <label><strong>Select Attributes</strong></label>
                                                                <select id="mainAttributeSelect" class="form-control"
                                                                    multiple>
                                                                    @foreach ($attributes as $attribute)
                                                                        <option value="{{ $attribute->id }}"
                                                                            @if (count($variations->pluck('variationValues')->flatten()->where('attribute_id', $attribute->id))) selected @endif>
                                                                            {{ $attribute->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Variation Blocks -->
                                                            <div id="variationBlocksContainer">
                                                                @foreach ($variations as $index => $variation)
                                                                    <div class="variationBlock"
                                                                        id="var-{{ $variation->id }}">
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-variation-btn">Remove</button>
                                                                        </div>
                                                                        <div
                                                                            class="d-flex flex-wrap gap-2 attr-values-container">
                                                                            @foreach ($variation->variationValues as $vValue)
                                                                                <div class="form-inline-item">
                                                                                    <label>{{ $vValue->attribute->name }}</label>
                                                                                    <select
                                                                                        class="form-control mx-2 variation-attribute-select"
                                                                                        name="attribute_values[{{ $index }}][{{ $vValue->attribute_id }}]">
                                                                                        <option value="">Select
                                                                                            {{ $vValue->attribute->name }}
                                                                                        </option>
                                                                                        @foreach ($vValue->attribute->values as $option)
                                                                                            <option
                                                                                                value="{{ $option->id }}"
                                                                                                @if ($option->id == $vValue->attribute_value_id) selected @endif>
                                                                                                {{ $option->value }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>

                                                                        <div
                                                                            class="d-flex flex-wrap gap-2 align-items-end ms-3 mt-3">
                                                                            <div class="form-inline-item">
                                                                                <label>Price</label>
                                                                                <input type="number" step="any"
                                                                                    name="price[{{ $index }}]"
                                                                                    class="form-control mx-2"
                                                                                    value="{{ number_format($variation->price, 2, '.', '') }}">
                                                                            </div>
                                                                            <div class="form-inline-item">
                                                                                <label>Qty</label>
                                                                                <input type="number"
                                                                                    name="qty[{{ $index }}]"
                                                                                    class="form-control mx-2"
                                                                                    value="{{ $variation->qty }}">
                                                                            </div>
                                                                            <div class="form-inline-item">
                                                                                <label>Image</label>
                                                                                <input type="file"
                                                                                    name="var_image[{{ $index }}]"
                                                                                    class="form-control mx-2">
                                                                                @if ($variation->image)
                                                                                    <img src="{{ asset($variation->image) }}"
                                                                                        width="60" height="60"
                                                                                        style="margin-top: 10px;">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            <button type="button" class="btn btn-primary mt-3"
                                                                id="addVariationBtn">Add Variation</button>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <button class="btn btn-green"
                                                                    type="submit">Update</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/dropify/dist/js/dropify.min.js') }}"></script>


    <script type="text/javascript">
        $('.dropify').dropify();

        CKEDITOR.replace('ckedtior');

        $(document).on('click', ".btn1", function(e) {
            // alert('it works');
            $('.loginForm').submit();
        });
    </script>

    <script>
        $(document).ready(function() {
            let variationIndex = parseInt($('#existingVariationCount').val()) ||
                0; // 👈 Start from existing variations
            let selectedAttributes = $('#mainAttributeSelect').val() || []; // 👈 Track selection order

            $('#mainAttributeSelect').select2();
            $('.variation-attribute-select').select2();

            // Event delegation for remove button (create + edit)
            $(document).on('click', '.remove-variation-btn', function() {
                $(this).closest('.variationBlock').remove();
            });

            // Listen to select2:select to track selection order
            $('#mainAttributeSelect').on('select2:select', function(e) {
                const selectedId = e.params.data.id;

                if (!selectedAttributes.includes(selectedId)) {
                    selectedAttributes.push(selectedId);
                }

                rebuildVariationBlocks();
            });

            // Listen to select2:unselect to update selection order
            $('#mainAttributeSelect').on('select2:unselect', function(e) {
                const unselectedId = e.params.data.id;

                selectedAttributes = selectedAttributes.filter(id => id !== unselectedId);

                rebuildVariationBlocks();
            });

            // Button click - Add new variation block
            $('#addVariationBtn').on('click', function() {
                if (selectedAttributes.length === 0) {
                    alert('Please select at least one attribute first.');
                    return;
                }
                addVariationBlock();
            });

            function rebuildVariationBlocks() {
                $('#variationBlocksContainer').empty();
                variationIndex = 0;

                if (selectedAttributes.length > 0) {
                    addVariationBlock();
                }
            }

            function addVariationBlock() {
                const blockIndex = variationIndex++;
                const $block = $('<div>', {
                    class: 'variationBlock position-relative border p-3 mb-3 rounded'
                });

                const $removeBtn = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger btn-sm position-absolute top-0 end-0 m-2',
                    text: 'Remove',
                    click: function() {
                        $block.remove();
                    }
                });

                const $attrValuesContainer = $('<div>', {
                    class: 'd-flex flex-wrap gap-2 attr-values-container'
                });
                let dropdowns = [];

                const requests = selectedAttributes.map(attrId => {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: `{{ url('admin/get-attribute-values') }}/${attrId}`,
                            type: 'GET',
                            dataType: 'json',
                            success: function(values) {
                                if (values.length === 0) {
                                    // 🚫 Skip attributes with no values
                                    resolve(); // Do not add dropdown for this attribute
                                    return;
                                }
                                const attrName = $(
                                    '#mainAttributeSelect option[value="' + attrId +
                                    '"]').text();
                                let dropdown = `
                                    <div class="form-inline-item">
                                        <label>${attrName}</label>
                                        <select class="form-control mx-2 variation-attribute-select" name="attribute_values[${blockIndex}][${attrId}]">
                                            <option value="">Select ${attrName}</option>`;
                                values.forEach(v => {
                                    dropdown +=
                                        `<option value="${v.id}">${v.value}</option>`;
                                });
                                dropdown += `</select></div>`;
                                dropdowns.push({
                                    order: attrId,
                                    html: dropdown
                                }); // Store with order
                                resolve();
                            },
                            error: reject
                        });
                    });
                });

                Promise.all(requests).then(() => {
                    // Append dropdowns in selection order
                    selectedAttributes.forEach(attrId => {
                        const dropdownObj = dropdowns.find(d => d.order == attrId);
                        if (dropdownObj) {
                            $attrValuesContainer.append(dropdownObj.html);
                        }
                    });

                    const priceSection = `
                        <div class="d-flex flex-wrap gap-2 align-items-end ms-3 mt-3">
                            <div class="form-inline-item">
                                <label>Price</label>
                                <input type="number" step="any" name="price[${blockIndex}]" class="form-control mx-2">
                            </div>
                            <div class="form-inline-item">
                                <label>Qty</label>
                                <input type="number" name="qty[${blockIndex}]" class="form-control mx-2">
                            </div>
                            <div class="form-inline-item">
                                <label>Image</label>
                                <input type="file" name="var_image[${blockIndex}]" class="form-control mx-2">
                            </div>
                        </div>`;

                    $block.append($('<div>', {
                        class: 'd-flex justify-content-end'
                    }).append($removeBtn));
                    $block.append($attrValuesContainer).append(priceSection);
                    $('#variationBlocksContainer').append($block);

                    $block.find('.variation-attribute-select').select2();
                });
            }
        });
    </script>
@endsection
