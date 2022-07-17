<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HigherOrderCollectionProxy;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ["images", "name", "price", "description", 'rating'];
    protected $table='foods';



    public function users(){
        return $this->belongsToMany(User::class, "food_user", "user_id", "food_id");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, "food_id");
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'food_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'food_id');
    }
}
