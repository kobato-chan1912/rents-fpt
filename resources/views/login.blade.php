<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Rethouse - Real Estate HTML Template">
  <meta name="keywords" content="Real Estate, Property, Directory Listing, Marketing, Agency" />
  <meta name="author" content="mardianto - retenvi.com">
  <title>Đăng nhập</title>

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
<header>

  <!-- NAVBAR -->
  <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="images/logo-blue-stiky.png" alt="" class="img-fluid">
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
          <li>
            <a href="#" class="btn btn-primary text-capitalize">
              <i class="fa fa-user mr-1"></i> Đăng nhập </a>
          </li>
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
  <div class="bg-theme-overlay">
    <section class="section__breadcrumb ">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-8 text-center">
            <h2 class="text-capitalize text-white">Trang đăng nhập</h2>

          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- END BREADCRUMB -->
</header>
<div class="clearfix"></div>

<!-- LISTING LIST -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!-- Form Login -->
        <div class="card mx-auto" style="max-width: 380px;">
          <div class="card-body">
            <h4 class="card-title mb-4">Đăng nhập</h4>
            <form action="/login" method="post">
              @csrf
              @if ($errors->any())
                @foreach ($errors->all() as $error)
                  <p class="text-danger">{{$error}}</p>
                @endforeach
              @endif
              <div class="form-group">
                <input class="form-control" placeholder="Email" name="email" required type="email">
              </div> <!-- form-group// -->
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" required type="password">
              </div> <!-- form-group// -->

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Đăng nhập </button>
              </div> <!-- form-group// -->
            </form>
          </div> <!-- card-body.// -->
        </div> <!-- card .// -->

      </div>
    </div>
  </div>
</section>
<!-- END LISTING LIST -->



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
</body>

</html>
