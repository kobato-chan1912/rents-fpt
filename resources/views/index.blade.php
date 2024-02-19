<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang chủ - Đấu giá nhà</title>

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
</head>

<body>
<!-- HEADER -->
<header class="jumbotron bg-theme-v5">
  <div class="bg-overlay"></div>
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
              @if(Auth::user()->role == 2)
              <a href="javascript:void(0)" class="btn btn-primary text-capitalize">
                <i class="fa fa-user mr-1"></i>Xin chào, {{Auth::user()->name}} </a>
              @else
                <a href="/admin" target="_blank" class="btn btn-primary text-capitalize">
                  <i class="fa fa-user mr-1"></i> Trang quản trị </a>
              @endif

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
  <!-- HERO -->
  <div class="wrap__intro d-flex align-items-md-center  ">
    <div class="container  ">
      <div class="row align-items-center justify-content-start flex-wrap">
        <div class="col-lg-12 mx-auto">
          <div class="wrap__intro-heading" data-aos="fade-up">

            <h1 class="text-capitalize">
              Tìm kiếm căn nhà trong mơ của bạn </h1>
            <p>Tận hưởng những căn nhà đẳng cấp thế giới với chi phí tốt nhất</p>

            <div class="bg__overlay-black p-4">
              <div class="search__property">
                <div class="position-relative">

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="buy" role="tabpanel"
                         aria-labelledby="buy-tab">
                      <div class=" search__container">
                        <div class="row input-group no-gutters">
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option selected>Loại hình</option>
                              <option>Căn hộ</option>
                              <option>Chung cư </option>
                              <option>Nhà phố</option>
                              <option>Nhà đất</option>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Chọn diện tích">Diện tích (m2) </option>
                              <option>50m</option>
                              <option>100m</option>
                              <option>200m</option>
                              <option>300m</option>


                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Số phòng ngủ">Số phòng ngủ</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Số nhà tắm">Số nhà tắm</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Thành phố">Thành phố</option>
                              <option>Thành phố Dĩ An</option>
                              <option>Thành phố Thuận An</option>
                              <option>Thành phố Tân Uyên</option>
                              <option>Thành phố Bến Cát</option>
                            </select>
                          </div>
                          <div class="col-lg-2 input-group-append">
                            <button class="btn btn-primary btn-block" type="submit">
                              <i class="fa fa-search"></i> <span
                                class="ml-1 text-uppercase">Tìm kiếm</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="rent" role="tabpanel"
                         aria-labelledby="rent-tab">
                      <div class=" search__container">
                        <div class="row input-group no-gutters">
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option selected>Type Property</option>
                              <option>House</option>
                              <option>Apartement </option>
                              <option>Hotel</option>
                              <option>Residential</option>
                              <option>Land</option>
                              <option>Luxury</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Area From">Area From </option>
                              <option>1500</option>
                              <option>1200</option>
                              <option>900</option>
                              <option>600</option>
                              <option>300</option>
                              <option>100</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Bedrooms">Bedrooms</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Bathrooms">Bathrooms</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>

                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="select_option form-control" name="select">
                              <option data-display="Locations">Locations</option>
                              <option>United Kingdom</option>
                              <option>American Samoa</option>
                              <option>Belgium</option>
                              <option>Canada</option>
                              <option>Delaware</option>

                            </select>
                          </div>
                          <div class="col-lg-2 input-group-append">
                            <button class="btn btn-primary btn-block" type="submit">
                              <i class="fa fa-search"></i> <span
                                class="ml-1 text-uppercase">search</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END HERO -->
