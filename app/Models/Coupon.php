<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ["access", "user_id", "code","percent", "count", "start_at", "expire_at"];
    protected $table = "coupons";
    public function users(){
        return $this->belongsToMany(User::class, "coupons", "user_id", "id");
    }
}
