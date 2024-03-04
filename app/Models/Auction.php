<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function bids()
    {
      return $this->hasMany(Bid::class);
    }

  public function feedback(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(Feedback::class);
  }
}
