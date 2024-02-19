<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class TransactionService
{
  function confrimTransaction($id, $description)
  {
    $transQuery = Transaction::find($id);
    $now = Carbon::now();
    $confirmTime = $now;

    $user = User::find($transQuery->user_id);
    $month = intval($transQuery->package);

    if ($user->expired_time <= $now) // Đã hết hạn
    {
      // Cập nhật ngày đăng ký
      $expireTime = $now->addMonthsNoOverflow($month);
      // Cập nhật ngày hết hạn
    } else {
      // Chưa hết hạn
      $expireTime = Carbon::parse($user->expired_time)->addMonthsNoOverflow($month);
    }

    $presenter = $transQuery->presenter;
    $paymentStatus = 0;
    if ($presenter !== null) // Có hoa hồng
    {
      $expireTime = $expireTime->addDays($transQuery->gift_amount_trader);
      if ($transQuery->gift_type_presenter == "days"){
        $presenter = User::find($presenter);
        if ($presenter->expired_time <= $now) // Đã hết hạn
        {
          $expirePresenterTime = Carbon::now()->addDays($transQuery->gift_amount_presenter);
        } else {
          $expirePresenterTime = Carbon::parse($presenter->expired_time)->addDays($transQuery->gift_amount_presenter);
        }

        $presenter->update(["expired_time" => $expirePresenterTime]);
        $paymentStatus = 1;
      }
    }


    $transQuery->update(["status" => 1, "confirm_time" => $confirmTime, "expired_time" => $expireTime, "description" => $description, "gift_status_presenter" => $paymentStatus]);
    $user->update(["expired_time" => $expireTime, "subscribed_time" => $confirmTime]);

  }
}
