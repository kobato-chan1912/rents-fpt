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

    $("form").on('submit', function (e){
        let start_price = $("#start_price").val()
        let buy_price = $("#buy_price").val()
        if (start_price >= buy_price){
          e.preventDefault()
          alert("Giá mua ngay phải lớn hơn giá khởi điểm!")
        }
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
            <div class="col-md-6 mb-4">
              <div class="card h-100 mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input @if(isset($auction)) value="{{$auction->title}}" @endif required type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề"/>
                  </div>
                  <div class="mb-3">
                    <label for="city_id" class="form-label">Thành phố</label>
                    <select class="form-select select2" name="city_id" id="city_id" required>
                      @foreach(\App\Models\City::all() as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                      @endforeach
                    </select>
                  </div>


                  <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input @if(isset($auction)) value="{{$auction->address}}" @endif required type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ"/>
                  </div>


                  <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <div class="input-group">
                      <input @if(isset($auction)) value="{{$auction->thumbnail}}" @endif required type="text" class="form-control" name="thumbnail" id="thumbnail"
                             aria-describedby="thumbnail_upload">
                      <button data-input="thumbnail" data-preview="preview_thumbnail"
                              class="btn btn-outline-primary waves-effect" type="button" id="thumbnail_upload">
                        <i class="tf-icons ti ti-cloud-upload ti-xs me-1"></i>
                        Upload
                      </button>
                    </div>
                    <div class="mt-2" id="preview_thumbnail">
                      @if(isset($auction))
                        <img width="120px" src="{{$auction->thumbnail}}" alt="">
                      @endif
                    </div>
                  </div>


                  <div class="mb-3">
                    <label for="galleries" class="form-label">Thư viện ảnh</label>
                    <div class="input-group">
                      <input @if(isset($auction)) value="{{$auction->galleries}}" @endif required type="text" class="form-control" name="galleries" id="galleries"
                             aria-describedby="galleries_upload">
                      <button data-input="galleries" data-preview="preview_galleries"
                              class="btn btn-outline-primary waves-effect" type="button" id="galleries_upload">
                        <i class="tf-icons ti ti-cloud-upload ti-xs me-1"></i>
                        Upload
                      </button>
                    </div>
                    <div class="mt-2" id="preview_galleries"></div>

                  </div>




                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card h-100 mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="buy_price" class="form-label">Giá mua ngay</label>
                    <input @if(isset($auction)) value="{{$auction->buy_price}}" @endif required type="text" class="form-control" id="buy_price" name="buy_price" placeholder="Giá mua ngay"/>
                  </div>
                  <div class="mb-3">
                    <label for="start_price" class="form-label">Giá khởi điểm</label>
                    <input @if(isset($auction)) value="{{$auction->start_price}}" @endif required type="text" class="form-control" id="start_price" name="start_price" placeholder="Giá khởi điểm"/>
                  </div>

                  <div class="mb-3">
                    <label for="jump_price" class="form-label">Bước nhảy</label>
                    <input @if(isset($auction)) value="{{$auction->jump_price}}" @endif required type="text" class="form-control" id="jump_price" name="jump_price" placeholder="Bước nhảy"/>
                  </div>

                  <div class="mb-3">
                    <label for="deadline_time" class="form-label">Thời gian kết thúc</label>
                    <input @if(isset($auction)) value="{{$auction->deadline_time}}" @if($auction->status !== "trading") disabled @endif @endif  required type="datetime-local" class="form-control" id="deadline_time" name="deadline_time" placeholder="Thời gian kết thúc"/>
                  </div>

                  <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea class="form-control" name="note" id="note">@if(isset($auction)){{$auction->note}}@endif</textarea>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card h-100 mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="area" class="form-label">Diện tích</label>
                    <input @if(isset($auction)) value="{{$auction->area}}" @endif type="number" class="form-control" id="area" name="area" placeholder="Diện tích"/>
                  </div>
                  <div class="mb-3">
                    <label for="count_bathrooms" class="form-label">Số phòng tắm</label>
                    <input @if(isset($auction)) value="{{$auction->count_bathrooms}}" @endif type="number" class="form-control" id="count_bathrooms" name="count_bathrooms" placeholder="Số phòng tắm"/>
                  </div>
                  <div class="mb-3">
                    <label for="count_bedrooms" class="form-label">Số phòng ngủ</label>
                    <input @if(isset($auction)) value="{{$auction->count_bedrooms}}" @endif type="number" class="form-control" id="count_bedrooms" name="count_bedrooms" placeholder="Số phòng ngủ"/>
                  </div>

                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card h-100 mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="count_garage" class="form-label">Số Gara</label>
                    <input @if(isset($auction)) value="{{$auction->count_garage}}" @endif type="number" class="form-control" id="count_garage" name="count_garage" placeholder="Số Gara"/>
                  </div>

                  <div class="mb-3">
                    <label for="area_garage" class="form-label">Diện tích Gara</label>
                    <input @if(isset($auction)) value="{{$auction->area_garage}}" @endif type="number" class="form-control" id="area_garage" name="area_garage" placeholder="Diện tích Gara"/>
                  </div>
                  <div class="mb-3">
                    <label for="year_build" class="form-label">Năm xây dựng</label>
                    <input @if(isset($auction)) value="{{$auction->year_build}}" @endif type="text" class="form-control" id="year_build" name="year_build" placeholder="Năm xây dựng"/>
                  </div>
                  <div class="mb-3">
                    <label for="type" class="form-label">Loại hình</label>
                    <select id="type" name="type" class="form-select">
                      <option value="apartment">Chung cư</option>
                      <option value="mini-apartment">Chung cư mini</option>
                      <option value="townhouse">Nhà phố</option>
                      <option value="ground">Đất nền</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card mb-4">
                <div class="card-body">

                  <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" name="description" id="description"> @if(isset($auction)) {{$auction->description}} @endif</textarea>
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
