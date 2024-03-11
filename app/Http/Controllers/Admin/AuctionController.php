<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\AuctionRegister;
use App\Models\Bid;
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

  public function create(Request $request)
  {
    $data = $request->all();
    $data["user_id"] = Auth::id();
    $data["current_price"] = $request->get("start_price");
    Auction::create($data);
    return redirect("/admin/auctions")->with(["success" => "Tạo đấu giá thành công!"]);
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
      $bids = Bid::where("auction_id", $id)->get();
      return view("admin.auctions.bids", compact('auction','bids'));
    }


    if ($request->get("tab") == "feedback")
    {
      return view("admin.auctions.feedback", compact('auction'));
    }

  }

  public function edit($id, Request $request)
  {
    $data = $request->all();
    Auction::find($id)->update($data);
    return redirect()->back()->with(["success" => "Cập nhật thành công!"]);

  }

  public function delete($id)
  {
    Auction::find($id)->delete();
    return response()->json(["status" => 200]);
  }


  public function resetAuction($id, Request $request)
  {
      $time = $request->get("time");
      $formatTime = Carbon::parse($time)->format('d/m/Y H:i');
      $auction = Auction::find($id);



      // Cập nhật disable cho toàn bộ phiên cũ
      AuctionRegister::where("auction_id", $id)->update(["is_disable" => 1]);


      // cập nhật thời gian phiên
      $auction->update(["deadline_time" => $time, "status" => "trading"]);

      return redirect()->back()->with(["success" => "Phiên đã được reset về "  . $formatTime]);
  }




}
