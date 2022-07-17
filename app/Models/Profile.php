<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;
use phpDocumentor\Reflection\DocBlock\Tag;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profiles";
    protected $fillable = ["user_id", "state", "address", "post", "phone"];
    protected $primaryKey = "user_id";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

//    public function profile_details()
//    {
//        return $this->belongsToMany(ProfileDetails::class, "");
//    }
}
