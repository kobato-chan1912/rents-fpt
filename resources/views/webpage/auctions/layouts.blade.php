@extends("layouts-webpage.master")
@section("title")
  {{$auction->title}}
@endsection
@section("page-css")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

  <style>
    #countdown {
      position: relative;
      display: flex;
      pointer-events: none;
      user-select: none;
      color: var(--color-1);
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    #countdown > h1 {
      font-size: 1.5em;
      letter-spacing: -0.05em;
      color: #2a2a2a;
    }

    #countdown > p {
      color: #8a8a8a;
    }

    #countdown > p {
      font-size: 1em;
      font-weight: normal;
      letter-spacing: 0;
      margin-top: 2em;
    }

    #countdown > time {
      font-family: Abel;
      font-size: 1em;
      font-weight: bold;
      letter-spacing: 0;
      margin-top: 2em;
    }

    .countdown__container {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1em;
      align-items: center;
      justify-content: center;
      margin-top: 3em;
    }

    .countdown__el {
      display: flex;
      justify-content: center;
      text-align: center;
      flex-direction: column;
      align-self: flex-start;
      align-items: center;
      position: relative;
      width: 62px;
    }

    .countdown__time {
      border-radius: 5px;
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      text-align: center;
      position: relative;
      max-width: 70px;
      width: 100%;
      border-radius: 5px;

      -webkit-perspective: 479px;
      -moz-perspective: 479px;
      -ms-perspective: 479px;
      -o-perspective: 479px;
      perspective: 479px;

      -webkit-backface-visibility: hidden;
      -moz-backface-visibility: hidden;
      -ms-backface-visibility: hidden;
      -o-backface-visibility: hidden;
      backface-visibility: hidden;

      -webkit-transform: translateZ(0);
      -moz-transform: translateZ(0);
      -ms-transform: translateZ(0);
      -o-transform: translateZ(0);
      transform: translateZ(0);

      -webkit-transform: translate3d(0, 0, 0);
      -moz-transform: translate3d(0, 0, 0);
      -ms-transform: translate3d(0, 0, 0);
      -o-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
      background-color: white;
    }

    .countdown__time .count {
      background: var(--background-count);
      color: var(--color-count);
      display: block;
      font-family: "Montserrat", sans-serif;
      font-size: 40px;
      height: 95px;
      line-height: 2.4em;
      overflow: hidden;
      position: absolute;
      text-align: center;
      width: 100%;

      -webkit-transform: translateZ(0);
      -moz-transform: translateZ(0);
      -ms-transform: translateZ(0);
      -o-transform: translateZ(0);
      transform: translateZ(0);

      -webkit-transform-style: flat;
      -moz-transform-style: flat;
      -ms-transform-style: flat;
      -o-transform-style: flat;
      transform-style: flat;
    }

    .countdown__time .count.top {
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      border-bottom: 1px solid var(--border-color);
      border-radius: 5px 5px 0 0;
      height: 50%;

      -webkit-transform-origin: 50% 100%;
      -moz-transform-origin: 50% 100%;
      -ms-transform-origin: 50% 100%;
      -o-transform-origin: 50% 100%;
      transform-origin: 50% 100%;
    }

    .countdown__time .count.bottom {
      background-image: linear-gradient(rgba(255, 255, 255, 0.1), transparent);
      background-image: -webkit-linear-gradient(rgba(255, 255, 255, 0.1),
      transparent);
      background-image: -moz-linear-gradient(rgba(255, 255, 255, 0.1), transparent);
      background-image: -ms-linear-gradient(rgba(255, 255, 255, 0.1), transparent);
      background-image: -o-linear-gradient(rgba(255, 255, 255, 0.1), transparent);
      border-top: 1px solid var(--border-color);
      /*border-bottom: 1px solid #000;*/
      border-radius: 0 0 5px 5px;
      line-height: 0;
      height: 50%;
      top: 50%;

      -webkit-transform-origin: 50% 0;
      -moz-transform-origin: 50% 0;
      -ms-transform-origin: 50% 0;
      -o-transform-origin: 50% 0;
      transform-origin: 50% 0;
    }

    .countdown__el .countdown__label {
      font-size: normal;
      margin-top: 15px;
      display: flex;
      justify-content: center;
      top: 95px;
      width: 100%;
      color: white;
    }

    /* Animation start */
    .count.curr.top {
      -webkit-transform: rotateX(0deg);
      -moz-transform: rotateX(0deg);
      -ms-transform: rotateX(0deg);
      -o-transform: rotateX(0deg);
      transform: rotateX(0deg);
      z-index: 3;
    }

    .count.next.bottom {
      -webkit-transform: rotateX(90deg);
      -moz-transform: rotateX(90deg);
      -ms-transform: rotateX(90deg);
      -o-transform: rotateX(90deg);
      transform: rotateX(90deg);
      z-index: 2;
    }

    .flip .count.curr.top {
      -webkit-transition: all 250ms ease-in-out;
      -moz-transition: all 250ms ease-in-out;
      -ms-transition: all 250ms ease-in-out;
      -o-transition: all 250ms ease-in-out;
      transition: all 250ms ease-in-out;
      -webkit-transform: rotateX(-90deg);
      -moz-transform: rotateX(-90deg);
      -ms-transform: rotateX(-90deg);
      -o-transform: rotateX(-90deg);
      transform: rotateX(-90deg);
    }

    .flip .count.next.bottom {
      -webkit-transition: all 250ms ease-in-out 250ms;
      -moz-transition: all 250ms ease-in-out 250ms;
      -ms-transition: all 250ms ease-in-out 250ms;
      -o-transition: all 250ms ease-in-out 250ms;
      transition: all 250ms ease-in-out 250ms;

      -webkit-transform: rotateX(0deg);
      -moz-transform: rotateX(0deg);
      -ms-transform: rotateX(0deg);
      -o-transform: rotateX(0deg);
      transform: rotateX(0deg);
    }

    @media screen and (max-width: 600px) {
      .countdown__container {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>

@endsection
@section("content")
  @yield("custom_body")
  <!-- SINGLE DETAIL -->
  <section class="single__Detail">
    <div class="container">


      <div class="row">
        <div class="col-lg-8">
          <!-- SLIDER IMAGE DETAIL -->
          <div class="slider__image__detail-large owl-carousel owl-theme">
            @foreach($galleries as $image)
              <div class="item">
                <div class="slider__image__detail-large-one">
                  <img src="{{$image}}" alt="" class="img-fluid w-100 img-transition">


                </div>
              </div>
            @endforeach
          </div>

          <div class="slider__image__detail-thumb owl-carousel owl-theme">
            @foreach($galleries as $image)

              <div class="item">
                <div class="slider__image__detail-thumb-one">
                  <img src="{{$image}}" alt="" class="img-fluid w-100 img-transition">
                </div>
              </div>

            @endforeach
          </div>
          <!-- END SLIDER IMAGE DETAIL -->
          <div class="row">
            <div class="col-md-9 col-lg-9">
              <div class="single__detail-title mt-4">
                <h3 class="text-capitalize">{{$auction->title}}</h3>
                <p> {{$auction->address}}</p>
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="single__detail-price mt-4">
                <h3 class="text-capitalize text-gray">{{getAuctionPrice($auction)}}</h3>
              </div>

            </div>
          </div>
          <!-- DESCRIPTION -->
          <div class="row">
            <div class="col-lg-12">

              <div class="single__detail-features">
                <h6 class="text-capitalize detail-heading">Lịch sử đấu giá</h6>
                <!-- INFO PROPERTY DETAIL -->
                <div class="property__detail-info">
                  <div class="row">
                    <table class="table">
                      <thead class="thead-light">
                      <tr>
                        <th scope="col">Tài khoản</th>
                        <th scope="col">Giá đặt</th>
                        <th scope="col">Thời gian</th>
                      </tr>
                      </thead>
                      <tbody>

                      @foreach($auction->bids()->where("deposit_status" , ">" , 0)->where("is_disable", 0)->orderBy("id", "desc")->get() as $bid)

                        <tr>
                          <th scope="row">{{$bid->user->email}}</th>
                          <td>{{number_format($bid->bid_price)}}</td>
                          <td>{{\Carbon\Carbon::parse($bid->created_at)->format('d/m/Y H:i')}}</td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                    @if(Auth::check())
                      @if(Auth::user()->role == 2)
                        @if($auction->deadline_time > \Carbon\Carbon::now())
                          <a href="/auction/{{$auction->id}}/bid"
                             class="btn btn-primary text-capitalize btn-block text-white"> đấu giá ngay
                            <i class="fa fa-calculator ml-1"></i>
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
                  </div>

                </div>

                <!-- END INFO PROPERTY DETAIL -->
              </div>

              <div class="single__detail-desc">
                <h6 class="text-capitalize detail-heading">Mô tả</h6>
                <div class="show__more">
                  <div class="re__section-body re__detail-content js__section-body js__pr-description js__tracking">

                    {!! $auction->description !!}

                  </div>

                  <a href="javascript:void(0)" class="show__more-button ">đọc thêm</a>
                </div>
              </div>
              <div class="clearfix"></div>

              <!-- PROPERTY DETAILS SPEC -->
              <div class="single__detail-features">
                <h6 class="text-capitalize detail-heading">Thông tin</h6>
                <!-- INFO PROPERTY DETAIL -->
                <div class="property__detail-info">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                      <ul class="property__detail-info-list list-unstyled">
                        <li><b>Mã BĐS (ID):</b> {{$auction->id}}</li>
                        <li><b>Diện Tích:</b> {{$auction->area}} m2</li>
                        <li><b>Phòng Ngủ:</b> {{$auction->count_bedrooms}}</li>
                        <li><b>Phòng Tắm:</b> {{$auction->count_bathrooms}} </li>
                      </ul>
                    </div>
                    <div class="col-md-6 col-lg-6">
                      <ul class="property__detail-info-list list-unstyled">
                        <li><b>Garage:</b> {{$auction->count_garage}}</li>
                        <li><b>Diện Tích Garage:</b> {{$auction->area_garage}}m2</li>
                        <li><b>Năm Xây Dựng:</b> {{$auction->year_build}}</li>
                        <li><b>Loại BĐS:</b> Nhà Ở Gia Đình Đầy Đủ</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- END INFO PROPERTY DETAIL -->
              </div>
              <!-- END PROPERTY DETAILS SPEC -->
              <div class="clearfix"></div>

              <!-- FEATURES -->
              <div class="single__detail-features">
                <h6 class="text-capitalize detail-heading">Tiện ích</h6>
                <ul class="list-unstyled icon-checkbox">
                  <li>Điều hòa không khí</li>
                  <li>Bể bơi</li>
                  <li>Điều hòa trung tâm</li>
                  <li>Spa & Massage</li>
                  <li>Cho phép nuôi thú cưng</li>

                  <li>Điều hòa không khí</li>
                  <li>Phòng tập gym</li>
                  <li>Báo động</li>

                  <li>Rèm cửa</li>
                  <li>Wi-Fi miễn phí</li>
                  <li>Chỗ đậu xe ô tô</li>
                  <li>Miễn thuế 3 năm</li>

                </ul>
              </div>
              <!-- END FEATURES -->


              <!-- RATE US  WRITE -->
              <div class="single__detail-features">
                <h6 class="text-capitalize detail-heading">Đánh giá</h6>
                @foreach($auction->feedback()->where("is_show", 1)->get() as $feedback)
                  <div class="single__detail-features-review">
                    <div class="media mt-4">
                      <img class="mr-3 img-fluid rounded-circle"
                           src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg"
                           alt="">
                      <div class="media-body">
                        <h6 class="mt-0">{{$feedback->user->name}}</h6>
                        <span class="mb-3">{{$feedback->created_at}}</span>
                        <ul class="list-inline">
                          <li class="list-inline-item">
                            @for($i = 0; $i < $feedback->star; $i++ )
                            <i class="fa fa-star selected"></i>
                            @endfor
                              @for($i = 0; $i < 5 - $feedback->star; $i++ )
                            <i class="fa fa-star"></i>
                              @endfor
                          </li>
                          <li class="list-inline-item">{{$feedback->star}}/5</li>
                        </ul>
                        <p> {!! nl2br($feedback->content) !!} </p>


                      </div>
                    </div>
                    <!-- COMMENT -->


                  </div>

                @endforeach

                @if(Auth::check() && (Auth::id() !== $auction->user->id))
                <form method="post" action="/auction/{{$auction->id}}/feedback">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <p class="mb-2">Để lại đánh giá của bạn:</p>
                      <div class="mb-4" style="z-index: 0" id="rateYo"></div>
                      <input type="hidden" id="star" name="star">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tên</label>
                        <input disabled value="{{Auth::user()->name}}" type="text" class="form-control" name="name">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nội dung</label>
                        <textarea required class="form-control" name="content" rows="4"></textarea>
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-primary float-right "> Gửi feedback <i
                      class="fa fa-paper-plane ml-2"></i></button>
                  <!-- END COMMENT -->

                </form>
                @endif
              </div>
              <!-- END RATE US  WRITE -->
            </div>
          </div>
          <!-- END DESCRIPTION -->
        </div>
        <div class="col-lg-4">

          @yield("right_side")


        </div>
      </div>


    </div>
  </section>
  <!-- END SINGLE DETAIL -->

@endsection
@section("page-script")
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    @if(Session::has("success"))
    Swal.fire({
      icon: 'success',
      title: 'Thành công!',
      text: '{{Session::get("success")}}',
    })
    @endif

    @if(Session::has("error"))
    Swal.fire({
      icon: 'error',
      title: 'Thất bại!',
      text: '{{Session::get("error")}}',
    })
    @endif

    // Start the countdown
    startCountdown();

    function startCountdown() {
      var countdownInterval = setInterval(function () {
        // Get the current values
        var days = parseInt($('#days h1').text());
        var hours = parseInt($('#hours h1').text());
        var minutes = parseInt($('#mins h1').text());
        var seconds = parseInt($('#seconds h1').text());

        // Update the countdown
        if (seconds > 0) {
          seconds--;
        } else {
          seconds = 59;
          if (minutes > 0) {
            minutes--;
          } else {
            minutes = 59;
            if (hours > 0) {
              hours--;
            } else {
              hours = 23;
              if (days > 0) {
                days--;
              } else {
                clearInterval(countdownInterval);
                // Countdown finished
                return;
              }
            }
          }
        }

        // Update the HTML elements
        $('#days h1').text(days);
        $('#hours h1').text(hours);
        $('#mins h1').text(minutes);
        $('#seconds h1').text(seconds);
      }, 1000);
    }



    $(function () {

      $("#rateYo").rateYo({
        fullStar: true,
        onChange: function (rating) {

          $("#star").val(rating);
        }
      });
    });
  </script>

@endsection
