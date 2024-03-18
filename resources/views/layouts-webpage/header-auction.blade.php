<header class="bg-theme-overlay" style="background-image: url({{$auction->thumbnail}}) ">
  <!-- <div class="bg-overlay-one"></div> -->
  <!-- NAVBAR -->
  <nav class="navbar navbar-hover navbar-expand-lg navbar-soft navbar-transparent">
    <div class="container">
      <a class='navbar-brand' href='/'>
        <img src="/images/logo-blue.png" alt="">
        <img src="/images/logo-blue-stiky.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav99">
        <ul class="navbar-nav mx-auto ">
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Nhà A </a>

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Nhà S </a>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown"> Nhà M </a>

          </li>


        </ul>


        <!-- Search bar.// -->
        <ul class="navbar-nav ">
          @if(Auth::check())
            @if(Auth::user()->role == 2)
              <a href="javascript:void(0)" class="btn btn-primary text-capitalize">
                <i class="fa fa-user mr-1"></i>Xin chào, {{Auth::user()->name}} </a>
              <a href="/user/historyBid" class="btn btn-primary text-capitalize">
                <i class="fa fa-paypal mr-1"></i> Lịch sử  </a>

            @else
              <a href="/admin" target="_blank" class="btn btn-primary text-capitalize">
                <i class="fa fa-user mr-1"></i> Trang quản trị </a>
            @endif
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
          <h2 class="text-capitalize text-white ">{{$auction->title}}</h2>
          <p class="text-white">Địa chỉ: {{$auction->address}}</p>

        </div>
        <div class="col-md-4 text-center">
                        <span style="border-radius: 15px; font-size: 15pt" class="badge badge-primary">Giá hiện tại:
                            {{getAuctionPrice($auction)}}</span>
          @if($auction->status == "trading")
          <main>
            <div id="countdown">
              <div class="countdown__container">
                <div class="countdown__el">
                  <div class="countdown__time flip" id="days">
                    <div>
                      <h1>{{$interval->d}}</h1>
                    </div>
                  </div>
                  <span class="countdown__label">Ngày</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="hours">
                    <h1>{{$interval->h}}</h1>
                  </div>
                  <span class="countdown__label">Giờ</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="mins">
                    <h1>{{$interval->i}}</h1>
                  </div>
                  <span class="countdown__label">Phút</span>
                </div>
                <div class="countdown__el">
                  <div class="countdown__time flip" id="seconds">
                    <h1>{{$interval->s}}</h1>
                  </div>
                  <span class="countdown__label">Giây</span>
                </div>
              </div>
            </div>
          </main>
          @else

          <p class="text-danger">Đấu giá đã kết thúc</p>

          @endif


        </div>
      </div>
    </div>
  </section>
  <!-- END BREADCRUMB -->
  <!-- END BREADCRUMB -->
</header>
<div class="clearfix"></div>
