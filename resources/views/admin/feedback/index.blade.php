@extends('layouts/layoutMaster')

@section('title', "Lịch sử Feedback")
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

      $(".feedback").on('change', function (){
        let isShow = 0;
        if (this.checked){
          isShow = 1;
        }

        let id = $(this).data("id")

        $.ajax({
          url: "/admin/feedback/" + id + "/updateShow",
          type: "post",
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            is_show: isShow,
          }
        })

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
                  <th>Tên BĐS</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Số sao</th>
                  <th>Nội dung</th>
                  <th>Ngày tạo</th>
                  <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($feedback as $fb)
                  <tr id="{{$fb->id}}">
                    <td><a href="/auction/{{$fb->auction->id}}">{{$fb->auction->title}}</a></td>
                    <td>{{$fb->user->name}}</td>
                    <td>{{$fb->user->email}}</td>
                    <td>
                      <div class="rateYo" data-rateyo-read-only="true" data-rateyo-num-stars="5" data-rateyo-rating="{{$fb->star}}"></div>

                    </td>
                    <td>{!! nl2br($fb->content) !!}</td>
                    <td>{{\Carbon\Carbon::parse($fb->created_at)->format('H:i d/m/Y')}}</td>
                    <td>
                      <div class="form-check form-check-primary">
                        <input class="form-check-input feedback" type="checkbox" data-id="{{$fb->id}}"  id="show-{{$fb->id}}" @if($fb->is_show == 1) checked="" @endif>
                        <label class="form-check-label" for="show-{{$fb->id}}"> Hiện </label>
                      </div>
                    </td>
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
