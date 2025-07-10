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
                                                        <div class="col-md-12">
                                                            <!-- Attribute Select (Once at the top only) -->
                                                            <div class="mb-3 mainAttributeSelectsec">
                                                                <label><strong>Select Attributes</strong></label>
                                                                <select id="mainAttributeSelect" class="form-control"
                                                                    multiple>
                                                                    @foreach ($att as $attribute)
                                                                        <option value="{{ $attribute->id }}"
                                                                            data-values='@json($attribute->values)'>
                                                                            {{ $attribute->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Variation Blocks Container -->
                                                            <div id="variationBlocksContainer"></div>

                                                            <!-- Button to Add Variation -->
                                                            <button type="button" class="btn btn-primary mt-3"
                                                                id="addVariationBtn">Add Variation</button>


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
            let variationIndex = 0;
            let selectedAttributes = []; // Track selection order

            // Initialize Select2
            $('#mainAttributeSelect').select2();
            $('.attribute-select').select2();

            // Track selection order on select
            $('#mainAttributeSelect').on('select2:select', function(e) {
                const selectedId = e.params.data.id;

                // Add if not already in the array
                if (!selectedAttributes.includes(selectedId)) {
                    selectedAttributes.push(selectedId);
                }

                rebuildVariationBlocks();
            });

            // Track deselection
            $('#mainAttributeSelect').on('select2:unselect', function(e) {
                const unselectedId = e.params.data.id;

                // Remove from array
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

                // Remove Button
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

                // AJAX requests in order
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
                                let $dropdown = $(`
                                    <div class="form-inline-item">
                                        <label>${attrName}</label>
                                        <select class="form-control mx-2 variation-attribute-select"
                                            name="attribute_values[${blockIndex}][${attrId}]">
                                        </select>
                                    </div>
                                `);

                                dropdowns.push({
                                    order: attrId,
                                    $html: $dropdown,
                                    attrId: attrId
                                });
                                resolve();
                            },
                            error: reject
                        });
                    });
                });

                Promise.all(requests).then(() => {
                    selectedAttributes.forEach(attrId => {
                        const dropdownObj = dropdowns.find(d => d.order == attrId);
                        if (dropdownObj) {
                            $attrValuesContainer.append(dropdownObj.$html);

                            dropdownObj.$html.find('select').select2({
                                ajax: {
                                    url: `{{ url('admin/search-attribute-values') }}/${dropdownObj.attrId}`,
                                    dataType: 'json',
                                    delay: 250,
                                    data: function(params) {
                                        return {
                                            q: params.term,
                                            page: params.page || 1
                                        };
                                    },
                                    processResults: function(data, params) {
                                        params.page = params.page || 1;

                                        return {
                                            results: data.results,
                                            pagination: {
                                                more: data.pagination.more
                                            }
                                        };
                                    },
                                    cache: true
                                },
                                placeholder: 'Select ' + $(
                                    '#mainAttributeSelect option[value="' + dropdownObj
                                    .attrId + '"]').text(),
                                minimumInputLength: 1
                            });
                        }
                    });

                    // Price and other fields
                    const priceSection = `
                        <div class="d-flex flex-wrap gap-2 align-items-end ms-3 mt-3">
                            <div class="form-inline-item">
                                <label>Price</label>
                                <input type="number" step="any" name="price[${blockIndex}]" class="form-control mx-2">
                            </div>
                            <div class="form-inline-item">
                                <label>Qty</label>
                                <input type="number" name="qty[${blockIndex}]" value="1" class="form-control mx-2">
                            </div>
                            <div class="form-inline-item">
                                <label>Image</label>
                                <input type="file" name="var_image[${blockIndex}]" class="form-control mx-2">
                            </div>
                        </div>`;

                    $block.append(
                        $('<div>', {
                            class: 'd-flex justify-content-end'
                        }).append($removeBtn)
                    );

                    $block.append($attrValuesContainer).append(priceSection);
                    $('#variationBlocksContainer').append($block);
                }).catch(error => {
                    console.error('One of the requests failed:', error);
                    alert('An error occurred while loading product variations. Please try again.');
                });
            }
        });
    </script>
@endsection
