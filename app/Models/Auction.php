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

  public function auto_bid_settings(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(AutoBidSetting::class);
  }

  public function scopeType($query, $request)
  {
    if ($request->has('type')) {
      $query->where('type', $request->get("type"));
    }

    return $query;
  }

  public function scopeArea($query, $request)
  {
    if ($request->get('area') > 0) {
      $query->where('area', ">=", $request->get("area"));
    }

    return $query;
  }

  public function scopeCity($query, $request)
  {
    if ($request->has('city')) {
      $query->where('city_id', ">=", $request->get("city"));
    }

    return $query;
  }


}
