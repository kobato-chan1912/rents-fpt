<!doctype html>
<html lang="vi">

<head>
  <!-- Meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- favicon -->
  <link rel="icon" sizes="16x16" href="/assets/img/favicon.png">

  <!-- Title -->
  <title> @yield("title") </title>

  <!-- Public Header -->

  @include("layouts.page.css")

  @yield("page-css")

</head>

<body>
<!-- wrapper -->
<div id="wrapper" class="wrapper">
  <!--loading -->


  <!-- Header -->
  @include("layouts.page.navbar")

  <!--main-->
  @yield("content")



  <!--footer-->
  @include("layouts.page.footer")

  <!--Search-form-->
  <div class="search">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 m-auto col-md-8 col-sm-11">
          <div class="search-width  text-center">
            <button type="button" class="close">
              <i class="fas fa-times"></i>
            </button>
            <form class="search-form" action="search-page.html">
              <input type="search" value="" placeholder="What are you looking for?">
              <button type="submit" class="search-btn">search</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--/-->
</div>

@include("layouts.page.jsloading")
@yield("page-js")


</body>
</html>
