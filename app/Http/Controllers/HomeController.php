<?php

namespace App\Http\Controllers;

use App\Models\Food;

use App\Models\User;use function view;

class HomeController extends Controller
{
    public function newFoods()
    {
        return view("index", [
            "foods" => Food::orderBy("id", "desc")->take(5)->get()
        ]);

    }
}
