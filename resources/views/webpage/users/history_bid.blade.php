@extends("layouts-webpage.master")
@section("content")
<div class="container">
  <table class="table">
    <thead class="thead-dark">
    <tr>
      <th scope="col">Mã đấu giá</th>
      <th scope="col">BĐS đấu</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Số tiền cọc</th>
      <th scope="col">Tiền còn lại</th>
      <th scope="col">Tiền phí APP</th>
      <th scope="col">Thanh toán</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bids as $bid)
      <tr>
        <td>{{$bid->id}}</td>
        <td><a href="/auction/{{$bid->auction->id}}">{{$bid->auction->title}}</a></td>
        <td>
          @if($bid->auction->status=="trading")
            <span class="badge bg-warning">Đang đấu giá</span>
          @else
            @if($bid->status == 0)
              <span class="badge bg-danger">Không trúng</span>
            @endif
            @if($bid->status == 1)
              <span class="badge bg-success">Trúng thầu</span>
            @endif
          @endif
        </td>
        <td>
          {{number_format($bid->deposit_price)}}
          <p>
            @if($bid->deposit_status == 0)
              <span class="badge bg-danger">Chưa thanh toán</span>
            @endif
            @if($bid->deposit_status == 1)
              <span class="badge bg-success">Đã thanh toán</span>
            @endif
            @if($bid->deposit_status == 3)
              <span class="badge bg-warning">Refund</span>
            @endif
          </p>
        </td>
        <td>
          {{number_format($bid->remain_price)}}
          <p>
            @if($bid->remain_status == 0)
              <span class="badge bg-danger">Chưa thanh toán</span>
            @endif
            @if($bid->remain_status == 1)
              <span class="badge bg-success">Đã thanh toán</span>
            @endif
              @if($bid->remain_status == 2)
                <span class="badge bg-warning">Đợi đóng</span>
              @endif
            @if($bid->remain_status == 3)
              <span class="badge bg-warning">Refund</span>
            @endif
          </p>
        </td>
        <td>
          {{number_format($bid->tax_price)}}
          <p>
            @if($bid->tax_status == 0)
              <span class="badge bg-danger">Chưa thanh toán</span>
            @endif
            @if($bid->tax_status == 1)
              <span class="badge bg-success">Đã thanh toán</span>
            @endif
              @if($bid->tax_status == 2)
                <span class="badge bg-warning">Đợi đóng</span>
              @endif
            @if($bid->tax_status == 3)
              <span class="badge bg-warning">Refund</span>
            @endif
          </p>
        </td>
        <td>
          @if($bid->status == 1 && ($bid->tax_status == 2))
          <a href="javascript:void(0)" onclick="donePay({{$bid->auction->id}} ,{{$bid->id}})">Thanh toán còn lại</a>
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
