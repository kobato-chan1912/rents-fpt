<?php

namespace App\Console\Commands;

use App\Models\Auction;
use App\Models\AuctionRegister;
use App\Models\AutoBidSetting;
use App\Models\Bid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class AutoBidProcess extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:auto-bid-process';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    //
    $auctions = Auction::where("status", "trading")->get();
    foreach ($auctions as $auction) {
      $autoSettings = $auction->auto_bid_settings;
      $bids = $auction->bids();
      foreach ($autoSettings as $setting) {

        // kiểm tra nhất bảng

        $isHighest = 0;
        if ($bids->count() > 0) {
          $highestBid = $bids->orderBy("bid_price", "desc")->first();
          if ($highestBid->user_id == $setting->user_id) {
            $isHighest = 1;
          }
        }


        if ($isHighest == 0) {
          // re-query
          $auction = Auction::find($auction->id);
          $currentPrice = $auction->current_price;
          $bidPrice = $currentPrice + $auction->jump_price;
          if ($setting->max_price >= $bidPrice) {
            $checkRegister = AuctionRegister::where("auction_id", $auction->id)->where("user_id", $setting->user_id)->where("paid_status", "paid")->where("is_disable", 0);
            if ($checkRegister->exists() && ($bidPrice < $auction->buy_price)) {
              Bid::create(["auction_id" => $auction->id, "user_id" => $setting->user_id,
                "status" => null, "tax_status" => null, "remain_status" => null,
                "bid_price" => $bidPrice, "tax_price" => countTaxPrice($bidPrice),
                "remain_price" => $bidPrice - ($auction->start_price * 10 / 100),
                "auction_register_id" => $checkRegister->first()->id,
                "type" => "auto"
              ]);

              Auction::find($auction->id)->update(["current_price" => $bidPrice]);

            }

          }
        }

      }
    }
  }
}
