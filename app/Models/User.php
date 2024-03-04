<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

//  protected $fillable = [
//        'name',
//        'phone',
//        'password',
//        'expired_time',
//        'subscribed_time',
//        'drive_service_account',
//        'drive_folder_id',
//        'drive_email',
//
//    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  public function auctions()
  {
    return $this->hasMany(Auction::class);
  }

  public function averageStars()
  {
    $averageStars = $this->auctions()->join('feedback', 'auctions.id', '=', 'feedback.auction_id')
      ->where("feedback.is_show", 1)->avg('feedback.star');
    return number_format($averageStars, 0);
  }



}
