<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function auction()
    {
      return $this->belongsTo(Auction::class);
    }

  public function auction_register(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(AuctionRegister::class);
  }



}
