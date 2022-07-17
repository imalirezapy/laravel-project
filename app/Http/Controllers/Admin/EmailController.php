<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationEmailJob;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function create()
    {
        return view('admin.emails.create');
    }
//ErrorException: Undefined property: App\Jobs\NotificationEmailJob::$subject in C:\Users\alireza\Desktop\pro\app\Jobs\NotificationEmailJob.php:42

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);
        foreach (User::all() as $user) {
            if ($user->settings()->first()->notification) {
                dispatch(new NotificationEmailJob($user->id,$request->subject, $request->title, $request->body));
            }
        }
        return back();

    }
}
