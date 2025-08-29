@extends('layouts.app')

@push('before-css')
    <link href="{{ asset('plugins/components/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">

        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-5 text-uppercase">Affiliate Registration Details</h5>

                    <div class="table-responsive">
                        <table class="table m-b-5 m-t-20">
                            <tbody>
                                <tr>
                                    <td class="text-muted">First Name:</td>
                                    <td class="text-color">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email:</td>
                                    <td class="text-color">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Phone:</td>
                                    <td class="text-color">{{ $user->profile->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Company Name:</td>
                                    <td class="text-color">{{ $user->profile->company_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Social Media:</td>
                                    <td class="text-color">
                                        @if (!empty($user->profile->social_media))
                                            {{ implode(', ', json_decode($user->profile->social_media, true)) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Competing Brands:</td>
                                    <td class="text-color">{{ $user->profile->competing_brands ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Hear About Us:</td>
                                    <td class="text-color">{{ $user->profile->hear_about ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Payment Method:</td>
                                    <td class="text-color">{{ $user->profile->payment_method ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Why Join:</td>
                                    <td class="text-color">{{ $user->profile->why_join ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Affiliate Experience:</td>
                                    <td class="text-color">{{ $user->profile->affiliate_experience ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Number of Years:</td>
                                    <td class="text-color">{{ $user->profile->experience_details ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Types of Products:</td>
                                    <td class="text-color">{{ $user->profile->experience_details2 ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">About Yourself:</td>
                                    <td class="text-color">{{ $user->profile->about_yourself ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Signature:</td>
                                    <td class="text-color">{{ $user->profile->signature ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Application Date:</td>
                                    <td class="text-color">{{ $user->profile->application_date ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status:</td>
                                    <td class="text-color">
                                        @if ($user->is_approved == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($user->is_approved == 1)
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Column -->

    </div>
@endsection



@push('js')
    <script src="{{ asset('plugins/components/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('plugins/components/datatables/jquery.dataTables.min.js') }}"></script>
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
        })

        $(function() {
            $('.zero-configuration').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>
@endpush
