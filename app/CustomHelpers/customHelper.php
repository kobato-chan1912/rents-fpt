<?php
use  \Carbon\Carbon;
function getAuctionPrice($auction): string
{
  return number_format($auction->current_price);
}

function countTaxPrice($bidAmount)
{
  if ($bidAmount < 1000000000) {
    return $bidAmount * 0.04;
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

?>
