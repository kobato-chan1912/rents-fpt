@extends("layouts-webpage.master")
@section("title") Trang chủ@endsection
@section("content")
  <!-- POPULAR CITY -->
  <section class="popular__city-large">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="title__head-v2">
            <h2 class="text-capitalize">Thành phố lý tưởng</h2>
            <p class="text-capitalize mb-0">Nơi ươm mầm giấc mơ của bạn.</p>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach(\App\Models\City::all() as $city)
        <div class="col-md-6 col-lg-3">
          <!-- CARD IMAGE -->
          <a href="#">
            <div class="card__image-hover-style-v3">
              <div class="card__image-hover-style-v3-thumb h-230">
                <img src="{{$city->thumbnail}}" alt="" class="img-fluid w-100">
              </div>
              <div class="overlay">
                <div class="desc">
                  <h6 class="text-capitalize">{{$city->name}}</h6>
                  <p class="text-capitalize">còn {{$city->auctions()->where("status", "trading")->count()}} bất động sản</p>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- END POPULAR CITY -->

  @if(!isset($filterAuctions))

  <!-- FEATURED PROPERTY -->
  <section class="recent__property pt-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="title__head-v2">
            <h2 class="text-capitalize">Nhà mới lên sàn</h2>
            <p class="text-capitalize">Những căn nhà tuyệt vời vừa được lên sàn.</p>
          </div>
        </div>
      </div>
      <div class="recent__property-carousel owl-carousel owl-theme">
        @foreach($newAuctions as $auction)
          @include("layouts-webpage.item", ["newBadge" => true])
        @endforeach
      </div>
    </div>
  </section>
  <!-- END FEATURED PROPERTY -->



  <!-- RECENTS CITY -->
  <section class="recent__property pt-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="title__head-v2">
            <h2 class="text-capitalize">TOP được quan tâm</h2>
            <p class="text-capitalize">Những BĐS có lượt đấu giá cao nhất.</p>
          </div>
        </div>
      </div>
      <div class="recent__property-carousel owl-carousel owl-theme">
        @foreach($newAuctions as $auction)
          @include("layouts-webpage.item")
        @endforeach


      </div>
    </div>
  </section>
  <!-- END RECENTS CITY -->

  @else
    <section class="recent__property pt-0">
      <div class="container">
        <h5>Kết quả bộ lọc</h5>
        <div class="row">
          @foreach($filterAuctions as $auction)
            <div class="col-xl-4">
              <div class="item">
                <!-- FIVE -->
                <a href="/auction/{{$auction->id}}">

                  <div class="card__image card__box">
                    <div class="card__image-header h-250">

                      @if(isset($newBadge))
                        <div class="ribbon text-capitalize">Mới</div>
                      @endif


                      <img src="{{$auction->thumbnail}}" alt="" class="img-fluid w100 img-transition">
                      @php

                        $startTime = \Carbon\Carbon::now();
                      $endTime = \Carbon\Carbon::parse($auction->deadline_time);

                      $interval = $startTime->diff($endTime);
                      $format = [];
                      if ($interval->d !== 0) {
                          $format[] = "%d ngày";
                      }
                      if ($interval->h !== 0) {
                          $format[] = "%h giờ";
                      }

                      if ($interval->i !== 0) {
                          $format[] = "%i phút";
                      }


                      // Cắt chuỗi đã format để loại bỏ dấu "," cuối cùng
                       $formatTime =  $interval->format(join(' ', $format));
                      @endphp

                      @if($auction->status == "trading")
                        <div class="info"> Còn {{$formatTime}}</div>
                      @else
                        <div class="info"> Đã kết thúc </div>
                      @endif
                    </div>
                    <div class="card__image-body">
                      <h6 class="text-capitalize">
                        <a href="/page-2.html">{{$auction->title}}</a>
                      </h6>

                      <p class="text-capitalize">
                        <i class="fa fa-map-marker"></i>
                        {{$auction->address}}
                      </p>
                      <ul class="list-inline card__content">
                        <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> {{$auction->count_bathrooms}}
                                        </span>
                        </li>
                        <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> {{$auction->count_bedrooms}}
                                        </span>
                        </li>
                        <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> {{$auction->count_garage}}
                                        </span>
                        </li>
                        <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> {{$auction->area}} m2
                                        </span>
                        </li>
                      </ul>
                    </div>
                    <div class="card__image-footer">
                      <figure>
                        <img
                          src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279"
                          alt="" class="img-fluid rounded-circle">
                      </figure>
                      <ul class="list-inline my-auto">
                        <li class="list-inline-item">
                          <a href="#">
                            {{$auction->user->name}}
                          </a>

                        </li>

                      </ul>
                      <ul class="list-inline my-auto ml-auto">
                        <li class="list-inline-item ">
                          <div>Giá cao nhất</div>
                          <h6>{{number_format($auction->current_price)}}</h6>
                        </li>

                      </ul>
                    </div>
                  </div>

                </a>

              </div>

            </div>
          @endforeach
        </div>
      </div>
    </section>




  @endif


@endsection
