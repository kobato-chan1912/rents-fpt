@extends("webpage.auctions.layouts")
@section("custom_body")
  <div class="face modal" tabindex="-1" role="dialog" id="calculate_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bạn đang tiến hành đấu giá</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Để đấu giá, bạn sẽ thanh toán khoản phí là 10% cọc.</p>
          <p>Nếu bạn trúng thầu, bạn sẽ thanh toán thêm tiền phí cho app như bên dưới và 90% số tiền còn lại.
          </p>
          <p>Nếu bạn không trúng thầu, bạn sẽ được hoàn lại tiền cọc.</p>

          <table class="table table-bordered text-center">
            <thead>
            <tr>
              <th scope="col">Mốc trúng thầu</th>
              <th scope="col">Số tiền cần trả</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1 tỷ < 3 tỷ</td>
              <td>3.00%</td>
            </tr>
            <tr>
              <td>3 tỷ < 5 tỷ</td>
              <td>2.50%</td>
            </tr>
            <tr>
              <td>5 tỷ < 10 tỷ</td>
              <td>2.25%</td>
            </tr>
            <tr>
              <td>10 tỷ < 15 tỷ</td>
              <td>2.00%</td>
            </tr>
            <tr>
              <td>> 15 tỷ < 25 tỷ  </td>
              <td>1.75%</td>
            </tr>
            <tr>
              <td>> 25 tỷ < 35 tỷ  </td>
              <td>1.50%</td>
            </tr>
            <tr>
              <td>> 35 tỷ < 45 tỷ  </td>
              <td>1.0%</td>
            </tr>
            <tr>
              <td>> 45 tỷ < 60 tỷ  </td>
              <td>0.75%</td>
            </tr>
            <tr>
              <td>Trên 60 tỷ  </td>
              <td>0.5%</td>
            </tr>

            </tbody>
          </table>
          <p>
            Số tiền bạn cần cọc vào lúc này là: <span
              style="font-weight: bold; color: red;" id="deposit_now">0</span>
          </p>
{{--          <p>--}}
{{--            Số tiền bạn sẽ trả sau khi trúng thầu là: <span--}}
{{--              style="font-weight: bold; color: red;" id="after_pay">0</span>--}}
{{--          </p>--}}

          <form action="/auction/{{$auction->id}}/addBid" method="post" id="bid_form">
            @csrf
            <input type="hidden" id="bid_price" name="bid_price">

          </form>

          <!--<p class="text-center">-->
          <!--  <img style="width: 50%"-->
          <!--       src="https://api.vieqr.com/vietqr/VietinBank/113366668888/10000/full.jpg?NDck=UngHoCV&FullName=Quy%20Vacxin%20Covid"-->
          <!--       alt="">-->
          <!--</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="$('#bid_form').submit()">Tôi đã đọc và tiến hành thanh toán</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Từ bỏ</button>
        </div>
      </div>
    </div>
  </div>


@endsection
@section("right_side")

  <!-- FORM FILTER -->
  <div class="products__filter mb-30">
    <div class="products__filter__group">
      <div class="products__filter__header">

        <h5 class="text-center text-capitalize"> Tiến hành đấu giá </h5>

      </div>
        <div class="products__filter__body">

        <div class="form-group">
          <label>Giá khởi điểm</label>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">VND</span>

            </div>
            <input type="text" class="form-control" value="{{number_format($auction->start_price)}}" disabled="">
          </div>
        </div>

        <div class="form-group">
          <label>Giá Cao Nhất</label>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">VND</span>

            </div>
            <input type="text" class="form-control" value="{{number_format($auction->current_price)}}" disabled="">
          </div>
        </div>
        <div class="form-group">
          <label>Bước nhảy</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">VND</span>
            </div>
            <input type="text" class="form-control" value="{{number_format($auction->jump_price)}}" disabled="">
          </div>
        </div>



        <div class="form-group">
          <label>Số tiền đấu giá</label>

          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">VND</span>

            </div>
            <input type="text" id="bid_input" class="form-control" data-min="{{$auction->current_price + $auction->jump_price}}" placeholder="Tối thiểu {{number_format($auction->current_price + $auction->jump_price)}}">
          </div>
        </div>
      </div>
      <div class="products__filter__footer">
        <div class="form-group mb-0">
          <button class="btn btn-primary text-capitalize btn-block" onclick="addData()"> đấu giá ngay
            <i class="fa fa-calculator ml-1"></i>
          </button>

        </div>
      </div>

    </div>



  </div>
  <!-- END FILTER -->

@endsection

@section("page-script")

  <script>


    function addData()
    {
      let bidInput = $("#bid_input").val();
      let minValue = $("#bid_input").data("min");
      if (bidInput >= minValue){
        $("#bid_price").val(bidInput)
        $("#calculate_modal").modal('show')
        $("#deposit_now").html(bidInput*10/100)
      } else {
        alert("Không đúng số tiền tối thiểu!");
      }
    }
  </script>
@endsection
