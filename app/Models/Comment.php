<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "comments";
    protected $fillable = ['user_id', 'food_id', 'comment', 'likes'];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function food()
    {
        return $this->belongsTo(Food::class, "food_id");
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class, "comment_id");
    }
}
