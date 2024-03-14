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
      <th scope="col" class="text-center">Số tiền Bid</th>
      <th scope="col" class="text-center">Cọc</th>
      <th scope="col" class="text-center">Thuế</th>
      <th scope="col" class="text-center">Còn lại</th>
      <th scope="col" class="text-center">Thanh toán</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bids as $bid)
      <tr @if($bid->status == 'cancel') style="background-color: rgba(139,0,0,0.09)" @endif>
        <td class="text-center">#{{$bid->id}}</td>
        <td><a href="/auction/{{$bid->auction->id}}">{{$bid->auction->title}}</a></td>
        <td class="text-center">
          @if($bid->status == null)
            <span class="badge badge-warning">Đang đấu giá</span>
          @endif
          @if($bid->status == "not_won")
            <span class="badge badge-danger">Không trúng</span>
          @endif
          @if($bid->status == "won")
            <span class="badge badge-success">Trúng thầu</span>
          @endif
          @if($bid->status == "waiting")
            <span class="badge badge-warning">Đợi đóng còn lại</span>
          @endif
          @if($bid->status == "cancel")
            <span class="badge badge-danger">Bị hủy</span>
          @endif


        </td>
        <td class="text-center">{{number_format($bid->bid_price)}}</td>
        <td>
          @php $depositStatus = $bid->auction_register->paid_status @endphp
          {{showDepositStatus()[$depositStatus]}} ({{number_format($bid->auction_register->price)}})
        </td>
        <td>
          {{number_format($bid->tax_price)}} <br>
          @if($bid->tax_status == null)
            <span class="badge badge-warning">Đang đấu giá</span>
          @endif

          @if($bid->tax_status == "waiting")
            <span class="badge badge-warning">Đợi thanh toán</span>
          @endif

          @if($bid->tax_status == "paid")
            <span class="badge badge-warning">Đã thanh toán</span>
          @endif

        </td>
        <td>
          {{number_format($bid->remain_price)}} <br>
          @if($bid->remain_status == null)
            <span class="badge badge-warning">Đang đấu giá</span>
          @endif

          @if($bid->remain_status == "waiting")
            <span class="badge badge-warning">Đợi thanh toán</span>
          @endif

          @if($bid->remain_status == "paid")
            <span class="badge badge-warning">Đã thanh toán</span>
          @endif

        </td>
        <td class="text-center">
          @if($bid->status == "won" && $bid->tax_status=="waiting" )

            <a href="/auction/{{$bid->auction->id}}/bid/{{$bid->id}}/payRemain" class="btn btn-primary text-capitalize">
              <i class="fa fa-dollar mr-1"></i>Thanh toán còn lại </a>

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
