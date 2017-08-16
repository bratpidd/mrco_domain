<?php

namespace App\Http\Controllers;

use App\Post;
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
        //$this->middleware('auth');1
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $posts = Post::with('author')->withCount('comments')->orderBy('created_at', 'desc')->get();
            return view('home',[
                'posts' => $posts
            ]);
    }

    public function index_post(Request $request)
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
}
