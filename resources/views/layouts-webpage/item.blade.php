<div class="item">
  <!-- FIVE -->
  <a href="/auction/{{$auction->id}}">

    <div class="card__image card__box">
      <div class="card__image-header h-250">

        @if(isset($newBadge))
          <div class="ribbon text-capitalize">Mới</div>
        @endif


        <img src="{{$auction->thumbnail}}" alt="" class="img-fluid w100 img-transition">
        @php

          $startTime = \Carbon\Carbon::now();
        $endTime = \Carbon\Carbon::parse($auction->deadline_time);

        $interval = $startTime->diff($endTime);
        $format = [];
        if ($interval->d !== 0) {
            $format[] = "%d ngày";
        }
        if ($interval->h !== 0) {
            $format[] = "%h giờ";
        }

        if ($interval->i !== 0) {
            $format[] = "%i phút";
        }


        // Cắt chuỗi đã format để loại bỏ dấu "," cuối cùng
         $formatTime =  $interval->format(join(' ', $format));
        @endphp

        @if($auction->status == "trading")
        <div class="info"> Còn {{$formatTime}}</div>
          @else
            <div class="info"> Đã kết thúc </div>
        @endif
      </div>
      <div class="card__image-body">
        <h6 class="text-capitalize">
          <a href="/page-2.html">{{$auction->title}}</a>
        </h6>

        <p class="text-capitalize">
          <i class="fa fa-map-marker"></i>
          {{$auction->address}}
        </p>
        <ul class="list-inline card__content">
          <li class="list-inline-item">

                                        <span>
                                            <i class="fa fa-bath"></i> {{$auction->count_bathrooms}}
                                        </span>
          </li>
          <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-bed"></i> {{$auction->count_bedrooms}}
                                        </span>
          </li>
          <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-inbox"></i> {{$auction->count_garage}}
                                        </span>
          </li>
          <li class="list-inline-item">
                                        <span>
                                            <i class="fa fa-map"></i> {{$auction->area}} m2
                                        </span>
          </li>
        </ul>
      </div>
      <div class="card__image-footer">
        <figure>
          <img
            src="https://cdna.artstation.com/p/assets/images/images/017/787/280/large/annika-soljander-icons2.jpg?1557336279"
            alt="" class="img-fluid rounded-circle">
        </figure>
        <ul class="list-inline my-auto">
          <li class="list-inline-item">
            <a href="#">
              {{$auction->user->name}}
            </a>

          </li>

        </ul>
        <ul class="list-inline my-auto ml-auto">
          <li class="list-inline-item ">
            <div>Giá cao nhất</div>
            <h6>{{number_format($auction->current_price)}}</h6>
          </li>

        </ul>
      </div>
    </div>

  </a>

</div>
