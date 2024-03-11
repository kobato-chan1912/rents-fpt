<?php

namespace App\Console\Commands;

use App\Models\Auction;
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
      $auctions = Auction::where("status", "trading")->get();
      foreach ($auctions as $auction){
        if ($auction->deadline_time <= Carbon::now()){
          $auction->update(["status" => "processing"]);
          $bids = $auction->bids()->where("is_disable", 0)->orderBy("bid_price", "desc");
          if ($bids->count() > 0){
            $winBid = $bids->first();
            $winBid->update(["status" => 2]); // đợi thanh toán còn lại
          }

       }
      }

    }
}
