<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class SubController extends Controller
{
    public function index()
    {
        //$subs = User::with('subs')->where('id', '=', '1')->get();
        $user_id = Auth::user()->id;

        $subs = DB::table('users')
            ->join('subscriptions', function($join)
            {
                $user_id = Auth::user()->id;
                $join->on('users.id', '=', 'subscriptions.author_id')->where('subscriptions.user_id', '=', $user_id);
            }
            )->select('users.username')
            ->get();

        $posts = DB::table('posts')
            ->join('subscriptions', function($join)
            {
                $user_id = Auth::user()->id;
                $join->on('posts.user_id', '=', 'subscriptions.author_id')->where('subscriptions.user_id', '=', $user_id);
            }
            )->join('users', 'posts.user_id', '=', 'users.id')
            ->get();

        dd($posts);
        return view('subs', [
            'posts' => $posts,
            'authors' => $subs
        ]);
    }
}
