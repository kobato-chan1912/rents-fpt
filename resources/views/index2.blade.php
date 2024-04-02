<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Page 2 - Đấu giá nhà</title>
  <!-- Facebook and Twitter integration -->
  <meta property="og:title" content="" />
  <meta property="og:image" content="" />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="" />
  <meta property="og:description" content="" />
  <meta name="twitter:title" content="" />
  <meta name="twitter:image" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:card" content="" />

  <link rel="manifest" href="site.webmanifest">
  <!-- favicon.ico in the root directory -->
  <link rel="apple-touch-icon" href="icon.png">
  <meta name="theme-color" content="#3454d1">
  <link href="css/styles%EF%B9%968918068d71def746395d.css" rel="stylesheet">
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

    #countdown>h1 {
      font-size: 1.5em;
      letter-spacing: -0.05em;
      color: #2a2a2a;
    }

    #countdown>p {
      color: #8a8a8a;
    }

    #countdown>p {
      font-size: 1em;
      font-weight: normal;
      letter-spacing: 0;
      margin-top: 2em;
    }

    #countdown>time {
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
      height: 95px;
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
</head>

<body>

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
        <p>Để đấu giá, bạn sẽ thanh toán khoản phí là 1% cọc.</p>
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
            <td>1,000,0000</td>
            <td>10%</td>
          </tr>
          <tr>
            <td>2,000,0000</td>
            <td>20%</td>
          </tr>
          <tr>
            <td>3,000,0000</td>
            <td>30%</td>
          </tr>
          <tr>
            <td>4,000,0000</td>
            <td>40%</td>
          </tr>
          <tr>
            <td>> 5,000,0000</td>
            <td>50%</td>
          </tr>
          </tbody>
        </table>
        <p>
          Số tiền bạn cần cọc vào lúc này là: <span
            style="font-weight: bold; color: red;">120,000,0000</b>
        </p>
        <p>
          Số tiền bạn sẽ trả sau khi trúng thầu là: <span
            style="font-weight: bold; color: red;">2,220,000,0000</b>
        </p>

        <p class="text-center">
          <img style="width: 50%"
               src="https://api.vieqr.com/vietqr/VietinBank/113366668888/10000/full.jpg?NDck=UngHoCV&FullName=Quy%20Vacxin%20Covid"
               alt="">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Tôi đã đọc kĩ và sẽ cọc</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Từ bỏ</button>
      </div>
    </div>
  </div>
</div>

