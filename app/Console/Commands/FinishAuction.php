<?php

namespace App\Console\Commands;

use App\Models\Auction;
use App\Models\AuctionRegister;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FinishAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:finish-auction';

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
      $auctions = Auction::where("status", "trading")->get(); // auction có 3 trạng thái: trading/processing/done
      foreach ($auctions as $auction){
        if ($auction->deadline_time <= Carbon::now()){
          $auction->update(["status" => "processing"]);
          $bids = $auction->bids()->where("status", null)->orderBy("bid_price", "desc");
          if ($bids->count() > 0){
            $winBid = $bids->first();
            $winBid->update(["status" => "won", "tax_status" => "waiting", "remain_status" => "waiting"]); // đợi thanh toán còn lại
            $notWins = $auction->bids()->where("status", null)->get();
            foreach ($notWins as $notWin){
              $notWin->update(["status" => "not_won", "tax_status" => "not_won", "remain_status" => "not_won"]);
            }
            // update
            AuctionRegister::where("id", "!=", $winBid->auction_register_id)
              ->where("paid_status", "paid")
              ->where("auction_id", $auction->id)
              ->update(["paid_status" => "refund"]);
          }

          // refund
       }
      }

    }
}
