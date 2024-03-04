<?php
use  \Carbon\Carbon;
function getAuctionPrice($auction): string
{
  return number_format($auction->current_price);
}
?>
