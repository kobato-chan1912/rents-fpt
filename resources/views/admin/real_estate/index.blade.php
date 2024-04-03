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
              'onclick' : 'window.location.href="/admin/real_estate/create"'
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
      let name = "BĐS " + element.data("name") + " sẽ bị xóa!";
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
          <th>Tên BĐS</th>
          <th>Địa chỉ</th>
          <th>Ngày tạo</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($auctions as $auction)
          <tr id="{{$auction->id}}">
            <td>{{$auction->id}}</td>
            <td>{{$auction->title}} </td>
            <td>{{$auction->address}} </td>
            <td>{{\Carbon\Carbon::parse($auction->created_at)->format('H:i d/m/Y')}}</td>
            <td>
              <div class="d-flex align-items-center">
                <a href="/admin/real_estate/{{$auction->id}}" class="text-body delete-record">
                  <i class="ti ti-edit ti-sm">
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