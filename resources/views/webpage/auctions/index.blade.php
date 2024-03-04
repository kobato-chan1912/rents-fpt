@extends("webpage.auctions.layouts")
@section("right_side")

  <!-- FORM FILTER -->
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