</header>
<!-- END HEADER -->


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
      <div class="col-md-6 col-lg-3">
        <!-- CARD IMAGE -->
        <a href="#">
          <div class="card__image-hover-style-v3">
            <div class="card__image-hover-style-v3-thumb h-230">
              <img src="https://upload.wikimedia.org/wikipedia/commons/c/c2/TrungtamhanhchinhDian.jpg" alt="" class="img-fluid w-100">
            </div>
            <div class="overlay">
              <div class="desc">
                <h6 class="text-capitalize">thành phố dĩ an</h6>
                <p class="text-capitalize">còn 125 bất động sản</p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-3">
        <!-- CARD IMAGE -->
        <a href="#">
          <div class="card__image-hover-style-v3">
            <div class="card__image-hover-style-v3-thumb h-230">
              <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/%E1%BB%A6y_ban_nh%C3%A2n_d%C3%A2n_th%C3%A0nh_ph%E1%BB%91_Thu%E1%BA%ADn_An_v%C3%A0_v%C3%B2ng_xoay.jpg" alt="" class="img-fluid w-100">
            </div>
            <div class="overlay">
              <div class="desc">
                <h6 class="text-capitalize">thành phố thuận an</h6>
                <p class="text-capitalize">còn 10 bất động sản </p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-3">
        <!-- CARD IMAGE -->
        <a href="#">
          <div class="card__image-hover-style-v3">
            <div class="card__image-hover-style-v3-thumb h-230">
              <img src="https://nld.mediacdn.vn/291774122806476800/2023/4/11/z4254770199856bd398b1356fbd2b8eed6093c8bbcb877-1681179985061641076436.jpg" alt="" class="img-fluid w-100">
            </div>
            <div class="overlay">
              <div class="desc">
                <h6 class="text-capitalize">thành phố tân uyên</h6>
                <p class="text-capitalize">còn 70 bất động sản</p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-6 col-lg-3">
        <!-- CARD IMAGE -->
        <a href="#">
          <div class="card__image-hover-style-v3">
            <div class="card__image-hover-style-v3-thumb h-230">
              <img src="https://media.vneconomy.vn/w800/images/upload/2023/09/27/bencat-canhthixa-key-09052023223521.jpeg" alt="" class="img-fluid w-100">
            </div>
            <div class="overlay">
              <div class="desc">
                <h6 class="text-capitalize">thành phố bến cát</h6>
                <p class="text-capitalize">170 properties</p>
              </div>
            </div>
          </div>
        </a>
      </div>
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
      <div class="item">
        <!-- FIVE -->
        <a href="/page-2.html">

          <div class="card__image card__box">
            <div class="card__image-header h-250">
              <div class="ribbon text-capitalize">Mới</div>



              <img src="images/gallery1.jpg" alt="" class="img-fluid w100 img-transition">
              <div class="info"> Còn 3 ngày 25 giờ </div>
            </div>
            <div class="card__image-body">
              <h6 class="text-capitalize">
                <a href="/page-2.html">Nhà phố</a>
              </h6>

              <p class="text-capitalize">
                <i class="fa fa-map-marker"></i>
                25 Ấp 45, Thuận An, Bình Dương
              </p>
              <ul class="list-inline card__content">
                <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> 2
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> 4300 sq ft
                                        </span>
                </li>
              </ul>
            </div>
            <div class="card__image-footer">
              <figure>
                <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
              </figure>
              <ul class="list-inline my-auto">
                <li class="list-inline-item">
                  <a href="#">
                    Thành Long
                  </a>

                </li>

              </ul>
              <ul class="list-inline my-auto ml-auto">
                <li class="list-inline-item ">
                  <div>Giá cao nhất</div><h6>1,500,000,000</h6>
                </li>

              </ul>
            </div>
          </div>

        </a>

      </div>



      <div class="item">
        <!-- FIVE -->

        <a href="/page-2.html">
          <div class="card__image card__box">
            <div class="card__image-header h-250">
              <div class="ribbon text-capitalize">Mới</div>



              <img src="images/gallery2.jpg" alt="" class="img-fluid w100 img-transition">
              <div class="info"> Còn 3 ngày 25 giờ </div>
            </div>
            <div class="card__image-body">
              <h6 class="text-capitalize">
                <a href="/page-2.html">Nhà phố</a>
              </h6>

              <p class="text-capitalize">
                <i class="fa fa-map-marker"></i>
                25 Ấp 45, Thuận An, Bình Dương
              </p>
              <ul class="list-inline card__content">
                <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> 2
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> 4300 sq ft
                                        </span>
                </li>
              </ul>
            </div>
            <div class="card__image-footer">
              <figure>
                <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
              </figure>
              <ul class="list-inline my-auto">
                <li class="list-inline-item">
                  <a href="#">
                    Thành Long
                  </a>

                </li>

              </ul>
              <ul class="list-inline my-auto ml-auto">
                <li class="list-inline-item ">
                  <div>Giá cao nhất</div><h6>1,500,000,000</h6>
                </li>

              </ul>
            </div>
          </div>
        </a>

      </div>
      <div class="item">
        <!-- FIVE -->
        <a href="/page-2.html">
          <div class="card__image card__box">
            <div class="card__image-header h-250">
              <div class="ribbon text-capitalize">Mới</div>



              <img src="images/gallery3.jpg" alt="" class="img-fluid w100 img-transition">
              <div class="info"> Còn 3 ngày 25 giờ </div>
            </div>
            <div class="card__image-body">
              <h6 class="text-capitalize">
                <a href="/page-2.html">Nhà phố</a>
              </h6>

              <p class="text-capitalize">
                <i class="fa fa-map-marker"></i>
                25 Ấp 45, Thuận An, Bình Dương
              </p>
              <ul class="list-inline card__content">
                <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> 2
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> 4300 sq ft
                                        </span>
                </li>
              </ul>
            </div>
            <div class="card__image-footer">
              <figure>
                <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
              </figure>
              <ul class="list-inline my-auto">
                <li class="list-inline-item">
                  <a href="#">
                    Thành Long
                  </a>

                </li>

              </ul>
              <ul class="list-inline my-auto ml-auto">
                <li class="list-inline-item ">
                  <div>Giá cao nhất</div><h6>1,500,000,000</h6>
                </li>

              </ul>
            </div>
          </div>

        </a>

      </div>

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
      <div class="item">
        <!-- FIVE -->
        <a href="/page-2.html">
          <div class="card__image card__box">
            <div class="card__image-header h-250">



              <img src="images/gallery1.jpg" alt="" class="img-fluid w100 img-transition">
              <div class="info"> Còn 3 ngày 25 giờ </div>
            </div>
            <div class="card__image-body">
              <h6 class="text-capitalize">
                <a href="/page-2.html">Nhà phố</a>
              </h6>

              <p class="text-capitalize">
                <i class="fa fa-map-marker"></i>
                25 Ấp 45, Thuận An, Bình Dương
              </p>
              <ul class="list-inline card__content">
                <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> 2
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> 4300 sq ft
                                        </span>
                </li>
              </ul>
            </div>
            <div class="card__image-footer">
              <figure>
                <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
              </figure>
              <ul class="list-inline my-auto">
                <li class="list-inline-item">
                  <a href="#">
                    Thành Long
                  </a>

                </li>

              </ul>
              <ul class="list-inline my-auto ml-auto">
                <li class="list-inline-item ">
                  <div>Giá cao nhất</div><h6>1,500,000,000</h6>
                </li>

              </ul>
            </div>
          </div>
        </a>

      </div>
      <div class="item">
        <!-- FIVE -->
        <a href="/page-2.html">
          <div class="card__image card__box">
            <div class="card__image-header h-250">



              <img src="images/gallery2.jpg" alt="" class="img-fluid w100 img-transition">
              <div class="info"> Còn 3 ngày 25 giờ </div>
            </div>
            <div class="card__image-body">
              <h6 class="text-capitalize">
                <a href="/page-2.html">Nhà phố</a>
              </h6>

              <p class="text-capitalize">
                <i class="fa fa-map-marker"></i>
                25 Ấp 45, Thuận An, Bình Dương
              </p>
              <ul class="list-inline card__content">
                <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> 2
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> 3
                                        </span>
                </li>
                <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> 4300 sq ft
                                        </span>
                </li>
              </ul>
            </div>
            <div class="card__image-footer">
              <figure>
                <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
              </figure>
              <ul class="list-inline my-auto">
                <li class="list-inline-item">
                  <a href="#">
                    Thành Long
                  </a>

                </li>

              </ul>
              <ul class="list-inline my-auto ml-auto">
                <li class="list-inline-item ">
                  <div>Giá cao nhất</div><h6>1,500,000,000</h6>
                </li>

              </ul>
            </div>
          </div>
        </a>

      </div>
      <div class="item">
        <!-- FIVE -->
        <a href="/page-2.html"></a>

        <div class="card__image card__box">
          <div class="card__image-header h-250">



            <img src="images/gallery2.jpg" alt="" class="img-fluid w100 img-transition">
            <div class="info"> Còn 3 ngày 25 giờ </div>
          </div>
          <div class="card__image-body">
            <h6 class="text-capitalize">
              <a href="/page-2.html">Nhà phố</a>
            </h6>

            <p class="text-capitalize">
              <i class="fa fa-map-marker"></i>
              25 Ấp 45, Thuận An, Bình Dương
            </p>
            <ul class="list-inline card__content">
              <li class="list-inline-item">

                                    <span>
                                        <i class="fa fa-bath"></i> 2
                                    </span>
              </li>
              <li class="list-inline-item">
                                    <span>
                                        <i class="fa fa-bed"></i> 3
                                    </span>
              </li>
              <li class="list-inline-item">
                                    <span>
                                        <i class="fa fa-inbox"></i> 3
                                    </span>
              </li>
              <li class="list-inline-item">
                                    <span>
                                        <i class="fa fa-map"></i> 4300 sq ft
                                    </span>
              </li>
            </ul>
          </div>
          <div class="card__image-footer">
            <figure>
              <img src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279" alt="" class="img-fluid rounded-circle">
            </figure>
            <ul class="list-inline my-auto">
              <li class="list-inline-item">
                <a href="#">
                  Thành Long
                </a>

              </li>

            </ul>
            <ul class="list-inline my-auto ml-auto">
              <li class="list-inline-item ">
                <div>Giá cao nhất</div><h6>1,500,000,000</h6>
              </li>

            </ul>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>
<!-- END RECENTS CITY -->




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
                  <a href="/page-2.html">Nhà phố</a>
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
                <input type="text" class="form-control mb-2" disabled placeholder="Phone :0988888888">


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
</body>

</html>
