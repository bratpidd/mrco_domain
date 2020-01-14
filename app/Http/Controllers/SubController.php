<?php

namespace App\Http\Controllers;

use App\Subscription;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Post;

class SubController extends Controller
{
    public function index()
    {
        //$subs = User::with('subs')->where('id', '=', '1')->get();
        //$user_id = Auth::user()->id;

        $subs = DB::table('users')
            ->join('subscriptions', function($join)
            {
                $user_id = Auth::user()->id;
                $join->on('users.id', '=', 'subscriptions.author_id')->where('subscriptions.user_id', '=', $user_id);
            }
            )->select(['users.id', 'username'] )
            ->get();

        $subs2 = [];
        $subs_view = [];
        foreach ($subs as $value) {
            $subs2[] = $value->id;
            $subs_view[] = [$value->id, $value->username];
        }

        $posts = Post::with('author')
            ->withCount('comments')
            ->whereIn('user_id', $subs2)
            ->orderBy('created_at', 'desc')
            ->get();

        //print_r(implode($subs2));
        //dd($posts);
        return view('subs', [
            'posts' => $posts,
            'subs' => $subs_view
        ]);
    }

    public function cancel_sub(Request $request)
    {
        if (Auth::check())
        {
            $user_id = Auth::user()->id;
            $author_id = $request->get('author_id');
            //echo $user_id.' '.$author_id;

            Subscription::where('user_id', '=', $user_id)
                ->where('author_id', '=', $author_id)->delete();
            return redirect('/sub');
        }
    }
}
