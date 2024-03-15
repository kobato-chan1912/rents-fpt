<?php
use  \Carbon\Carbon;
function getAuctionPrice($auction): string
{
  return number_format($auction->current_price);
}

function countTaxPrice($amount) {
  if ($amount < 1000000000) {
    return $amount * 0.04;
  } else if ($amount < 3000000000) {
    return $amount * 0.03;
  } else if ($amount < 5000000000) {
    return $amount * 0.025;
  } else if ($amount < 10000000000) {
    return $amount * 0.0225;
  } else if ($amount < 15000000000) {
    return $amount * 0.02;
  } else if ($amount < 25000000000) {
    return $amount * 0.0175;
  } else if ($amount < 35000000000) {
    return $amount * 0.015;
  } else if ($amount < 45000000000) {
    return $amount * 0.01;
  } else if ($amount < 60000000000) {
    return $amount * 0.0075;
  } else {
    return $amount * 0.005;
  }
}
function showDepositStatus()
{
  return [
    "paid" => "Đã thanh toán",
    "not_paid" => "Chưa thanh toán",
    "refund" => "Hoàn tiền"
  ];
}
function showTaxStatus(): array
{
  return [
    "paid" => "Đã thanh toán",
    "not_win" => "Không trúng",
    "waiting" => "Đợi thanh toán",
  ];
}

function showBidStatus()
{
  return [
    "won" => "Trúng thầu",
    "no_won" => "Không trúng",
    "cancel" => "Bị hủy"
  ];
}

?>
