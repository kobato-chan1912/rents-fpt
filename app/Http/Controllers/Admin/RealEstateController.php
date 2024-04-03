<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealEstateController extends Controller
{

  //
  public function index()
  {
    $auctions = Auction::where("user_id", Auth::id())->orderBy("id", "desc")->get();
    return view("admin.real_estate.index", compact('auctions'));
  }

  public function createForm()
  {
    return view("admin.real_estate.form");
  }


  public function create(Request $request)
  {
    $data = $request->all();
    $data["user_id"] = Auth::id();
    Auction::create($data);
    return redirect("/admin/real_estate")->with(["success" => "Tạo BĐS thành công!"]);
  }

  public function editForm($id, Request $request)
  {
    $auction = Auction::findOrFail($id);
    return view("admin.real_estate.form", compact('auction'));

  }

  public function edit($id, Request $request)
  {
    $data = $request->all();
    Auction::find($id)->update($data);
    return redirect()->back()->with(["success" => "Cập nhật thành công!"]);
  }



}
