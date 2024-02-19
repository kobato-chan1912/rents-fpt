@extends('layouts/layoutMaster')

@section('title', 'Quản lý người dùng')

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

  @include("layouts.dataTable", [ "customSetting" => "ordering: false, searching: true,"])

  <script>
    // Defined Function
    function resetForm() {
      $("#dataForm")[0].reset() // reset form
      $("#offcanvasAdd").html('Thêm người dùng')
      $("#dataForm").attr('action', '');  // define action
      $("#password").attr('required', true)
      $("#email").attr('disabled', false)
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
      let email = element.data('email')
      let role = element.data('role')

      // Append Data
      $("#offcanvasAdd").html(name)
      $("#email").val(email)
      $("#name_user").val(name)
      $("#role").val(role)
      let requestUrl = "/admin/users/" + id;
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
            url: "/admin/users/" + id,
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
          <th>STT</th>
          <th>Tên</th>
          <th>Email</th>
          <th>Role</th>
          <th>Ngày tạo</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
          <tr id="{{$user->id}}">
            <td>{{$key+1}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              @if($user->role==0)
                <div class="badge rounded bg-label-danger">Admin</div>
              @endif

              @if($user->role==1)
                  <div class="badge rounded bg-label-success">Staff</div>
              @endif

                @if($user->role==2)
                  <div class="badge rounded bg-label-success">User</div>
                @endif

            </td>
            <td>{{\Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i')}}</td>
            <td>
              <div class="d-flex align-items-center">
                <a href="javascript:void(0)" onclick="edit($(this))" data-id="{{$user->id}}" data-name="{{$user->name}}"
                   data-email="{{$user->email}}"
                   data-role="{{$user->role}}"
                   data-created="{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i')}}"
                   data-bs-target="#offcanvasForm" data-bs-toggle="offcanvas" class="text-body">
                  <i class="ti ti-edit ti-sm me-2">
                  </i>
                </a>

                @if(Auth::id() !== $user->id)

                  <a href="javascript:void(0)" onclick="deleteEle($(this))" data-id="{{$user->id}}"
                     data-name="{{$user->name}}" class="text-body delete-record">
                    <i class="ti ti-trash ti-sm mx-2">
                    </i>
                  </a>

                @endif

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
            <label class="form-label" for="phone">Email</label>
            <input type="text" class="form-control" id="email" name="email"
                   required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="name_user">Tên</label>
            <input type="text" min="0" class="form-control" id="name_user" name="name"
                   required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="password">Mật khẩu</label>
            <input type="password" placeholder="Bỏ trống nếu không thay đổi" class="form-control" id="password"
                   name="password"
            >
          </div>


          <div class="mb-3">
            <label class="form-label" for="role">Role</label>
            <select class="form-select" name="role" id="role">
              <option value="0">Admin</option>
              <option value="1">Staff</option>
              <option value="2">User</option>
            </select>
          </div>


          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Lưu</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection
