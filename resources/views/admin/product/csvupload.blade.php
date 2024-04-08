@extends('layouts.app')
@push('before-css')
    <link rel="stylesheet" href="{{asset('plugins/vendors/dropify/dist/css/dropify.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!--Toaster Popup message CSS -->
  <link href="{{asset('plugins/vendors/toast-master/css/jquery.toast.css')}}" rel="stylesheet">

@endpush
@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                    <div class="card-body">
                        <h3 class="box-title pull-left">Upload Product CSV</h3>

                        <div class="clearfix"></div>
                        <hr>
                        <div class="csvupload">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="csvupload" id="csvupload" class="form-control dropify">
                                <input type="submit" value="Upload CSV" class="btn btn-primary mt-5">
                            </form>
                        </div>
                        {{-- <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>
                            <tr><th> Product Title </th><td> {{ $product->product_title }} </td></tr><tr><th> Description </th><td> {{ $product->description }} </td></tr>
                            </tbody>
                        </table>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')

<script src="{{asset('plugins/vendors/dropify/dist/js/dropify.min.js')}}"></script>
<!-- Popup message jquery -->
<script src="{{asset('plugins/vendors/toast-master/js/jquery.toast.js')}}"></script>
<script>
    $(function() {
          $('.dropify').dropify();
      });
</script>
  @endpush
