@extends('layouts.app')

@push('before-css')
    <link href="{{ asset('plugins/components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <style>
        .vip-price {
            color: #28a745;
            font-weight: 600;
        }

        .old-price {
            text-decoration: line-through;
            color: #6c757d;
            margin-right: 5px;
        }

        .table th {
            background-color: #f4f5fa;
            color: #333;
            text-transform: uppercase;
            font-size: 13px;
        }

        .vip-input {
            max-width: 130px;
            border-radius: 8px 0 0 8px;
        }

        .apply-btn {
            border-radius: 0 8px 8px 0;
        }
    </style>
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Product Calculation</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Product Calculation</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Product Calculation Info</h4>
                        <div class="text-muted small">Edit calculation fields below and click Save</div>
                    </div>

                    <div class="card-body card-dashboard">
                        <div class="row">
                            <div class="col-md-8">
                                <form method="post" action="{{ route('product.calculation.save') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="markup_percent">Markup %</label>
                                        <input type="number" name="markup_percent" id="markup_percent" step="0.01" min="0"
                                            class="form-control"
                                            value="{{ old('markup_percent', $cfg['markup_percent'] ?? 100) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="affiliate_percent">Affiliate Commission %</label>
                                        <input type="number" name="affiliate_percent" id="affiliate_percent" step="0.01"
                                            min="0" class="form-control"
                                            value="{{ old('affiliate_percent', $cfg['affiliate_percent'] ?? 30) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="tax_percent">Sales Tax %</label>
                                        <input type="number" name="tax_percent" id="tax_percent" step="0.01" min="0"
                                            class="form-control" value="{{ old('tax_percent', $cfg['tax_percent'] ?? 6) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipping_percent">Shipping %</label>
                                        <input type="number" name="shipping_percent" id="shipping_percent" step="0.01"
                                            min="0" class="form-control"
                                            value="{{ old('shipping_percent', $cfg['shipping_percent'] ?? 30) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="processing_percent">Payment Processing Fee %</label>
                                        <input type="number" name="processing_percent" id="processing_percent" step="0.01"
                                            min="0" class="form-control"
                                            value="{{ old('processing_percent', $cfg['processing_percent'] ?? 5) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="maintenance_percent">Maintenance/Administrative %</label>
                                        <input type="number" name="maintenance_percent" id="maintenance_percent" step="0.01"
                                            min="0" class="form-control"
                                            value="{{ old('maintenance_percent', $cfg['maintenance_percent'] ?? 35) }}">
                                    </div>

                                    <button class="btn btn-warning" type="submit"><i class="la la-check-circle"></i>
                                        Save</button>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light">
                                    <ul class="list-unstyled small mb-0">
                                        <li class="mb-2">
                                            <strong>Markup %</strong><br>
                                            The percentage added to the base price to determine the product’s selling price.
                                        </li>

                                        <li class="mb-2">
                                            <strong>Affiliate Commission %</strong><br>
                                            The percentage of profit allocated to affiliates for promoting or selling the
                                            product.
                                        </li>

                                        <li class="mb-2">
                                            <strong>Sales Tax %</strong><br>
                                            The percentage of tax applied on the total price after commissions and markups.
                                        </li>

                                        <li class="mb-2">
                                            <strong>Shipping %</strong><br>
                                            The percentage added to cover shipping and handling costs.
                                        </li>

                                        <li class="mb-2">
                                            <strong>Processing Fee %</strong><br>
                                            The percentage charged for payment gateway or transaction processing.
                                        </li>

                                        <li class="mb-0">
                                            <strong>Maintenance / Admin %</strong><br>
                                            The percentage added for administrative, maintenance, or operational overhead
                                            costs.
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('plugins/components/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#productTable').DataTable({
                pageLength: 10,
                ordering: false
            });
        });
    </script>
@endpush