<!-- HEADER -->
<header class="bg-theme-overlay">
  <!-- <div class="bg-overlay-one"></div> -->
  <!-- NAVBAR -->
  <nav class="navbar navbar-hover navbar-expand-lg navbar-soft navbar-transparent">
    <div class="container">
      <a class='navbar-brand' href='/'>
        <img src="images/logo-blue.png" alt="">
        <img src="images/logo-blue-stiky.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav99">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Mới nhất </a>

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Quan tâm nhất </a>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Giá tốt nhất </a>

          </li>


        </ul>


        <!-- Search bar.// -->
        <ul class="navbar-nav ">
          @if(Auth::check())
            <li>
              <a href="javascript:void(0)" class="btn btn-primary text-capitalize">
                <i class="fa fa-user mr-1"></i>Xin chào, {{Auth::user()->name}} </a>

            </li>
            <li style="padding-left: 10px">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger text-capitalize">
                <i class="fa fa-sign-out mr-1"></i>Đăng xuất </a>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
            </li>
          @else
            <li>
              <a href="/login" class="btn btn-primary text-capitalize">
                <i class="fa fa-user mr-1"></i> Đăng nhập </a>
            </li>
          @endif

        </ul>
        <!-- Search content bar.// -->
        <div class="top-search navigation-shadow">
          <div class="container">
            <div class="input-group ">
              <form action="#">

                <div class="row no-gutters mt-3">
                  <div class="col">
                    <input class="form-control border-secondary border-right-0 rounded-0"
                           type="search" value="" placeholder="Search " id="example-search-input4">
                  </div>
                  <div class="col-auto">
                    <a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"
                       href="https://wallsproperty.netlify.app/search-result.html">
                      <i class="fa fa-search"></i>
                    </a>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
        <!-- Search content bar.// -->
      </div> <!-- navbar-collapse.// -->
    </div>
  </nav>
  <!-- END NAVBAR -->
  <!-- BREADCRUMB -->
  <!-- BREADCRUMB -->
  <section class="section__breadcrumb ">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-md-8 text-center">
          <h2 class="text-capitalize text-white ">Nhà phố Thuận An</h2>
          <p class="text-white">Địa chỉ: 34 Ấp 456, phường 5, Thuận An, Bình Dương</p>

        </div>
        <div class="col-md-4 text-center">
                        <span style="border-radius: 15px; font-size: 15pt" class="badge badge-primary">Giá hiện tại:
                            1,500,000,000</span>
          <main>
            <div id="countdown">
              <div class="countdown__container">
                <div class="countdown__el">
                  <div class="countdown__time flip" id="days">
                    <span class="count curr top"></span>
                    <span class="count next top">20</span>
                    <span class="count curr bottom">20</span>
                    <span class="count next bottom"></span>
                  </div>
                  <span class="countdown__label">Ngày</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="hours">
                    <span class="count curr top"></span>
                    <span class="count next top">10</span>
                    <span class="count curr bottom">10</span>
                    <span class="count next bottom"></span>
                  </div>
                  <span class="countdown__label">Giờ</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="mins">
                    <span class="count curr top"></span>
                    <span class="count next top">07</span>
                    <span class="count curr bottom">07</span>
                    <span class="count next bottom"></span>
                  </div>
                  <span class="countdown__label">Phút</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="seconds">
                    <span class="count curr top"></span>
                    <span class="count next top">10</span>
                    <span class="count curr bottom">10</span>
                    <span class="count next bottom"></span>
                  </div>
                  <span class="countdown__label">Giây</span>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </section>
  <!-- END BREADCRUMB -->
  <!-- END BREADCRUMB -->
</header>
<div class="clearfix"></div>

<!-- SINGLE DETAIL -->
<section class="single__Detail">
  <div class="container">



    <div class="row">
      <div class="col-lg-8">
        <!-- SLIDER IMAGE DETAIL -->
        <div class="slider__image__detail-large owl-carousel owl-theme">
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/01.jpg" alt="" class="img-fluid w-100 img-transition">


            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/bg19.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>


              </div>

            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery1.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>

              </div>
            </div>

          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery2.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>

              </div>
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery3.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>

              </div>
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery4.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>
                <span class="badge badge-primary text-capitalize mb-2">house</span>
                <div class="price">
                  <h5 class="text-capitalize">$13,000/mo</h5>
                </div>
                <h4 class="text-capitalize">Luxury Family Home</h4>

              </div>
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery5.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>
                <span class="badge badge-primary text-capitalize mb-2">house</span>
                <div class="price">
                  <h5 class="text-capitalize">$13,000/mo</h5>
                </div>
                <h4 class="text-capitalize">Luxury Family Home</h4>

              </div>
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>
                <span class="badge badge-primary text-capitalize mb-2">house</span>
                <div class="price">
                  <h5 class="text-capitalize">$13,000/mo</h5>
                </div>
                <h4 class="text-capitalize">Luxury Family Home</h4>

              </div>
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-large-one">
              <img src="images/gallery1.jpg" alt="" class="img-fluid w-100 img-transition">
              <div class="description">
                <figure>
                  <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                </figure>
                <span class="badge badge-primary text-capitalize mb-2">house</span>
                <div class="price">
                  <h5 class="text-capitalize">$13,000/mo</h5>
                </div>
                <h4 class="text-capitalize">Luxury Family Home</h4>
                <!-- <p class="text-uppercase">
