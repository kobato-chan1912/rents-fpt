@extends('layouts/layoutMaster')

@section('title', 'Quản lý thành phố')

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
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

  @include("layouts.dataTable", [ "customSetting" => "ordering: false, searching: true,"])

  <script>

    $(document).ready(function () {
      $('#thumbnail_upload').filemanager('image');
    });

    // Defined Function
    function resetForm() {
      $("#dataForm")[0].reset() // reset form
      $("#offcanvasAdd").html('Thêm thành phố')
      $("#dataForm").attr('action', '');  // define action
    }

    // 1. Add Function
    function create() // reset form
    {
      resetForm()
    }

    // 2. Edit function
    function edit(element) {
      resetForm();
      $("#email").attr('disabled', true)
      $("#password").attr('required', false)
      // Get data
      let id = element.data('id')
      let name = element.data('name')
      let thumbnail = element.data('thumbnail')


      // Append Data
      $("#offcanvasAdd").html(name)
      $("#name").val(name)
      $("#thumbnail").val(thumbnail)
      let requestUrl = "/admin/cities/" + id;
      $("#dataForm").attr('action', requestUrl)

    }

    // 3. Delete function
    function deleteEle(element) {
      let id = element.data("id");
      let title = "Thao tác không thể hoàn tác!"
      let name = "Toàn bộ dữ liệu của " + element.data("name") + " sẽ bị xóa!";
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
            url: "/admin/cities/" + id,
            type: "delete",
            data: {
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
              if (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Đã xóa!',
                  text: 'Người dùng đã được xóa thành công!',
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
      <table class="datatable table border-top">
        <thead>
        <tr>
          <th>ID</th>
          <th>Tên</th>
          <th>Thumbnail</th>
          <th>Ngày tạo</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cities as $key => $city)
          <tr id="{{$city->id}}">
            <td>{{$city->id}}</td>
            <td>{{$city->name}}</td>
            <td><img src="{{$city->thumbnail}}" width="100px" alt=""></td>
            <td>{{\Carbon\Carbon::parse($city->created_at)->format('d/m/Y H:i')}}</td>
            <td>
              <div class="d-flex align-items-center">
                <a href="javascript:void(0)" onclick="edit($(this))"
                   data-id="{{$city->id}}"
                   data-name="{{$city->name}}"
                   data-thumbnail="{{$city->thumbnail}}"
                   data-bs-target="#offcanvasForm" data-bs-toggle="offcanvas" class="text-body">
                  <i class="ti ti-edit ti-sm me-2">
                  </i>
                </a>


                  <a href="javascript:void(0)" onclick="deleteEle($(this))" data-id="{{$city->id}}"
                     data-name="{{$city->name}}" class="text-body delete-record">
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
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasForm" aria-labelledby="offcanvasAdd">
      <div class="offcanvas-header">
        <h5 id="offcanvasAdd" class="offcanvas-title"></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="dataForm" method="post" action="">
          @csrf

          <div class="mb-3">
            <label class="form-label" for="name_user">Tên</label>
            <input type="text" min="0" class="form-control" id="name" name="name"
                   required>
          </div>

          <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail</label>
            <div class="input-group">
              <input type="text" class="form-control" name="thumbnail" id="thumbnail"
                     aria-describedby="thumbnail_upload">
              <button data-input="thumbnail" data-preview="preview_thumbnail"
                      class="btn btn-outline-primary waves-effect" type="button" id="thumbnail_upload">
                <i class="tf-icons ti ti-cloud-upload ti-xs me-1"></i>
                Upload
              </button>
            </div>
            <div class="mt-2" id="preview_thumbnail">
            </div>

          </div>




          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Lưu</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection
