<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Food;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Location;
use Psy\Command\ReflectingCommand;

class CommentController extends Controller
{
    public function create(Request $request, Food $food, )
    {
        $message = $request->validate([
            'msg' => 'required',
        ])['msg'];

        Comment::create([
            'user_id' => auth()->user()->id,
            'food_id' => $food->id,
            'comment' => $message
        ]);
        return Redirect::route("food.show", $food->id);
    }

    public function destroy(Food $food, Comment $comment)
    {
        $comment->delete();
//        dd($food, $comment);
        return Redirect::route("food.show", $food->id);

    }

    public function rate(Request $request, Food $food)
    {
        $rate = Rate::where("user_id", auth()->user()->id)->get();
        if ($rate->isEmpty()) {
          Rate::create([
              'food_id' => $food->id,
              'user_id' => auth()->user()->id,
              'rate' => $request->value,
          ]);

        } elseif (!empty($rate->toArray()) and is_null($rate->where('food_id', $food->id)->first())) {
            Rate::create([
                'food_id' => $food->id,
                'user_id' => auth()->user()->id,
                'rate' => $request->value,
            ]);
        }

        $food_rates = $food->rates->pluck('rate')->toArray();
        $count = count($food_rates);
        $food_rates = is_null($food_rates) ? 0 : array_sum($food_rates);
        $avg = $food_rates / $count;

        $food->update([
            'rating' => round($avg, 2)
        ]);

        return response()->json([
            'rate' => round($avg, 2),
        ]);
    }

    public function like(Comment $comment)
    {
        $likes = $comment->likes()->get();
        $like = $likes->where('user_id', auth()->id());
        if ($like->isEmpty()) {
            CommentLike::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment->id,
                ]);
            $comment->update([
                'likes' => (int) $comment->likes + 1
            ]);
        } else{
            $like->first()->delete();
            $comment->update([
                'likes' => (int) $comment->likes - 1
            ]);
        }
    }
}
