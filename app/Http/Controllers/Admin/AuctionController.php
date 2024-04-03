<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionRegister;
use App\Models\Bid;
use App\Models\BuyNowPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    //
  public function index()
  {
      $auctions = Auction::where("user_id", Auth::id())->orderBy("id", "desc")->get();
      return view("admin.auctions.index", compact('auctions'));
  }

  public function createForm()
  {
    return view("admin.auctions.form");
  }


  public function editForm($id, Request $request)
  {
    $auction = Auction::findOrFail($id);
    if ($request->get("tab") == "info")
    {
      return view("admin.auctions.form", compact('auction'));
    }

    if ($request->get("tab") == "bids")
    {
      $bids = Bid::where("auction_id", $id)->orderBy("bid_price", "desc")->get();
      $historyBuy = BuyNowPayment::where("auction_id", $id)->orderBy("id", "desc")->where("paid_status", "!=", "not_paid")->get();

      return view("admin.auctions.bids", compact('auction','bids', 'historyBuy'));
    }


    if ($request->get("tab") == "feedback")
    {
      return view("admin.auctions.feedback", compact('auction'));
    }

    if ($request->get("tab") == "buy")
    {
      $historyBuy = BuyNowPayment::where("auction_id", $id)->orderBy("id", "desc")->where("paid_status", "!=", "not_paid")->get();
      return view("admin.auctions.buy", compact('historyBuy', 'auction'));
    }

  }

  public function edit($id, Request $request)
  {
    $statusDaugia = 0;
    $data = $request->all();
    if ($request->get("start_price") > 0){
      $data["status"] = "trading";
      $statusDaugia = 1;
    }
    Auction::find($id)->update($data);
    if ($statusDaugia == 1){
      return redirect("/admin/auctions")->with(["success" => "Tạo đấu giá thành công!"]);
    }
    return redirect("/admin/auctions")->with(["success" => "Lưu đấu giá thành công!"]);

  }

  public function delete($id)
  {
    Auction::find($id)->delete();
    return response()->json(["status" => 200]);
  }


  public function resetAuction($id, Request $request)
  {
      $time = $request->get("time");
      if (Carbon::parse($time) < Carbon::now()){
        return redirect()->back()->with(["error" => "Vui lòng không reset thời gian quá gần!"]);
      }


      $formatTime = Carbon::parse($time)->format('d/m/Y H:i');
      $auction = Auction::find($id);
      $current_price = $auction->start_price;


      // disable đăng ký cho toàn bộ phiên cũ
      AuctionRegister::where("auction_id", $id)->update(["is_disable" => 1]);

      // cập nhật bid cũ
      Bid::where("auction_id", $id)->update(["status" => "cancel", "tax_status" => "not_win", "remain_status" => "not_win"]);


      // cập nhật thời gian phiên
      $auction->update(["deadline_time" => $time, "status" => "trading",
        "current_price" => $current_price]);

      return redirect()->back()->with(["success" => "Phiên đã được reset về "  . $formatTime]);
  }




}
