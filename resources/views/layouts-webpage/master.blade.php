<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield("title")</title>

  <!-- favicon.ico in the root directory -->
  <link rel="apple-touch-icon" href="icon.png">
  <meta name="theme-color" content="#3454d1">
  <link href="/css/styles%EF%B9%968918068d71def746395d.css" rel="stylesheet">
  @yield("page-css")
</head>

<body>
@if(Request::route()->getName() == "home" || Request::route()->getName() == "filter")
  @include("layouts-webpage.header-filter")
@elseif(Request::route()->getName() == "auction_detail" || Request::route()->getName() == "bid")
  @include("layouts-webpage.header-auction")

@else
  @include("layouts-webpage.header-normal")
@endif

@yield("content")




<!-- CALL TO ACTION -->
<section class="cta-v1 py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-9">
        <h2 class="text-uppercase text-white">TÌM KIẾM THẮC MẮC VỀ BẤT ĐỘNG SẢN?</h2>
        <p class="text-capitalize text-white">Gọi cho chúng tôi ngay để được hỗ trợ
        </p>

      </div>
      <div class="col-lg-3">
        <a href="#" class="btn btn-light text-uppercase ">Gọi
          <i class="fa fa-phone-square ml-3 arrow-btn "></i></a>
      </div>
    </div>
  </div>
</section>
<!-- END CALL TO ACTION -->


@include("layouts-webpage.footer")

<!-- SCROLL TO TOP -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TO TOP -->
<script src="/js/index.bundle%EF%B9%968918068d71def746395d.js"></script>
@yield("page-script")
</body>

</html>