166 welling street, collingwood, vic 3066
</p> -->
              </div>
            </div>
          </div>
        </div>

        <div class="slider__image__detail-thumb owl-carousel owl-theme">
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/01.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/bg19.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery1.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery2.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery3.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery4.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery5.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
          <div class="item">
            <div class="slider__image__detail-thumb-one">
              <img src="images/gallery1.jpg" alt="" class="img-fluid w-100 img-transition">
            </div>
          </div>
        </div>
        <!-- END SLIDER IMAGE DETAIL -->
        <div class="row">
          <div class="col-md-9 col-lg-9">
            <div class="single__detail-title mt-4">
              <h3 class="text-capitalize">Nhà phố Thuận An</h3>
              <p> 34 Ấp 456, phường 5, Thuận An, Bình Dương</p>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="single__detail-price mt-4">
              <h3 class="text-capitalize text-gray">1,5 Tỉ</h3>
              <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="#" class="badge badge-primary p-2 rounded"><i
                      class="fa fa-print"></i></a>
                </li>
                <li class="list-inline-item">
                  <a href="#" class="badge badge-primary p-2 rounded"><i
                      class="fa fa-exchange"></i></a>
                </li>

                <li class="list-inline-item">
                  <a href="#" class="badge badge-primary p-2 rounded"><i
                      class="fa fa-heart"></i></a>
                </li>
              </ul>
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
                    <tr>
                      <th scope="row">akorop@gmail.com</th>
                      <td>1,200,000,0000</td>
                      <td>12/02/2023 09:30</td>
                    </tr>
                    <tr>
                      <th scope="row">nola@gmail.com</th>
                      <td>1,300,000,0000</td>
                      <td>12/02/2023 09:30</td>
                    </tr>
                    <tr>
                      <th scope="row">bin@yh.com</th>
                      <td>1,400,000,0000</td>
                      <td>12/02/2023 09:30</td>
                    </tr>
                    </tbody>
                  </table>
                  @if(Auth::check())
                    <a href="/page-3.html"
                       class="btn btn-primary text-capitalize btn-block text-white"> đấu giá ngay
                      <i class="fa fa-calculator ml-1"></i>
                    </a>
                  @else
                    <a href="/login"
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
                <div class="re__section-body re__detail-content js__section-body js__pr-description js__tracking"
                     trackingid="lead-phone-ldp"
                     trackinglabel="loc=Sale-Listing Details-body,prid=39056545">
                  Siêu hot - Cả thị trường Tân Uyên - Thuận An chỉ có 01 khu compound Siêu VIP,
                  giá siêu hợp lý, rẻ hơn gấp 3 lần TPHCM - Lãi ngay khi mua, sẵn HĐ thuê
                  25tr/tháng trong 18 tháng.<br><br>- Vị trí: Mặt tiền đường Trịnh Công Sơn rộng
                  28m, giao với DT746 (cách ngã tư Bình Chuẩn chỉ 800m).<br>- Thiết kế lệch tầng 1
                  trệt 2 lầu - sân thượng. Có sân trước trồng cây nuôi cá.<br>- Các tầng bố trí
                  "lệch nhau" tạo sự riêng tư, có thể bố trí 4 PN, 5 WC.<br><br>Đặc biệt:<br>-
                  Thanh toán thấp kỷ lục, chỉ 500 - 600 triệu (10%) nhận nhà trước tết.<br>- Tới
                  đầu năm 2027 mới phải thanh toán tiếp.<br>- Tiền cho thuê cao hơn gửi tiết kiệm
                  với cam kết thuê 25 - 40tr/tháng.<br>- Hỗ trợ lãi suất 0% - mức thấp nhất lịch
                  sử dành cho sản phẩm nhà phố/shophouse thời điểm hiện tại.<br>- Tổng chiết khấu
                  chưa từng có lên đến 25% (Trừ vào giá bán).<br>- Miễn 2 năm phí quản lý.<br>-
                  Tặng ngay 1 lượng vàng khi mua.<br><br>500 triệu là quá rẻ để đứng tên nhà phố
                  siêu đẹp:<br><br>- Liền kề các cụm CN lớn như Vsip, Lego, Sóng Thần - Thu hút
                  giới đầu tư, chuyên gia, kỹ sư làm việc trong các cụm CN cách dự án chỉ 20 - 30p
                  di chuyển.<br>- Tiện ích resort cao cấp - phục vụ miễn phí cho cư dân: Hồ bơi,
                  công viên, phòng gym, yoga, sauna, thư viện, coffee,...<br>- Cộng đồng dân trí
                  văn minh - đã ở được 60 căn - nhiều chuyên gia, kỹ sư nước ngoài đã về ở.<br>-
                  Khu biệt lập khép kín vô cùng an ninh, yên tĩnh, không tiếng ồn, bảo vệ túc trực
                  24/7, camera an ninh toàn khu.<br><br>* Đặc biệt, mua nhà phố có sổ sẵn, không
                  rủi ro pháp lý.<br><br>* Liên hệ hotline <span
                    class="hidden-mobile hidden-phone m-cover js__btn-tracking"
                    raw="03588ea85e022c1ea06c9c8c70712986" tracking-id="lead-phone-ldp"
                    tracking-label="loc=Sale-Listing Details-body,prid=39056545">0916 770
                                            ***</span> để nhận báo giá &amp; đăng ký tham quan.
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
                      <li><b>Mã BĐS (ID):</b> RV151</li>
                      <li><b>Diện Tích:</b> 1466m2</li>
                      <li><b>Phòng Ngủ:</b> 4</li>
                      <li><b>Phòng Tắm:</b> 2</li>
                    </ul>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <ul class="property__detail-info-list list-unstyled">
                      <li><b>Garage:</b> 1</li>
                      <li><b>Diện Tích Garage:</b> 458m2</li>
                      <li><b>Năm Xây Dựng:</b> 2019-01-09</li>
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

            <!-- FLOR PLAN -->
            <div class="single__detail-features">
              <h6 class="text-capitalize detail-heading">Sơ đồ nhà</h6>
              <!-- FLOR PLAN IMAGE -->
              <div id="accordion" class="floorplan" role="tablist">
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne">
                    <a class="text-capitalize" data-toggle="collapse" href="#collapseOne"
                       aria-expanded="true" aria-controls="collapseOne">
                      tầng 1
                    </a>
                  </div>
                  <div id="collapseOne" class="collapse show" role="tabpanel"
                       aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      <figure>
                        <img src="images/floorplan.jpg" alt="" class="img-fluid">
                      </figure>

                      Tầng 1: Phòng khách, bếp, phòng ăn, WC khách, và sân để xe.



                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" role="tab" id="headingTwo">

                    <a class="collapsed text-capitalize" data-toggle="collapse"
                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Tầng 2
                    </a>
                  </div>
                  <div id="collapseTwo" class="collapse" role="tabpanel"
                       aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <figure>
                        <img src="images/floorplan2.jpg" alt="" class="img-fluid">
                      </figure>
                      Tầng 2: Phòng ngủ chính với phòng tắm riêng, phòng ngủ phụ, và phòng làm
                      việc hoặc phòng đọc sách.



                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed text-capitalize" data-toggle="collapse"
                       href="#collapseThree" aria-expanded="false"
                       aria-controls="collapseThree">
                      Tầng 3
                    </a>
                  </div>
                  <div id="collapseThree" class="collapse" role="tabpanel"
                       aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      <figure>
                        <img src="images/floorplan3.jpg" alt="" class="img-fluid">
                      </figure>
                      Tầng 3: Phòng ngủ phụ, phòng thờ, phòng giải trí, và sân phơi.








                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- END FLOR PLAN -->
            <div class="single__detail-features">
              <h6 class="text-capitalize detail-heading">Video căn nhà</h6>
              <div class="single__detail-features-video">
                <figure class=" mb-0">
                  <div class="home__video-area text-center">
                    <img src="images/bg13.jpg" alt="" class="img-fluid">
                    <a href="https://www.youtube.com/watch?v=qqmsDn9npbg" class="play-video-1 ">
                      <i class="icon fa fa-play text-white"></i>
                    </a>
                  </div>

                </figure>
              </div>
            </div>




            <!-- NEARBY -->
            <div class="single__detail-features">
              <h6 class="text-capitalize detail-heading">Tiện ích gần đây</h6>
              <div class="single__detail-features-nearby">
                <h6 class="text-capitalize"><span>
                                            <i class="fa fa-building "></i></span>Giải trí</h6>
                <ul class="list-unstyled">
                  <li>
                    <span>Nhà sách</span>
                    <p>2.2 km</p>
                  </li>
                  <li>
                    <span>Phố nhậu</span>
                    <p>3.5 km</p>

                  </li>
                  <li>
                    <span>Rạp phim</span>
                    <p>2.5 km</p>
                  </li>

                </ul>

                <h6 class="text-capitalize"><span><i class="fa fa-ambulance"></i></span>Y tế và giáo
                  dục
                </h6>
                <ul class="list-unstyled">
                  <li>
                    <span>Bệnh viện</span>
                    <p>2.5 km</p>
                  </li>
                  <li>
                    <span>Trường học</span>
                    <p>3.5 km</p>

                  </li>

                </ul>
              </div>
            </div>
            <!-- END NEARBY -->

            <!-- RATE US  WRITE -->
            <div class="single__detail-features">
              <h6 class="text-capitalize detail-heading">Đánh giá</h6>
              <div class="single__detail-features-review">
                <div class="media mt-4">
                  <img class="mr-3 img-fluid rounded-circle"
                       src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg"
                       alt="">
                  <div class="media-body">
                    <h6 class="mt-0">Trần Trọng</h6>
                    <span class="mb-3">24 th 12, 2023</span>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <i class="fa fa-star selected"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </li>
                      <li class="list-inline-item">3/5</li>
                    </ul>
                    <p> BĐS lừa đảo, gọi chủ không nghe máy. </p>


                  </div>
                </div>

                <!-- COMMENT -->
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <p class="mb-2">Để lại đánh giá của bạn:</p>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <i class="fa fa-star selected"></i>
                        <i class="fa fa-star selected"></i>
                        <i class="fa fa-star selected"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </li>
                      <li class="list-inline-item">3/5</li>
                    </ul>
                    <div class="form-group">
                      <label>Tên</label>
                      <input type="text" class="form-control" required="required">

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" required="required">

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tiêu đề</label>
                      <input type="text" class="form-control" required="required">

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nội dung</label>
                      <textarea class="form-control" rows="4"></textarea>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary float-right "> Gửi feedback <i
                    class="fa fa-paper-plane ml-2"></i></button>
                <!-- END COMMENT -->

              </div>
            </div>
            <!-- END RATE US  WRITE -->
          </div>
        </div>
        <!-- END DESCRIPTION -->
      </div>
      <div class="col-lg-4">

        <!-- FORM FILTER -->
        <div class="products__filter mb-30">
          <!-- <div class="products__filter__group">
              <div class="products__filter__header">

                  <h5 class="text-center text-capitalize">Đặt cọc dự án </h5>

              </div>
              <div class="products__filter__body">

                  <div class="form-group">
                      <label>Giá khởi điểm</label>

                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">VND</span>

                          </div>
                          <input type="text" class="form-control" value="1,000,000,000" disabled>
                      </div>
                  </div>

                  <div class="form-group">
                      <label>Đấu tối thiểu</label>

                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">VND</span>

                          </div>
                          <input type="text" class="form-control" value="1,400,000,000" disabled>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Bước nhảy</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">VND</span>
                          </div>
                          <input type="text" class="form-control" value="500,000,000" disabled>
                      </div>
                  </div>



                  <div class="form-group">
                      <label>Số tiền bạn cọc</label>

                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">VND</span>

                          </div>
                          <input type="text" class="form-control" placeholder="Tối thiểu 1,900,000,000">
                      </div>
                  </div>
              </div>
              <div class="products__filter__footer">
                  <div class="form-group mb-0">
                      <button data-toggle="modal" data-target="#calculate_modal"
                          class="btn btn-primary text-capitalize btn-block"> đấu giá ngay
                          <i class="fa fa-calculator ml-1"></i>
                      </button>

                  </div>
              </div>
          </div> -->


          <div class="profile__agent mb-30">
            <div class="profile__agent__group">

              <div class="profile__agent__header">
                <div class="profile__agent__header-avatar">
                  <figure>
                    <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                  </figure>

                  <ul class="list-unstyled mb-0">
                    <li>
                      <h5 class="text-capitalize">thành long</h5>
                    </li>
                    <li><a href="tel:123456"><i class="fa fa-phone-square mr-1"></i>0999999999</a></li>
                    <li><a href="javascript:void(0)"><i class=" fa fa-building mr-1"></i>
                        CTY BĐS Thành Long</a>
                    </li>
                  </ul>


                </div>

              </div>

              <div class="profile__agent__footer">
                <div class="form-group mb-0">
                  <button class="btn btn-primary text-capitalize btn-block"> liên hệ <i class="fa fa-phone-square ml-1"></i></button>

                </div>
              </div>
            </div>

          </div>
        </div>


      </div>
    </div>


  </div>
