<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorProfile extends Model
{
    use HasFactory;

    protected $table = "factor-profile";
    protected $fillable = ['user_id', 'state_id', 'post', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function state()
    {
        return $this->belongsTo(State::class, "state_id");
    }
}
