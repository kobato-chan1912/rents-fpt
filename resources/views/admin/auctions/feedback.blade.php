@extends('layouts/layoutMaster')

@section('title', "Feedback $auction->title")
@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

@endsection
@section('page-script')
  @include("layouts.sweetAlertInfo")
  <script src="{{asset('assets/js/forms-selects.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  @include("layouts.dataTable-no-button")
  <script>
    $(document).ready(function () {
      $('.rateYo').rateYo({
        starWidth: "20px"
      });
    });
  </script>
@endsection


@section('content')

  <div class="row">

    @include("admin.auctions.navbar")

    <!-- Form controls -->


    <div class="content">

      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-datatable table-responsive">
              <table class="datatable table nowrap border-top">
                <thead>
                <tr>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Số sao</th>
                  <th>Nội dung</th>
                  <th>Ngày tạo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($auction->feedback as $feedback)
                  <tr id="{{$feedback->id}}">
                    <td>{{$feedback->user->name}}</td>
                    <td>{{$feedback->user->email}}</td>
                    <td>
                      <div class="rateYo" data-rateyo-read-only="true" data-rateyo-num-stars="5" data-rateyo-rating="{{$feedback->star}}"></div>

                    </td>
                    <td>{!! nl2br($feedback->content) !!}</td>
                    <td>{{\Carbon\Carbon::parse($feedback->created_at)->format('H:i d/m/Y')}}</td>
                  </tr>

                @endforeach
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- Input Sizing -->


  </div>
@endsection
