<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDetails extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', "state_id", "post", "address", "delivery"];
    protected $table = "profile-details";


}
