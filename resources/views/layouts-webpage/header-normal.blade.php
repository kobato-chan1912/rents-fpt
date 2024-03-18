<!-- HEADER -->
<header>
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
                  <i class="fa fa-paypal mr-1"></i> Lịch sử  </a>

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

  <!-- END HERO -->
</header>
<!-- END HEADER -->
