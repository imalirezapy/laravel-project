<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorDetails extends Model
{
    use HasFactory;

    protected $table = "factor-details";
    protected $fillable = ["factor_id", "food_id", "count"];

    public function factor()
    {
        return $this->belongsTo(Factor::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