</section>
<!-- END SINGLE DETAIL -->

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


<!-- FOOTER -->
<!-- Footer  -->
<footer>
  <div class="wrapper__footer bg__footer ">
    <div class=" container">
      <div class="row">
        <div class="col-md-4">
          <div class="widget__footer mb-3">
            <!-- <h4 class="footer-title">company info</h4> -->
            <figure>
              <img src="images/logo-blue.png" alt="" class="logo-footer">
            </figure>
            <p>

              Hệ thống đấu giá BĐS được xây dựng bởi sinh viên ĐH FPT HCM

            </p>
          </div>
          <div class="border-line"></div>
          <div class="widget__footer">
            <h4 class="footer-title">Kết nối </h4>
            <!-- <p>
        Follow us and stay in touch to get the latest news
    </p> -->
            <p>
              <button class="btn btn-social btn-social-o facebook mr-1">
                <i class="fa fa-facebook-f"></i>
              </button>
              <button class="btn btn-social btn-social-o twitter mr-1">
                <i class="fa fa-twitter"></i>
              </button>

              <button class="btn btn-social btn-social-o linkedin mr-1">
                <i class="fa fa-linkedin"></i>
              </button>
              <button class="btn btn-social btn-social-o instagram mr-1">
                <i class="fa fa-instagram"></i>
              </button>

              <button class="btn btn-social btn-social-o youtube mr-1">
                <i class="fa fa-youtube"></i>
              </button>
            </p>
          </div>
        </div>

        <!-- QUICK LINKS -->
        <div class="col-md-4">
          <div class="widget__footer">
            <h4 class="footer-title">Liên kết nhanh</h4>
            <div class="link__category">
              <ul class="list-unstyled ">
                <li class="list-inline-item">
                  <a href="#">Căn hộ</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Chung cư</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Nhà phố</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Nhà đất</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Villa</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Resort</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Văn phòng</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Nhà bãi biển</a>
                </li>
                <li class="list-inline-item">
                  <a href="#">Đẳng cấp</a>
                </li>

              </ul>
            </div>
          </div>
        </div>

        <!-- NEWSLETTERS -->
        <div class="col-md-4">
          <div class="widget__footer">
            <h4 class="footer-title">Liên hệ</h4>
            <!-- Form Newsletter -->

            <div class="widget__form-newsletter ">
              <p>

                Liên hệ chúng tôi qua các nguồn sau
              </p>
              <div class="mt-3">
                <input type="text" class="form-control mb-2" disabled
                       placeholder="Phone :0988888888">


                </button>
              </div>
            </div>

          </div>
        </div>
        <!-- END NEWSLETTER -->
      </div>

    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="bg__footer-bottom ">
    <div class="container">
      <div class="row flex-column-reverse flex-md-row">
        <div class="col-md-6">
                        <span>
                            © 2024 Đại học FPT
                        </span>
        </div>
        <div class="col-md-6">
          <ul class="list-inline ">
            <li class="list-inline-item">
              <a href="#">
                privacy
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                contact
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                about
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                faq
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer  -->
<!-- END FOOTER -->



<!-- SCROLL TO TOP -->
<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TO TOP -->
<script src="js/index.bundle%EF%B9%968918068d71def746395d.js"></script>
<script src="js/app.js"></script>

</body>

</html>
