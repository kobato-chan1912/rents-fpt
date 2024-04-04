<table class="table">
  <thead class="thead-light">
  <tr>
    <th scope="col">Tài khoản</th>
    <th scope="col">Giá đặt</th>
    <th scope="col">Thời gian</th>
    <th scope="col">Loại</th>
  </tr>
  </thead>
  <tbody>

  @if($auction->status == "bought")
    @php
      $winner = \App\Models\BuyNowPayment::find($auction->buy_win_id);
    @endphp
    <tr style="background-color: lightgoldenrodyellow">
      <th scope="row">{{ $winner->user->email }} <span><img width="20px" src="https://static-00.iconduck.com/assets.00/medal-gold-winner-2-icon-1970x2048-ov2qzofe.png" alt=""></span></th>
      <td>{{ number_format($winner->price) }}</td>
      <td>{{ $winner->created_at->format('d/m/Y H:i') }}</td>
      <td>Mua ngay</td>
    </tr>
    @foreach($auction->bids()->orderBy('id', 'desc')->get() as $bid)
      @if($bid->status !== 'cancel')
        <tr>
          <th scope="row">{{ $bid->user->email }} <span><img width="20px" src="https://static-00.iconduck.com/assets.00/medal-gold-winner-2-icon-1970x2048-ov2qzofe.png" alt=""></span></th>
          <td>{{ number_format($bid->bid_price) }}</td>
          <td>{{ $bid->created_at->format('d/m/Y H:i') }}</td>
          <td>{{bidType()[$bid->type]}}</td>
        </tr>
      @endif
    @endforeach


  @else


    @foreach($auction->bids()->orderBy('id', 'desc')->get() as $bid)
      @if($bid->status !== 'cancel')
        <tr @if($auction->bid_win_id == $bid->id) style="background-color: lightgoldenrodyellow" @endif>
          <th scope="row">{{ $bid->user->email }}
            @if($auction->bid_win_id == $bid->id)
              <span> <img width="20px" src="https://static-00.iconduck.com/assets.00/medal-gold-winner-2-icon-1970x2048-ov2qzofe.png" alt=""></span>
            @endif
          </th>
          <td>{{ number_format($bid->bid_price) }}</td>
          <td>{{ $bid->created_at->format('d/m/Y H:i') }}</td>
          <td>{{bidType()[$bid->type]}}</td>
        </tr>
      @endif
    @endforeach

  @endif

  </tbody>
</table>
@if(Auth::check())
  @if(Auth::user()->role == 2)
    @if($auction->deadline_time > \Carbon\Carbon::now())
      @if(!checkIsHighest(Auth::id(), $auction->id))
        <a href="/auction/{{$auction->id}}/bid"
           class="btn btn-primary text-capitalize btn-block text-white"> đấu giá ngay
          <i class="fa fa-calculator ml-1"></i>
        </a>
      @else
        <p class="text-danger">Bạn đã ở giá cao nhất!</p>
      @endif
      @if($auction->buy_price > 0)
        <a href="javascript:void(0)" onclick="buyThis()"
           class="btn btn-success text-capitalize btn-block text-white"> Mua ngay với giá {{number_format($auction->buy_price)}}
          <i class="fa fa-money ml-1"></i>
        </a>
      @endif
      <a href="javascript:void(0)"
         class="btn btn-info text-capitalize btn-block text-white" onclick="vatPopup()"> Điều khoản VAT
        <i class="fa fa-info ml-1"></i>
      </a>
    @else
      <p class="text-danger">Đã hết hạn đấu giá!</p>
    @endif

  @else
    <p class="text-danger">Bạn không có quyền đấu giá!</p>

  @endif
@else
  <a href="/auction/{{$auction->id}}/bid"
     class="btn btn-primary text-capitalize btn-block text-white"> đấu giá ngay
    <i class="fa fa-calculator ml-1"></i>
  </a>
@endif
