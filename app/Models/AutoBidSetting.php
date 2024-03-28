<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoBidSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bid()
    {
      return $this->belongsTo(Bid::class);
    }
}
