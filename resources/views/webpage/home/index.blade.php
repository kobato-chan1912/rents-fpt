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
        @foreach($cities as $city)
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


@endsection
