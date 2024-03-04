@extends("layouts-webpage.master")
@section("content")
<div class="container">
  <table class="table">

    <h6>Lịch sử đấu giá của người dùng {{Auth::user()->email}}</h6>
    <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">Mã đấu giá</th>
      <th scope="col">BĐS đấu</th>
      <th scope="col" class="text-center">Trạng thái</th>
      <th scope="col" class="text-center">Tiền cọc</th>
      <th scope="col" class="text-center">Tiền còn lại</th>
      <th scope="col" class="text-center">Tiền phí APP</th>
      <th scope="col" class="text-center">Thanh toán</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bids as $bid)
      <tr @if($bid->is_disable == 1) style="background-color: rgba(139,0,0,0.09)" @endif>
        <td class="text-center">#{{$bid->id}}</td>
        <td><a href="/auction/{{$bid->auction->id}}">{{$bid->auction->title}}</a></td>
        <td class="text-center">
          @if($bid->is_disable == 0)
            @if($bid->auction->status=="trading")
              <span class="badge badge-warning">Đang đấu giá</span>
            @else
              @if($bid->status == 0)
                <span class="badge badge-danger">Không trúng</span>
              @endif
              @if($bid->status == 1)
                <span class="badge badge-success">Trúng thầu</span>
              @endif
            @endif
          @else
            <span class="badge badge-danger">Bị hủy</span>
          @endif

        </td>
        <td class="text-center">

            @if($bid->deposit_status == 0)
              <span class="badge badge-danger">Chưa thanh toán</span>
            @endif
            @if($bid->deposit_status == 1)
              <span class="badge badge-success">Đã thanh toán</span>
            @endif
            @if($bid->deposit_status == 3)
              <span class="badge badge-warning">Refund</span>
            @endif
                <p>
                  {{number_format($bid->deposit_price)}}

                </p>
        </td>
        <td class="text-center">
            @if($bid->remain_status == 0)
              <span class="badge badge-danger">Chưa thanh toán</span>
            @endif
            @if($bid->remain_status == 1)
              <span class="badge badge-success">Đã thanh toán</span>
            @endif
              @if($bid->remain_status == 2)
                <span class="badge badge-warning">Đợi đóng</span>
              @endif
            @if($bid->remain_status == 3)
              <span class="badge badge-warning">Refund</span>
            @endif

              <p>
                {{number_format($bid->remain_price)}}
              </p>

        </td>
        <td class="text-center">
            @if($bid->tax_status == 0)
              <span class="badge badge-danger">Chưa thanh toán</span>
            @endif
            @if($bid->tax_status == 1)
              <span class="badge badge-success">Đã thanh toán</span>
            @endif
              @if($bid->tax_status == 2)
                <span class="badge badge-warning">Đợi đóng</span>
              @endif
            @if($bid->tax_status == 3)
              <span class="badge badge-warning">Refund</span>
            @endif

          <p>
            {{number_format($bid->tax_price)}}

          </p>

        </td>
        <td class="text-center">
          @if($bid->status == 1 && ($bid->tax_status == 2))

            <a href="javascript:void(0)" class="btn btn-primary text-capitalize">
              <i class="fa fa-user mr-1"></i>Thanh toán còn lại </a>

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
