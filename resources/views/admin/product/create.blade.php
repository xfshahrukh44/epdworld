@extends('layouts.app')
@push('before-css')
    <link rel="stylesheet" href="{{ asset('plugins/vendors/dropify/dist/css/dropify.min.css') }}">
    <style>
        button.select2-selection__choice__remove span {
            position: absolute;
            z-index: 0;
            left: -5px;
            top: -5px;
        }

        .attributeRepeaterContainer {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .d-flex {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .form-inline-item {
            display: flex;
            flex-direction: column;
            margin-right: 15px;
            margin-bottom: 10px;
        }

        .form-inline-item label {
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .gap-2 {
            gap: 10px;
        }

        .mainAttributeSelectsec {
            width: 100% !important;
        }

        .mainAttributeSelectsec span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }

        .variationBlock .form-inline-item {
            width: 20%;
        }

        .variationBlock {
            margin-bottom: 40px;
            border: 1px solid #cacfe7;
            padding: 20px;
            border-radius: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            margin: 2px !important;
        }

        .variationBlock select.form-control.mx-2 {
            margin: 0 !important;
        }
    </style>
@endpush
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Product</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Product</li>
                        <li class="breadcrumb-item active">Create New Product</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right">
                <a class="btn btn-info mb-1" href="{{ url('/admin/product') }}">Back</a>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section id="basic-form-layouts">
            <div class="row ">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-form">Product Info</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                {!! Form::open(['enctype' => 'multipart/form-data', 'url' => '/admin/product', 'files' => true]) !!}

                                @include ('admin.product.form')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Information</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="card-text">
                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="alert alert-danger">
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if (Session::has('message'))
                                        <ul>
                                            <li class="alert alert-success">
                                                {{ Session::get('message') }}
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('plugins/vendors/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $(function() {
            $('.dropify').dropify();
        });
        ! function(e, t, r) {
            "use strict";
            r(".repeater-default").repeater(), r(".file-repeater, .contact-repeater").repeater({
                show: function() {
                    r(this).slideDown()
                },
                hide: function(e) {
                    confirm("Are you sure you want to remove this item?") && r(this).slideUp(e)
                }
            })
        }(window, document, jQuery);

        function getval(sel) {
            var globelsel = sel;
            let value = sel.value;

            // alert(value);

            $.ajax({
                url: "{{ route('get-attributes') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    value: value
                },
                success: function(response) {
                    $(globelsel).parent().parent().find('.value').html('');
                    if (response.status) {
                        var html = '';
                        for (var i = 0; i < response.message.length; i++) {
                            html += '<option value="' + response.message[i].id + '">' + response.message[i]
                                .value + '</option>';
                        }
                        $(globelsel).parent().parent().find('.value').html(html);
                    } else {

                    }
                },
            });
        }

        // $(document).ready(function() {

        //     $('.multiSelect').on('change', function() {
        //         console.log('Selected attributes changed');
        //         let selectedAttributes = $(this).val(); // array of selected attribute IDs
        //         let $container = $('#attributeValuesContainer');
        //         $container.empty(); // clear old dropdowns

        //         if (!selectedAttributes || selectedAttributes.length === 0) {
        //             return; // no attribute selected
        //         }

        //         // For each selected attribute, fetch values via AJAX
        //         selectedAttributes.forEach(attrId => {
        //             $.ajax({
        //                 url: `{{ url('admin/get-attribute-values') }}/${attrId}`,  // URL to fetch attribute values
        //                 type: 'GET',
        //                 dataType: 'json',
        //                 success: function(values) {
        //                     if (values.length === 0) return;

        //                     // Find the attribute name text from select options
        //                     let attrName = $(`.multiSelect option[value='${attrId}']`).text();

        //                     // Create the dropdown for attribute values
        //                     let html = `<div class="mb-3">
    //                                     <label for="attribute_values_${attrId}">${attrName}</label>
    //                                     <select class="form-control" name="attribute_values[${attrId}]">
    //                                         <option value="">Select ${attrName}</option>`;

        //                     values.forEach(function(v) {
        //                         html += `<option value="${v.id}">${v.value}</option>`;
        //                     });

        //                     html += `</select></div>`;

        //                     $container.append(html);
        //                 },
        //                 error: function() {
        //                     console.error(`Failed to load values for attribute ${attrId}`);
        //                 }
        //             });
        //         });
        //     });
        // });

        $(document).ready(function() {
            let variationIndex = 0;
            let selectedAttributes = [];

            // Initialize Select2
            $('#mainAttributeSelect').select2();

            $('.attribute-select').select2();

            // When attribute is selected
            $('#mainAttributeSelect').on('change', function() {
                // Always get full list of selected attributes
                selectedAttributes = $('#mainAttributeSelect').select2('val') || [];

                // // Disable selected ones
                // $('#mainAttributeSelect option').each(function() {
                //     const val = $(this).val();
                //     $(this).prop('disabled', selectedAttributes.includes(val));
                // });

                $('#mainAttributeSelect').trigger('change.select2'); // Refresh Select2

                // Reset variation blocks (we build fresh ones every time)
                $('#variationBlocksContainer').empty();
                variationIndex = 0;

                if (selectedAttributes.length > 0) {
                    addVariationBlock();
                }
            });


            // Button click - Add new variation block
            $('#addVariationBtn').on('click', function() {
                if (selectedAttributes.length === 0) {
                    alert('Please select at least one attribute first.');
                    return;
                }
                addVariationBlock();
            });

            function addVariationBlock() {
                const blockIndex = variationIndex++;
                const $block = $('<div>', {
                    class: 'variationBlock'
                });
                const $attrValuesContainer = $('<div>', {
                    class: 'd-flex flex-wrap gap-2 attr-values-container'
                });

                let dropdowns = []; // Store rendered dropdowns with promises

                const requests = selectedAttributes.map(attrId => {
                    return new Promise((resolve, reject) => {
                        $.ajax({
                            url: `{{ url('admin/get-attribute-values') }}/${attrId}`,
                            type: 'GET',
                            dataType: 'json',
                            success: function(values) {
                                const attrName = $(
                                    '#mainAttributeSelect option[value="' + attrId +
                                    '"]').text();
                                let dropdown = `
                                    <div class="form-inline-item">
                                        <label>${attrName}</label>
                                        <select class="form-control mx-2 variation-attribute-select" name="attribute_values[${blockIndex}][${attrId}]">
                                            <option value="">Select ${attrName}</option>`;
                                values.forEach(v => {
                                    dropdown += `<option value="${v.id}">${v.value}</option>`;
                                });
                                dropdown += `</select></div>`;
                                dropdowns.push(dropdown);
                                resolve();
                            },
                            error: reject
                        });
                    });
                });

                Promise.all(requests).then(() => {
                    dropdowns.forEach(html => {
                        $attrValuesContainer.append(html);
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
                <input type="file" name="image[${blockIndex}]" class="form-control mx-2">
            </div>
        </div>`;

                    $block.append($attrValuesContainer).append(priceSection);
                    $('#variationBlocksContainer').append($block);

                    $block.find('.variation-attribute-select').select2();
                });
            }

        });
    </script>
@endpush
