<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionRegister;
use App\Models\Bid;
use App\Models\Feedback;
use App\Services\VnPayService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuctionController extends Controller
{
  //
  private $VnPAY;

  public function __construct()
  {
    $this->VnPAY = new VnPayService();
  }



  public function getAuctionData($id, $auction, $stars = null)
  {
    $galleries = explode(",", $auction->galleries);
    $startTime = \Carbon\Carbon::now();
    $endTime = \Carbon\Carbon::parse($auction->deadline_time);
    $interval = $startTime->diff($endTime);
    return compact('auction', 'galleries', 'interval', 'stars');
  }


  public function index($id)
  {
    $auction = Auction::find($id);
    $averageStars = $auction->user->averageStars();
    return view("webpage.auctions.index", $this->getAuctionData($id, $auction, $averageStars));
  }

  public function bid($id)
  {
    $auction = Auction::where("status", "trading")->findOrFail($id);

    return view("webpage.auctions.bid", $this->getAuctionData($id, $auction));
  }

  public function register($id, Request $request)
  {
    $auction = Auction::where("status", "trading")->findOrFail($id);
    $needPay = $auction->start_price * 10/100; // + VAT
    $register = AuctionRegister::create([
      "auction_id" =>$id,
      "user_id" => Auth::id(),
      "price" => $auction->start_price * 10/100
    ]);

    $vnPayAmount = $needPay*100;


    $link = $this->VnPAY->createLink( env("REDIRECT_PAY_DEPOSIT_URL") ,env("VNPAY_HASH"), env("VNPAY_TMNCODE"), $vnPayAmount,
      $request->ip(), "THANH TOAN COC #" . $register->id, 250000, "COC". $register->id, Carbon::now()->addMinutes(15)->format('YmdHis'));

    if ($link["code"] = '00') {
      return redirect($link["data"]);
    }


  }




  public function checkBidLegal($bidPrice, $auctionPrice, $jumpPrice)
  {

    if ($bidPrice > $auctionPrice && $bidPrice % $jumpPrice == 0) {
      return true;
    }
    return false;
  }

  public function addFeedback($id, Request $request)
  {
    Feedback::create(["auction_id" => $id, "star" => $request->get("star")
    , "content" => $request->get("content"), "user_id" => Auth::id()]);
    return redirect()->back()->with(["success" => "Thêm feedback thành công!"]);
  }

  public function addBid($id, Request $request)
  {
    $bidPrice = $request->get("bid_price");
    $auction = Auction::find($id);
    if (AuctionRegister::where("auction_id", $id)->where("user_id", Auth::id())->where("is_paid" , 1)->where("is_disable", 0)->exists())
    {
      // có tồn tại => đã đăng ký rồi
      if ($this->checkBidLegal($bidPrice, $auction->current_price, $auction->jump_price)) {
        // create bid
        $bid = Bid::create([
          "auction_id" => $id,
          "user_id" => Auth::id(),
          "bid_price" => $bidPrice,
        ]);
        $auction->update(["current_price" => $bidPrice]);
        return redirect("/auction/" .$auction->id )->with(["success" => "Bạn đã đấu giá thành công!"]);



      } else {
        return redirect("/auction/" .$auction->id )->with(["error" => "Số tiền không hợp lệ!"]);
      }
    }


  }

  public function donePay($id, $bidId, Request $request)
  {

    $bid = Bid::find($bidId);
    $needPay = $bid->bid_price;
    $vnPayAmount = $needPay*100;
    $link =  $this->VnPAY->createLink( env("REDIRECT_PAY_REMAIN_URL") ,env("VNPAY_HASH"), env("VNPAY_TMNCODE"), $vnPayAmount,
      $request->ip(), "THANH TOAN CON LAI #" . $bid->id, 250000, Str::random(4)." REMAIN". $bid->id, Carbon::now()->addMinutes(15)->format('YmdHis'));

    if ($link["code"] = '00') {
      return redirect($link["data"]);
    }

  }

  public function checkRemain( Request $request)
  {
    $txnRef = $request->get("vnp_TxnRef");
    preg_match('/REMAIN(\d+)/', $txnRef, $matches);
    $bidId = $matches[1]; // xử lý chuỗi tìm ra mã bid
    $bid = Bid::findOrFail($bidId); // xử lý chuỗi tìm ra mã bid
    $auction = $bid->auction;
    $vnp_SecureHash = $request->get("vnp_SecureHash");
    $inputData = array();
    foreach ($request->all() as $key => $value) {
      if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
      }
    }
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
    }
    $secureHash = hash_hmac('sha512', $hashData, env("VNPAY_HASH"));
    if ($secureHash == $vnp_SecureHash) {

      $status = $request->get("vnp_ResponseCode");
      if ($status == "00") {

        Bid::find($bidId)->update(["status" => 1]);
        Auction::find($auction->id)->update(["status" => "done"]);
        return redirect("/auction/" . $auction->id )->with(["success" => "Bạn đã chính thức sở hữu BĐS!"]);

      } else {
        return redirect("/auction/" . $auction->id)->with(["error" => "Thanh toán thất bại!"]);

      }

    } else {
      return redirect("/auction/" . $auction->id)->with(["error" => "Chữ ký không hợp lệ!"]);
    }
  }





}
