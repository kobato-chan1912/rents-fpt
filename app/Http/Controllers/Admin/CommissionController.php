<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
  //

  public function getGift($type, $target, $month)
    // type = days | money,
    // target = trader | presenter
    // $month = null | number

  {
    $transaction = Transaction::where("status", 1);
    if ($month !== null) {
      $transaction->whereMonth("created_at", $month)->whereYear("created_at", Carbon::today()->year);
    }

    if ($target == "trader") {
      $transaction->where("gift_type_trader", $type);
      return $transaction->sum("gift_amount_trader");
    }
    if ($target == "presenter") {
      $transaction->where("gift_type_presenter", $type);
      return $transaction->sum("gift_amount_presenter");
    }
  }

  public function index()
  {
    // Số ngày hoa hồng trong tháng
    $giftDaysMonths = $this->getGift("days", "trader", Carbon::today()->month) +
      $this->getGift("days", "presenter", Carbon::today()->month);

    // Tổng số ngày hoa hồng
    $giftDays =  $this->getGift("days", "trader", null) + $this->getGift("days", "presenter", null);


    // Biểu đồ số ngày hoa hồng
    $giftDaysArray = [];
    for ($i = 1; $i < 13; $i++) {
      $giftDaysArray["T$i"] = $this->getGift("days", "trader", $i) + $this->getGift("days", "presenter", $i);
    }


    // Số tiền hoa hồng trong tháng
    $giftMoneyMonths = $this->getGift("money", "presenter", Carbon::today()->month);

    // Tổng số tiền hoa hồng
    $giftMoney = $this->getGift("money", "presenter", null);

    // Biểu đồ
    $giftMoneyArray = [];
    for ($i = 1; $i < 13; $i++) {
      $giftMoneyArray["T$i"] = $this->getGift("money", "presenter", $i);
    }

    // Danh sách trả hoa hồng

    $unPaidCommissions= Transaction::select( 'users.id as user_id' ,'users.name as presenter', DB::raw('SUM(gift_amount_presenter) as total_price'))
      ->where("status", 1)
      ->where("gift_type_presenter", "money")
      ->where("gift_status_presenter", 0)
      ->join("users", "transactions.presenter", "=", "users.id")
      ->groupBy("presenter")->get();


    return view("admin.commission.index", compact('giftDays', 'giftDaysMonths', 'giftMoneyMonths', 'giftMoney',
    'giftDaysArray', 'giftMoneyArray', 'unPaidCommissions'));

  }

  public function update(Request $request)
  {
    $check = $request->get("check");
    $data = $request->get("data");
    foreach ($data as $ts)
    {
      Transaction::find($ts)->update(["gift_status_presenter" => $check]);
    }

    return response()->json(["status" => 200, "message" => "Cập nhật đã chuyển khoản!"]);
  }
}
