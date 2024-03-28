<!-- HEADER -->
<header class="jumbotron bg-theme-v5">
  <div class="bg-overlay"></div>
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
            <li>
              @if(Auth::user()->role == 2)
                <a href="javascript:void(0)" class="btn btn-primary text-capitalize">
                  <i class="fa fa-user mr-1"></i>Xin chào, {{Auth::user()->name}} </a>
                <a href="/user/historyBid" class="btn btn-primary text-capitalize">
                  <i class="fa fa-paypal mr-1"></i> Lịch sử </a>

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
                        <form action="filter">
                          <div class="row input-group no-gutters">
                          <div class="col-lg-3">
                            <select class="select_option form-control" name="type">
                              <option value="apartment">Chung cư</option>
                              <option value="mini-apartment">Chung cư mini</option>
                              <option value="townhouse">Nhà phố</option>
                              <option value="ground">Đất nền</option>

                            </select>
                          </div>
                          <div class="col-lg-3">
                            <select class="select_option form-control" name="area">
                              <option value="50">50m</option>
                              <option value="100">100m</option>
                              <option value="200">200m</option>
                              <option value="300">300m</option>


                            </select>
                          </div>
                          <div class="col-lg-3">
                            <select class="select_option form-control" name="city">

                            @foreach(\App\Models\City::all() as $city)
                              <option value="{{$city->id}}">{{$city->name}}</option>
                              @endforeach

                            </select>
                          </div>
                          <div class="col-lg-3 input-group-append">
                            <button class="btn btn-primary btn-block" type="submit">
                              <i class="fa fa-search"></i> <span
                                class="ml-1 text-uppercase">Tìm kiếm</span>
                            </button>
                          </div>
                        </div>
                        </form>
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
