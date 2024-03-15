@extends("layouts-webpage.master")
@section("content")
  <div class="container">
    <table class="table">

      <h6>Lịch sử mua ngay người dùng {{Auth::user()->email}}</h6>
      <thead class="thead-dark">
      <tr>
        <th scope="col" class="text-center">Mã mua</th>
        <th scope="col">BĐS đấu</th>
        <th scope="col" class="text-center">Tổng cộng</th>
        <th scope="col" class="text-center">Trạng thái</th>
      </tr>
      </thead>
      <tbody>
      @foreach($historyBuy as $buy)
        <tr>
          <td class="text-center">#{{$buy->id}}</td>
          <td><a href="/auction/{{$buy->auction->id}}">{{$buy->auction->title}}</a></td>
          <td class="text-center">
            {{number_format($buy->price)}} <br>

          </td>
          <td class="text-center">
            @if($buy->paid_status == 'paid')
              <span class="badge badge-success">Thành công</span>
            @endif
            @if($buy->paid_status == "refund")
              <span class="badge badge-warning">Refund</span>
            @endif
          </td>

        </tr>

      @endforeach
      </tbody>
    </table>

  </div>




@endsection
@section("page-script")
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function donePay(aucId, bidId){
      Swal.fire({
        title: "Bạn chắc chứ?",
        text: "Bạn đang thanh toán số tiền còn lại!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Đúng vậy!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/auction/${aucId}/bid/${bidId}/donePay`,
            type: "post",
            data: {
              // _token: $('meta[name="csrf-token"]').attr('content')
              _token: '{{csrf_token()}}'
            },
            success: function (response) {
              if (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Thành công!',
                  text: 'Thanh toán thành công!',
                  customClass: {
                    confirmButton: 'btn btn-warning'
                  },
                  buttonsStyling: false
                }).then(function(){
                    location.reload();
                  }
                );

              }
            },
          })
        }
      });

    }
  </script>

@endsection
