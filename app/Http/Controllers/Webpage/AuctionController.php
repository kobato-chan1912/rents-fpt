<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    //

  function countTaxPrice($bidAmount){
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

  public function getAuctionData($id)
  {
    $auction = Auction::find($id);
    $galleries = explode(",", $auction->galleries);
    return compact('auction', 'galleries');
  }


  public function index($id)
  {
      return view("webpage.auctions.index", $this->getAuctionData($id));
  }

  public function bid($id)
  {
    return view("webpage.auctions.bid", $this->getAuctionData($id));
  }

  public function addBid($id, Request $request)
  {
    $auction = Auction::find($id);
    $bidPrice = $request->get("bid_price");
    if ($auction->current_price + $auction->jump_price == $bidPrice){
        $deposit = $bidPrice * 10/100;
        Bid::create(["auction_id" => $id,
          "user_id" => Auth::id(),
          "bid_price" => $bidPrice,
          "deposit_price" => $deposit,
          "deposit_status" => 1,
          "tax_price" => $this->countTaxPrice($bidPrice),
          "remain_price" => $bidPrice - $deposit

        ]);

        $auction->update(["current_price" => $bidPrice]);

        return redirect()->back()->with(["success" => "Đấu giá thành công!"]);
    }

    return redirect()->back()->with(["error" => "Số tiền không hợp lệ!"]);

  }

  public function donePay($id, $bidId)
  {
    Bid::find($bidId)->update(["tax_status" => "done", "remain_status" => 1]);
    Auction::find($id)->update(["status" => 1]);
    return response()->json(["status" => 200]);
  }

}
