<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    public $timestamps = false;
    protected $fillable = ['user_id', 'user_ip', 'food_id'];

    public function food()
    {
        return $this->belongsTo(Food::class,'food_id');
    }
}
