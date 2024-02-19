@push('pricing-script')
<script src="{{asset('assets/js/pages-pricing.js')}}"></script>
@endpush

<!-- Pricing Modal -->
<div class="modal fade" id="pricingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-simple modal-pricing">
    <div class="modal-content p-2 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <!-- Pricing Plans -->
        <div class="pb-sm-5 pb-2 rounded-top">
          <h2 class="text-center mb-4">Chọn gói đăng ký</h2>
          <div class="row mx-0 gy-3">
            @foreach(\App\Models\Package::all() as $package)
          <div class="col-xl mb-md-0 mb-4" onclick="registerPack({{$package->id}})">
            <div class="col-md mb-md-0 mb-2">
              <div class="form-check custom-option custom-option-icon boxes" id="box-{{$package->id}}">
                <label class="form-check-label custom-option-content" for="radio-{{$package->id}}">
                                  <span class="custom-option-body">

                                    <span class="custom-option-title">{{$package->name}}</span>
                                    <small>{!! $package->description !!}</small>
                                    <h4 class="fw-semibold display-7 mb-0 text-primary">{{number_format($package->price)}}</h4>
                                  </span>
                  <input name="customRadioIcon" class="form-check-input" type="radio" value="" id="radio-{{$package->id}}">
                </label>
              </div>
            </div>
          </div>


            <!-- Basic -->
{{--            <div class="col-xl mb-md-0 mb-4">--}}
{{--              <div class="card border rounded shadow-none">--}}
{{--                <div class="card-body">--}}
{{--                  <!--                  <div class="my-3 pt-2 text-center">-->--}}
{{--                  <!--                    <img src="--><?php //echo e(asset('assets/img/illustrations/page-pricing-basic.png')); ?><!--" alt="Basic Image" height="140">-->--}}
{{--                  <!--                  </div>-->--}}
{{--                  <h3 class="card-title fw-semibold text-center text-capitalize mb-1">{{$package->name}}</h3>--}}
{{--                  <p class="text-center">{!! $package->description !!}</p>--}}
{{--                  <div class="text-center">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                      <h1 class="fw-semibold display-7 mb-0 text-primary">{{number_format($package->price)}}</h1>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <ul class="ps-3 my-2 pt-2">--}}
{{--                    <li class="mb-2">Tất cả chức năng</li>--}}
{{--                  </ul>--}}
{{--                  <a href="/subscriptions/createTransaction?package={{$package->id}}" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}
{{--                  <a href="javascript:void(0)" onclick="registerPack(2)" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}

{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

            @endforeach

{{--            <!-- Pro -->--}}
{{--            <div class="col-xl mb-md-0 mb-4">--}}
{{--              <div class="card border-primary border shadow-none">--}}
{{--                <div class="card-body position-relative">--}}

{{--                  <!--                  <div class="my-3 pt-2 text-center">-->--}}
{{--                  <!--                    <img src="--><?php //echo e(asset('assets/img/illustrations/page-pricing-standard.png')); ?><!--" alt="Standard Image" height="140">-->--}}
{{--                  <!--                  </div>-->--}}
{{--                  <h3 class="card-title fw-semibold text-center text-capitalize mb-1">Gói 6 tháng</h3>--}}
{{--                  <p class="text-center">Tiết kiệm 25% <del>1.200.000đ</del></p>--}}
{{--                  <div class="text-center">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                      <h1 class="price-toggle price-yearly fw-semibold display-7 text-primary mb-0">900.000đ</h1>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <ul class="ps-3 my-2 pt-2">--}}
{{--                    <li class="mb-2">Tất cả chức năng</li>--}}
{{--                  </ul>--}}
{{--                  <a href="javascript:void(0)" onclick="registerPack(2)" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}
{{--                  <a href="/subscriptions/createTransaction?package=2" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}

{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}

{{--            <!-- Enterprise -->--}}
{{--            <div class="col-xl mb-md-0 mb-4">--}}
{{--              <div class="card border rounded shadow-none">--}}
{{--                <div class="card-body">--}}


{{--                  <h3 class="card-title text-center text-capitalize fw-semibold mb-1">Gói 1 năm</h3>--}}
{{--                  <p class="text-center">Tiết kiệm 37,5% <del>2.400.000đ</del></p>--}}

{{--                  <div class="text-center">--}}
{{--                    <div class="d-flex justify-content-center">--}}
{{--                      <h1 class="price-toggle price-yearly fw-semibold display-7 text-primary mb-0">1.500.000.đ</h1>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <ul class="ps-3 my-2 pt-2">--}}
{{--                    <li class="mb-2">Tất cả chức năng</li>--}}
{{--                  </ul>--}}
{{--                  <a href="/subscriptions/createTransaction?package=3" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}

{{--                  --}}{{--                  <a href="javascript:void(0)" onclick="registerPack(3)" class="btn btn-label-success d-grid w-100 mt-3">Đăng ký</a>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
          </div>
        </div>
        <!--/ Pricing Plans -->

        <div class="row mt-2 mx-0 gy-3" id="phone_type" style="display: none">
          <div class="">
{{--            <p class="fw-semibold mb-2">Nhập mã giới thiệu (Bỏ trống nếu không có)</p>--}}
{{--            <p class="mb-2">Nếu có, đừng che giấu điều đó mà hãy nhập số điện thoại vào ô dưới để nhận về những ưu đãi hấp dẫn.</p>--}}
{{--            <a href="javascript:void(0)" class="fw-semibold">Hãy để trống nếu bạn không thực sự được ai giới thiệu!</a>--}}
          </div>
          <div class="col-8 col-xxl-6 col-xl-12">
            <input type="hidden" id="package">
            <input type="text" id="phone" class="form-control" placeholder="Nhập mã giới thiệu (Bỏ trống nếu không có)" aria-label="Enter Promo Code">
          </div>
          <div class="col-4 col-xxl-6 col-xl-12">
            <div class="d-grid" id="append_btn">
{{--              <button type="button" class="btn btn-warning waves-effect" id="confirm" onclick="confirmRegister()">Mua gói</button>--}}
            </div>
          </div>
          <div id="error" class="text-danger mt-3">

          </div>
        </div>



      </div>
    </div>
  </div>
</div>
<!--/ Pricing Modal -->
