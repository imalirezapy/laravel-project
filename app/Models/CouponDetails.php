<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDetails extends Model
{
    use HasFactory;

    protected $table = "coupon-details";
    protected $fillable = ["user_id", "code"];
}
