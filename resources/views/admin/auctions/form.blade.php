@extends('layouts/layoutMaster')
@if(isset($auction))
  @section('title', "$auction->title Edit")
@else
  @section('title', "Thêm phiên mới")
@endif
@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>


@endsection
@section('page-script')
  @include("layouts.sweetAlertInfo")
  <script src="{{asset('assets/js/forms-selects.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
  <script src="{{asset('assets/js/slug.js')}}"></script>

  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script>

    CKEDITOR.plugins.addExternal('image2', '/vendor/image2/', 'plugin.js');

    var options = {

      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
      extraPlugins: 'image2'

    };


    CKEDITOR.replace('description', options);


    @if(isset($auction))
    $("#status").val('{{$auction->status}}')
    $("#city_id").val('{{$auction->city_id}}')
    $("#type").val('{{$auction->type}}')
    @endif


    $(document).ready(function () {
      $('#thumbnail_upload').filemanager('image');
      $('#galleries_upload').filemanager('image');




    });




  </script>
@endsection


@section('content')

  <div class="row">

    @include("admin.auctions.navbar")

    <!-- Form controls -->



    <div class="content">
      @if(Request::get("tab") == "info" || !Request::has("tab"))
        <form @if(!isset($auction)) action="/admin/auctions" @else action="/admin/auctions/{{$auction->id}}" @endif method="post">
          @csrf
          <div class="row">

            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="buy_price" class="form-label">Giá mua ngay</label>
                    <input @if(isset($auction)) value="{{$auction->buy_price}}" @endif  type="text" class="form-control" id="buy_price" name="buy_price" placeholder="Giá mua ngay"/>
                  </div>
                  <div class="mb-3">
                    <label for="start_price" class="form-label">Giá khởi điểm</label>
                    <input @if(isset($auction)) value="{{$auction->start_price}}" @endif  type="text" class="form-control" id="start_price" name="start_price" placeholder="Giá khởi điểm"/>
                  </div>

                  <div class="mb-3">
                    <label for="jump_price" class="form-label">Bước nhảy</label>
                    <input @if(isset($auction)) value="{{$auction->jump_price}}" @endif  type="text" class="form-control" id="jump_price" name="jump_price" placeholder="Bước nhảy"/>
                  </div>

                  <div class="mb-3">
                    <label for="deadline_time" class="form-label">Thời gian kết thúc</label>
                    <input @if(isset($auction)) value="{{$auction->deadline_time}}" @if($auction->status !== "trading" && $auction->status !== null) disabled @endif @endif  type="datetime-local" class="form-control" id="deadline_time" name="deadline_time" placeholder="Thời gian kết thúc"/>
                  </div>

                  <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-control" name="note" id="note">@if(isset($auction)){{$auction->note}}@endif</textarea>
                  </div>

                </div>
              </div>
              <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Lưu</button>

            </div>



          </div>
        </form>
      @endif



    </div>

    <!-- Input Sizing -->


  </div>
@endsection
