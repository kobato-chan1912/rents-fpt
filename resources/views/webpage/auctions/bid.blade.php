@extends("webpage.auctions.layouts")
@section("custom_body")
  <div class="face modal" tabindex="-1" role="dialog" id="calculate_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bạn đang bid giá!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Bạn đang đấu giá với số tiền là: <span
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
          <button type="button" class="btn btn-primary" onclick="$('#bid_form').submit()">Tôi chắc chắn đấu giá</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Từ bỏ</button>
        </div>
      </div>
    </div>
  </div>

  <div class="face modal" tabindex="-1" role="dialog" id="buy_alert">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cảnh báo!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Mức giá bạn đặt đã vượt quá giá mua ngay, vì vậy bạn sẽ được chuyển trang thanh toán mua ngay. Khoản tiền cũ đã cọc sẽ được Refund.
          </p>
          <table class="table table-bordered">
            <thead>
            <tr>
              <th scope="col">Tiền sản phẩm</th>
              <th scope="col">Tiền thuế</th>
              <th scope="col">Tổng cần trả</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td id="buy_price_now">{{number_format($auction->buy_price)}}</td>
              <td id="tax_price_now">{{number_format(countTaxPrice($auction->start_price))}}</td>
              <td style="font-weight: bold; color: red">{{number_format($auction->buy_price + countTaxPrice($auction->start_price))}}</td>
            </tr>

            </tbody>
          </table>
          {{--          <p>--}}
          {{--            Số tiền bạn sẽ trả sau khi trúng thầu là: <span--}}
          {{--              style="font-weight: bold; color: red;" id="after_pay">0</span>--}}
          {{--          </p>--}}


          <!--<p class="text-center">-->
          <!--  <img style="width: 50%"-->
          <!--       src="https://api.vieqr.com/vietqr/VietinBank/113366668888/10000/full.jpg?NDck=UngHoCV&FullName=Quy%20Vacxin%20Covid"-->
          <!--       alt="">-->
          <!--</p>-->
        </div>
        <div class="modal-footer">
          <a href="/auction/{{$auction->id}}/buy" class="btn btn-primary" >Tôi đã hiểu và thanh toán</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Từ bỏ</button>
        </div>
      </div>
    </div>
  </div>

  <div class="face modal" tabindex="-1" role="dialog" id="auto_bid_modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Bạn đang đấu giá tự động!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Thao tác này sẽ đấu giá tự động BĐS này.
          </p>
          {{--          <p>--}}
          {{--            Số tiền bạn sẽ trả sau khi trúng thầu là: <span--}}
          {{--              style="font-weight: bold; color: red;" id="after_pay">0</span>--}}
          {{--          </p>--}}

          <form action="/auction/{{$auction->id}}/addAutoBid" method="post" id="auto_bid_form">
            @csrf
            <input placeholder="Nhập số tiền tối đa bạn bid cho BĐS" type="text" class="form-control money" id="max_price" name="max_price">

          </form>

          <!--<p class="text-center">-->
          <!--  <img style="width: 50%"-->
          <!--       src="https://api.vieqr.com/vietqr/VietinBank/113366668888/10000/full.jpg?NDck=UngHoCV&FullName=Quy%20Vacxin%20Covid"-->
          <!--       alt="">-->
          <!--</p>-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="$('#auto_bid_form').submit()">Tôi chắc chắn đấu giá</button>
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
      @if(!\App\Models\AuctionRegister::where("user_id", Auth::id())
->where("auction_id", $auction->id)
->where("paid_status", "paid")
->where("is_disable", 0)
->exists())
      <form method="post" action="/auction/{{$auction->id}}/register">
        @csrf
        <div class="products__filter__header">

          <h5 class="text-center text-capitalize"> Đăng ký đấu giá </h5>

        </div>
        <div class="products__filter__body">

          <div class="form-group">
            <label>Tiền cọc: 10% Giá khởi điểm</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">VND</span>

              </div>
              <input type="text" class="form-control" value="{{number_format($auction->start_price*10/100)}}" disabled="">
            </div>
          </div>

        </div>
        <div class="products__filter__footer">
          <div class="form-group mb-0">
            <button class="btn btn-primary text-capitalize btn-block"> Đăng ký đấu giá
              <i class="fa fa-calculator ml-1"></i>
            </button>

          </div>
        </div>

      </form>
      @else

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
            <input type="text" id="bid_input" class="form-control money" data-start="{{$auction->start_price}}" data-min="{{$auction->current_price + $auction->jump_price}}" placeholder="Tối thiểu {{number_format($auction->current_price + $auction->jump_price)}}">
          </div>
        </div>
      </div>
      <div class="products__filter__footer">
        <div class="form-group mb-2">
          <button class="btn btn-primary text-capitalize btn-block" onclick="addData()"> đấu giá ngay
            <i class="fa fa-calculator ml-1"></i>
          </button>

        </div>


        <div class="form-group mb-0">
          @if(\App\Models\AutoBidSetting::where("user_id", Auth::id())->where("auction_id", $auction->id)->exists())
            <a href="/auction/{{$auction->id}}/cancelAuto" class="btn btn-danger text-capitalize text-white btn-block"> Hủy đấu giá tự động
              <i class="fa fa-share ml-1"></i>
            </a>

          @else
            <button class="btn btn-primary text-capitalize btn-block" onclick="autoBid()"> đấu giá tự động
              <i class="fa fa-share ml-1"></i>
            </button>
          @endif

        </div>
      </div>
      @endif
    </div>



  </div>
  <!-- END FILTER -->

@endsection

