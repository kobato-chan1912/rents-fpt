<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Feedback;
use App\Services\VnPayService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
  //
  private $VnPAY;

  public function __construct()
  {
    $this->VnPAY = new VnPayService();
  }

  function countTaxPrice($bidAmount)
  {
    if ($bidAmount < 1000000000) {
      return $bidAmount * 0.02;
    } elseif ($bidAmount < 3000000000) {
      return $bidAmount * 0.03;
    } elseif ($bidAmount < 5000000000) {
      return $bidAmount * 0.025;
    } elseif ($bidAmount < 10000000000) {
      return $bidAmount * 0.0225;
    } elseif ($bidAmount < 15000000000) {
      return $bidAmount * 0.02;
    } elseif ($bidAmount < 25000000000) {
      return $bidAmount * 0.0175;
    } elseif ($bidAmount < 35000000000) {
      return $bidAmount * 0.015;
    } elseif ($bidAmount < 45000000000) {
      return $bidAmount * 0.01;
    } elseif ($bidAmount < 60000000000) {
      return $bidAmount * 0.0075;
    } else {
      return $bidAmount * 0.005;
    }

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


  public function donePay($id, $bidId)
  {
    Bid::find($bidId)->update(["tax_status" => 1, "remain_status" => 1]);
    Auction::find($id)->update(["status" => "done"]);
    return response()->json(["status" => 200]);
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
    $auction = Auction::where("status", "trading")->findOrFail($id);
    $bidPrice = $request->get("bid_price");
    // validate price
    if ($this->checkBidLegal($bidPrice, $auction->current_price, $auction->jump_price)) {
      // create bid
      $deposit = $bidPrice * 10 / 100;
      $bid = Bid::create(["auction_id" => $id,
        "user_id" => Auth::id(),
        "bid_price" => $bidPrice,
        "deposit_price" => $deposit,
        "tax_price" => $this->countTaxPrice($bidPrice),
        "remain_price" => $bidPrice - $deposit
      ]);

      $vnPayAmount = $deposit * 100;


      $link = $this->VnPAY->createLink( env("REDIRECT_PAY_DEPOSIT_URL") ,env("VNPAY_HASH"), env("VNPAY_TMNCODE"), $vnPayAmount,
        $request->ip(), "THANH TOAN COC #" . $bid->id, 250000, $bid->id, Carbon::now()->addMinutes(15)->format('YmdHis'));

      if ($link["code"] = '00') {
        return redirect($link["data"]);
      }

    } else {
      return redirect()->back()->with(["error" => "Số tiền không hợp lệ!"]);
    }

  }

  public function checkDeposit(Request $request)
  {
    $bidPrice = $request->get("vnp_Amount");
    $bid = Bid::findOrFail($request->get("vnp_TxnRef")); // xử lý chuỗi tìm ra mã bid
    $auction = $bid->auction;
    $check = Bid::where("id", $request->get("vnp_TxnRef"))->where("auction_id", $auction->id)
      ->where("deposit_status", 0)->exists();
    // check bid
    if ($check) {
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


          if ($this->checkBidLegal(intval($bidPrice), $auction->current_price, $auction->jump_price)) {
            $bid->update(["deposit_status" => 1]);
            Auction::where("status", "trading")->where("id", $auction->id)->update(["current_price" => $bidPrice]);
            return redirect("/auction/" . $auction->id )->with(["success" => "Bạn đã thanh toán cọc thành công!"]);

          }
          $bid->update(["deposit_status" => 3, "is_disable" => 1]);
          return redirect("/auction/" . $auction->id )->with(["error" => "Số tiền đấu giá đã thay đổi! Bạn sẽ được Refund!"]);

        } else {
          return redirect("/auction/" . $auction->id)->with(["error" => "Thanh toán thất bại!"]);

        }

      } else {
        return redirect("/auction/" . $auction->id)->with(["error" => "Chữ ký không hợp lệ!"]);
      }
    }

  }


}
