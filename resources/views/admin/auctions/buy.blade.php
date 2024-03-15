@extends('layouts/layoutMaster')

@section('title', "Lịch sử mua ngay $auction->title")
@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>

@endsection
@section('page-script')
  @include("layouts.sweetAlertInfo")
  <script src="{{asset('assets/js/forms-selects.js')}}"></script>
  <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  @include("layouts.dataTable-no-button")
@endsection


@section('content')

  <div class="row">

    @include("admin.auctions.navbar")

    <!-- Form controls -->


    <div class="content">

      <!-- Modal -->
      <div class="modal fade" id="resetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="/admin/auctions/{{$auction->id}}/reset" method="post">
            @csrf

            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Reset phiên giao dịch</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="time" class="form-label">Chọn thời gian kết thúc</label>
                    <input required type="datetime-local" id="time" name="time" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Reset</button>

                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                  Đóng
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>


      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-datatable table-responsive">
              <table class="datatable table nowrap border-top">
                <thead>
                <tr>
                  <th>Mã mua</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Số tiền cần thanh toán</th>
                  <th>Trạng thái</th>
                  <th>Ngày mua</th>
                </tr>
                </thead>
                <tbody>
                @foreach($historyBuy as $buy)
                  <tr id="{{$buy->id}}">
                    <td>{{$buy->id}}</td>
                    <td>{{$buy->user->name}}</td>
                    <td>{{$buy->user->email}}</td>
                    <td>{{number_format($buy->price)}}</td>
                    <td>
                      @if($buy->paid_status == "paid")
                        <span class="badge bg-label-success">Đã thanh toán</span>
                      @endif
                      @if($buy->paid_status == "refund")
                        <span class="badge bg-label-danger">Refund</span>
                      @endif



                    </td>

                    <td>{{\Carbon\Carbon::parse($buy->created_at)->format('H:i d/m/Y')}}</td>
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
