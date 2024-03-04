<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
  public function historyBid()
  {
    $bids = Bid::where("user_id", Auth::id())->where("deposit_status" , ">" , 0)->orderBy("id", "desc")->get();
    return view("webpage.users.history_bid", compact('bids'));
  }
}
