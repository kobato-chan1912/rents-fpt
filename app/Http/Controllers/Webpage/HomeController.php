<?php

namespace App\Http\Controllers\Webpage;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
  public function index()
  {
    $newAuctions = Auction::orderBy("id", "desc")->limit(10)->get();
    $topAuctions = Auction::withCount('bids')
      ->orderByDesc('bids_count')
      ->limit(10)
      ->get();

    return view("webpage.home.index", compact('newAuctions', 'topAuctions'));
  }

  public function filter(Request $request)
  {
    $filterAuctions = Auction::orderBy('id', 'desc')
      ->type($request)
      ->area($request)
      ->city($request)
      ->get();

    return view("webpage.home.index", compact('filterAuctions'));

  }
}
