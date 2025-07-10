<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $favicon = DB::table('imagetable')->where('table_name', 'favicon')->first();
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Mintone">
    <meta name="author" content="Admin Mintone">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset(!empty($favicon->img_path) ? $favicon->img_path : '') }}">
    <title>{{ config('app.name') }}</title>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.min.css') }}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.min.css') }}">
    <!-- END: Theme CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/palette-gradient.min.css') }}">
    <!-- END: Page CSS-->
    <link href="{{ asset('plugins/vendors/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/vendors/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @stack('before-css')
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <!-- Custom CSS -->
    <!-- <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> -->
    <!-- <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('after-css')

</head>


<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css')}} -->
    <!-- ============================================================== -->
    @include('layouts.admin.header')

    @include('layouts.admin.sidebar')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    @include('layouts.admin.footer')

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/app-menu.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->
    <!-- script src="{{ asset('plugins/vendors/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/vendors/jquery/spartan-multi-image-picker.min.js') }}"></script>
        <script src="{{ asset('plugins/vendors/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/vendors/ps/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('assets/js/custom.min.js') }}"></script>
        <script src="{{ asset('plugins/vendors/toast-master/js/jquery.toast.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/edituser.js') }}"></script> -->

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



        <script>
            if ($('#summary-ckeditor').length != 0) {
                CKEDITOR.replace('summary-ckeditor');
            }
            if ($('#summary-ckeditor1').length != 0) {
                CKEDITOR.replace('summary-ckeditor1');
            }
            if ($('#summary-ckeditor2').length != 0) {
                CKEDITOR.replace('summary-ckeditor2');
            }
        </script>



        <script>
            $(document).ready(function() {

                @if (\Session::has('message'))
                    $.toast({
                        heading: 'Success!',
                        position: 'top-center',
                        text: '{{ session()->get('message') }}',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3000,
                        stack: 6
                    });
                @endif


                @if (\Session::has('flash_message'))
                    $.toast({
                        heading: 'Info!',
                        position: 'top-center',
                        text: '{{ session()->get('flash_message') }}',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3000,
                        stack: 6
                    });
                @endif


            });
        </script>

        <script>
            $(document).ready(function() {
                $('.multiSelect').select2({
                    placeholder: "Add Variation",
                    width: '100%'
                });

                // Existing onchange logic yahan aa jaye...
            });

        </script>



        <script>
            // $(document).ready(function() {
            //     initVariation($('.variation-block').first());

            //     $('#addVariationBtn').on('click', function() {
            //         let newBlock = $('.variation-block').first().clone();

            //         newBlock.find('.select2').remove();
            //         newBlock.find('.multiSelect').removeAttr('data-select2-id').removeClass(
            //             'select2-hidden-accessible').show();

            //         newBlock.find('.attributeRepeaterContainer').empty();
            //         newBlock.find('.multiSelect').val(null);

            //         $('#variationsWrapper').append(newBlock);

            //         initVariation(newBlock);
            //     });

            //     function initVariation(container) {
            //         if (!container.data('selectedAttributes')) {
            //             container.data('selectedAttributes', new Set());
            //         }

            //         const selectedAttributes = container.data('selectedAttributes');
            //         const select = container.find('.multiSelect');
            //         const repeater = container.find('.attributeRepeaterContainer');

            //         select.select2({
            //             placeholder: "Select attributes",
            //             width: '100%'
            //         });

            //         select.on('change', function() {
            //             const selectedOptions = $(this).find('option:selected');

            //             selectedOptions.each(function() {
            //                 const attrId = $(this).val();
            //                 const attrName = $(this).text();

            //                 if (!selectedAttributes.has(attrId)) {
            //                     selectedAttributes.add(attrId);
            //                     appendAttributeBlock(attrId, attrName, repeater);
            //                 }
            //             });

            //             // Remove unselected
            //             selectedAttributes.forEach(attrId => {
            //                 if (!select.find(`option[value="${attrId}"]`).is(':selected')) {
            //                     repeater.find(`.attribute-block[data-id="${attrId}"]`).remove();
            //                     selectedAttributes.delete(attrId);
            //                 }
            //             });
            //         });
            //     }


            //     function appendAttributeBlock(attrId, attrName, container) {
            //         $.ajax({
            //             url: "{{ url('admin/get-attribute-values') }}/" + attrId,
            //             method: 'GET',
            //             success: function(values) {
            //                 let valueOptions = values.map(val =>
            //                     `<option value="${val.id}">${val.value}</option>`
            //                 ).join('');

            //                 let block = `
            //     <div class="attribute-block d-inline-block mx-2" data-id="${attrId}" style="vertical-align: top; width: 300px;">
            //         <div class="form-group">
            //             <label>Value (${attrName})</label>
            //             <select name="attribute[${attrId}][value]" class="form-control">
            //                 ${valueOptions}
            //             </select>
            //         </div>
            //         <div class="form-group">
            //             <label>Price</label>
            //             <input type="number" step="any" name="attribute[${attrId}][price]" class="form-control">
            //         </div>
            //         <div class="form-group">
            //             <label>Qty</label>
            //             <input type="number" name="attribute[${attrId}][qty]" class="form-control">
            //         </div>
            //         <div class="form-group">
            //             <label>Image</label>
            //             <input type="file" name="attribute[${attrId}][image]" class="form-control">
            //         </div>
            //         <div class="form-group text-end">
            //             <button type="button" class="btn btn-danger btn-sm removeAttrBtn mt-1">Delete</button>
            //         </div>
            //     </div>`;

            //                 container.append(block);
            //             },
            //             error: function() {
            //                 alert('Unable to fetch values for attribute ID ' + attrId);
            //             }
            //         });
            //     }


            //     // ✅ Remove block manually
            //     $(document).on('click', '.removeAttrBtn', function() {
            //         $(this).closest('.attribute-block').remove();
            //     });
            // });
        </script>


        <script>
            // $('#addVariationBtn').on('click', function() {
            //     $('#multiSelect').val(null).trigger('change');
            // });
        </script>


        {{-- <script type="text/javascript">
            $(document).ready(function() {
                $("#e1").select2();
            });
        </script> --}}

        <!--<script type="text/javascript">
            -- >
            <
            !--$(document).ready(function() {
                $("#e2").select2();
            });
            -- >
            <
            !--
        </script>-->

        <!-- ============================================================== -->
        @stack('js')

</body>

</html>
