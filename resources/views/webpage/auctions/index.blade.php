@extends("webpage.auctions.layouts")
@section("right_side")

  <!-- FORM FILTER -->
  <div class="products__filter mb-30">
    <div class="profile__agent">
      <div class="profile__agent__group">

        <div class="profile__agent__header">
          <div class="profile__agent__header-avatar">

            <div class="row" style="">
              <div class="col-6">
                <p class="left-title-text no-margin">Mã tài sản:</p>
              </div>
              <div class="col-6">
                <p class="right-info-text no-margin">#{{$auction->id}}</p>
              </div>

              <div class="col-6">

                <p class="left-title-text no-margin">Thời gian mở đăng ký:</p>
              </div>
              <div class="col-6">

                <p class="right-info-text no-margin">{{\Carbon\Carbon::parse($auction->created_at)->format('d/m/Y H:i')}}</p>
              </div>
              <div class="col-6">

                <p class="left-title-text no-margin">Thời gian kết thúc đăng ký:</p>
              </div>
              <div class="col-6">

                <p class="right-info-text no-margin">{{\Carbon\Carbon::parse($auction->deadline_time)->format('d/m/Y H:i')}}</p>
              </div>
              <div class="col-6">

                <p class="left-title-text no-margin">Giá khởi điểm:</p>
              </div>
              <div class="col-6">

                <p class="right-info-text no-margin"><span class="novaticPrice openningPrice">{{number_format($auction->start_price)}}</span> <span class="unitPrice"> VNĐ</span></p>
              </div>
              <div class="col-6">

                <p class="left-title-text no-margin">Phí cọc tham gia đấu giá:</p>
              </div>
              <div class="col-6">

                <p class="right-info-text no-margin"><span class="novaticPrice registerFee">{{number_format($auction->start_price * 10/100)}}</span> VNĐ</p>
              </div>
              <div class="col-6">

                <p class="left-title-text no-margin">Bước giá:</p>
              </div>
              <div class="col-6">
                <p class="right-info-text no-margin"><span class="novaticPrice step-price">{{number_format($auction->jump_price)}}</span> <span class="unitPrice"> VNĐ</span></p>
              </div>

              <div class="col-6">

                <p class="left-title-text no-margin">Phương thức đấu giá:</p>
              </div>
              <div class="col-6">
                <p class="right-info-text no-margin">Trả giá lên và liên tục</p>
              </div>
              <div class="col-6">
                <p class="left-title-text no-margin">Tên chủ tài sản:</p>
              </div>
              <div class="col-6">

                <p class="right-info-text no-margin">{{$auction->user->name}}</p>
              </div>


            </div>


          </div>

        </div>


      </div>

    </div>
  </div>
  <div class="products__filter mb-30">
    <div class="profile__agent mb-30">
      <div class="profile__agent__group">

        <div class="profile__agent__header">
          <div class="profile__agent__header-avatar">
            <figure>
              <img
                src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279"
                alt="" class="img-fluid">
            </figure>

            <ul class="list-unstyled mb-0">
              <li>
                <h5 class="text-capitalize">{{$auction->user->name}}</h5>
              </li>
              <li><a href="tel:123456"><i class="fa fa-phone-square mr-1"></i>{{$auction->user->email}}</a></li>
              <li>
                <a href="javascript:void(0)">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      @for($i = 0; $i < $stars; $i++ )
                        <i class="fa fa-star" style="color: #3454d1;"></i>
                      @endfor
                      @for($i = 0; $i < 5 - $stars; $i++ )
                        <i class="fa fa-star"></i>
                      @endfor
                    </li>
                    <li class="list-inline-item">{{$stars}}/5</li>
                  </ul>
                </a>
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
  <!-- END FILTER -->

@endsection
