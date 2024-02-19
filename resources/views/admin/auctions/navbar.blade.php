@if(Request::has("tab"))
  <div class="col-xl-12">
    <div class="nav-align-top nav-tabs-shadow mb-4">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a type="button" href="{{Request::fullUrlWithQuery(["tab" => "info"])}}" class="nav-link @if(Request::get("tab") == "info") active @endif">
            <i class="tf-icons ti ti-info-circle ti-xs me-1"></i> Thông tin BĐS
          </a>
        </li>
        <li class="nav-item" role="presentation">
          <a type="button" href="{{Request::fullUrlWithQuery(["tab" => "bids"])}}" class="nav-link @if(Request::get("tab") == "bids") active @endif" role="tab">
            <i class="tf-icons ti ti-credit-card ti-xs me-1"></i> Lịch sử đấu giá
          </a>
        </li>
      </ul>
    </div>
  </div>
@endif

<div class="row mb-4">
  <div class="col-md-12">

    <button type="submit" onclick="window.location.href='/admin/auctions'" class="btn btn-secondary me-sm-3 me-1 data-submit waves-effect waves-light">

      <i class="tf-icons ti ti-arrow-left ti-xs me-1"></i>Quay lại</button>

  </div>
</div>
