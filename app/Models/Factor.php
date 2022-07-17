<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;

    protected $table = "factors";
    protected $fillable = ['user_id','profile_details_id','factor_profile_id',  'total', 'delivery', 'coupon_id', 'gateway','final_total',  'complete'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function profile_details()
    {
        return $this->belongsTo(ProfileDetails::class);
    }

    public function factor_details()
    {
        return $this->hasMany(FactorDetails::class, "factor_id");
    }
}
