<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ["user_id", "user_ip", "food_id", "count"];
    protected $table='food_user';
//    protected $primaryKey = "user_id";
    public $timestamps = false;

    public function food()
    {
        return $this->belongsTo(Food::class,'food_id');
    }
}
