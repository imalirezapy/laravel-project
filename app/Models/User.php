<?php

namespace App\Models;

use  Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
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

    public function foods(){
        return $this->belongsToMany(Food::class, "food_user", "user_id", "food_id");
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'id', "user_id");
    }

    public function profile_details()
    {
        return $this->hasMany(ProfileDetails::class);
    }

    public function coupon_details()
    {
        return $this->hasMany(CouponDetails::class);
    }

    public function factors()
    {
        return $this->hasMany(Factor::class);
    }

    public function favorites(){
        return $this->belongsToMany(Food::class, "favorites", 'user_id', 'food_id');
    }

    public function settings()
    {
        return $this->belongsTo(Setting::class, 'id','user_id');
    }


}
