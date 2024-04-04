@extends('layouts/layoutMaster')

@section('title', 'Quản lý đấu giá')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}"/>
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}"/>

@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>

@endsection

@section('page-script')
  @include("layouts.sweetAlertInfo")

  <script src="{{asset('assets/js/forms-selects.js')}}"></script>
  <script src="{{asset('assets/js/slug.js')}}"></script>

  <script>
    $( document ).ready(function() {
      let dtTable = $(".datatable").DataTable({
        paging: true, searching: true,
        ordering: false,
        dom:
          '<"row me-2"' +
          '<"col-md-2"<"me-3"l>>' +
          '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
          '>t' +
          '<"row mx-2"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        language: {
          sLengthMenu: '_MENU_',
          search: '',
          searchPlaceholder: 'Search..'
        },
        // Buttons with Dropdown
        buttons: [
          {
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Thêm</span>',
            className: 'add-new btn btn-primary mx-3',
            attr: {
              'onclick' : 'window.location.href="/admin/auctions/create"'
            }
          }
        ],




      });
    });
    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);

    function deleteEle(element) {
      let id = element.data("id");
      let title = "Thao tác không thể hoàn tác!"
      let name = "Auction " + element.data("name") + " sẽ bị xóa!";
      Swal.fire({
        title: title,
        icon: 'warning',
        text: name,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Xóa',
        denyButtonText: 'Không',
        customClass: {
          actions: 'my-actions',
          cancelButton: 'order-1 right-gap',
          confirmButton: 'btn btn-success mt-2',
          denyButton: 'btn btn-danger ms-2 mt-2',
        }
      }).then(function (e) {
        e.value
          ?
          $.ajax({
            url: "/admin/auctions/" + id,
            type: "delete",
            data: {
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              if (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Đã xóa!',
                  text: 'Auction đã được xóa thành công!',
                  customClass: {
                    confirmButton: 'btn btn-warning'
                  },
                  buttonsStyling: false
                })
                $("#" + id).remove();
              }
            },
          })

          :
          e.dismiss === Swal.DismissReason.cancel;
      });
    }

  </script>


@endsection


@section('content')
  <!-- Users List Table -->
  <div class="card mb-3">
    <div class="card-datatable table-responsive">
      <table class="datatable nowrap table border-top">
        <thead>
        <tr>
          <th>id</th>
          <th>Tiêu đề</th>
          <th>Giá khởi điểm</th>
          <th>Số người đấu giá</th>
          <th>Giá hiện tại</th>
          <th>Ngày kết thúc</th>
          <th>Trạng thái</th>
          <th>Ngày tạo</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($auctions as $auction)
          <tr id="{{$auction->id}}">
            <td>{{$auction->id}}</td>
            <td>{{$auction->title}} </td>
            <td>{{number_format($auction->start_price)}} </td>
            <td>{{$auction->bids->count()}}</td>
            <td>{{number_format($auction->current_price)}} </td>
            <td>{{ $auction->deadline_time }} </td>
            <td>
              @if($auction->status == "done")
                <span class="badge bg-label-success">Đã hoàn thành</span>
              @endif
              @if($auction->status == "bought")
                <span class="badge bg-label-success">Đã có người mua ngay</span>
              @endif

              @if($auction->status == "trading")
                <span class="badge bg-label-warning">Đang giao dịch</span>
              @endif

              @if($auction->status == "processing")
                <span class="badge bg-label-info">Đang xử lý</span>
              @endif

              @if($auction->status == "cancel")
                <span class="badge bg-label-danger">Hủy bỏ</span>
              @endif

            </td>
            <td>{{\Carbon\Carbon::parse($auction->created_at)->format('H:i d/m/Y')}}</td>
            <td>
              <div class="d-flex align-items-center">
                <a target="_blank" href="/admin/auctions/{{$auction->id}}?tab=info" class="text-body">
                  <i class="ti ti-eye-filled ti-sm me-2">
                  </i>
                </a>
                <a href="javascript:void(0)" onclick="deleteEle($(this))" data-id="{{$auction->id}}" data-name="{{$auction->title}}" class="text-body delete-record">
                  <i class="ti ti-trash ti-sm mx-2">
                  </i>
                </a>

              </div>
            </td>
          </tr>

        @endforeach
        </tbody>

      </table>
    </div>
  </div>
@endsection
