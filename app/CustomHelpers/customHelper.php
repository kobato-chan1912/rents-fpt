<?php
use  \Carbon\Carbon;
function getAuctionPrice($auction): string
{
  return number_format($auction->bids()->latest()->first()?->bid_price ?? $auction->start_price);
}
?>
