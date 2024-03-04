<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\VnPayService;

class TestController extends Controller
{
    //
  private $VnPAY;
  public function __construct()
  {
    $this->VnPAY = new VnPayService();
  }

  public function test(Request $request)
  {
    $link = $this->VnPAY->createLink(env("VNPAY_HASH"), env("VNPAY_TMNCODE"), 1000*100,
    $request->ip(), "THANH TOAN DON HANG", 250000, 1998, "20240305034512");
    echo($link["data"]);
  }

  public function check(Request $request)
  {


  }

}
