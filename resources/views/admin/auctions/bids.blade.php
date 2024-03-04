@extends('layouts/layoutMaster')

@section('title', "Lịch sử đấu giá $auction->title")
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
                  <input required type="datetime-local" id="time" name="time" class="form-control" />
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
                  <th>id</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Giá đấu</th>
                  <th>Trạng thái</th>
                  <th>Cọc</th>
                  <th>Còn lại</th>
                  <th>Phí thuế%</th>
                  <th>Ngày tạo</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bids as $bid)
                  <tr id="{{$bid->id}}" @if($bid->is_disable == 1) style="background-color: rgba(255,4,4,0.07)" @endif>
                    <td>{{$bid->id}}</td>
                    <td>{{$bid->user->name}}</td>
                    <td>{{$bid->user->email}}</td>
                    <td>{{number_format($bid->bid_price)}}</td>
                    <td>
                      @if($bid->is_disable == 0)
                            @if($auction->status=="trading")
                              <span class="badge bg-label-warning">Đang đấu giá</span>
                            @else
                              @if($bid->status == 0)
                                <span class="badge bg-label-danger">Không trúng</span>
                              @endif
                              @if($bid->status == 1)
                                <span class="badge bg-label-success">Trúng thầu</span>
                              @endif
                            @endif
                      @else
                        <span class="badge bg-label-danger">Bị hủy</span>
                      @endif

                    </td>
                    <td>
                      @if($bid->deposit_status == 0)
                        <span class="badge bg-label-danger">Chưa thanh toán</span>
                      @endif
                      @if($bid->deposit_status == 1)
                        <span class="badge bg-label-success">Đã thanh toán</span>
                      @endif
                      @if($bid->deposit_status == 3)
                        <span class="badge bg-label-warning">Refund</span>
                      @endif
                    </td>
                    <td>
                      @if($bid->remain_status == 0)
                        <span class="badge bg-label-danger">Chưa thanh toán</span>
                      @endif
                      @if($bid->remain_status == 1)
                        <span class="badge bg-label-success">Đã thanh toán</span>
                      @endif
                        @if($bid->remain_status == 2)
                          <span class="badge bg-label-warning">Đợi đóng</span>
                        @endif
                      @if($bid->remain_status == 3)
                        <span class="badge bg-label-warning">Refund</span>
                      @endif
                    </td>

                    <td>
                      @if($bid->tax_status == 0)
                        <span class="badge bg-label-danger">Chưa thanh toán</span>
                      @endif
                      @if($bid->tax_status == 1)
                        <span class="badge bg-label-success">Đã thanh toán</span>
                      @endif
                        @if($bid->tax_status == 2)
                          <span class="badge bg-label-warning">Đợi đóng</span>
                        @endif
                      @if($bid->tax_status == 3)
                        <span class="badge bg-label-warning">Refund</span>
                      @endif
                    </td>
                    <td>{{\Carbon\Carbon::parse($bid->created_at)->format('H:i d/m/Y')}}</td>
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
