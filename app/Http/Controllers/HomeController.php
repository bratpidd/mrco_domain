<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subscription;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::
        with('author')
            ->withCount('comments')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->get();
        //dd($posts);
        return view('home',[
            'posts' => $posts
        ]);
    }

    public function index_post(Request $request) //add new post
    {
        if (Auth::check())
        {
            $title = $request->get('title');
            $content = $request->get('content');

            $post = new Post();
            $post->user_id = Auth::user()->id;
            $post->title = $title;
            $post->content = $content;

            $post->save();

            $redirectPath = route('home');
            return redirect($redirectPath);
        }
        else
        {
            return view('blank');
        }
    }

    public function subscribe(Request $request) //add subscription
    {
        $author_id = $request->get('author_id');
        $user_id = Auth::user()->id ?? -1;

        $exist = Subscription:://select('id')
            where('user_id', '=', $user_id)
            ->where('author_id', '=', $author_id)
            ->get();

        //echo $user_id.' '.$author_id.' '.$exist->count();

        //dd($exist)
        if ($exist->count() == 0)
        {
            $sub = new Subscription();
            $sub->user_id = $user_id;
            $sub->author_id = $author_id;
            $sub->save();
            return redirect($_SERVER['HTTP_REFERER']);
        }
        else
            {
                return redirect(route('home'));
            }
    }

    public function vue_test()
    {
        return view('vue_test');
    }

    public function test_post(Request $request)
    {
        $response = Auth::user() or 'dez';
        return $response;
        //return $request->get('lastName');
    }
}
