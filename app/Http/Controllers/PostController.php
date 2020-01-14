<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Subscription;
use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;
use URL;

class PostController extends Controller
{
    function index($id)
    {
        session(['redirect' => URL::current() ?? 'dick']);
        $post = Post::with('author')->withCount('comments')->where('id', '=', $id)->get();
        //dd($post[0]);
        $comments = Comment::with('author')->where('post_id', '=', $id)->orderBy('updated_at', 'desc')->get();
        //   $commentNum = Post::find($id)->comments()->count();
        //   $commentNum = Post::withCount('comments')->get();
        //dd ($post);
        $author_id = $post[0]->author->id;
        if (Auth::check()) {
            $subscribed = Auth::user()->ifSubscribed($author_id);
        } else {$subscribed = 0;}
        return view('post',[
            'post' => $post[0],
            'comments' => $comments,
            'subscribed' => $subscribed
        ]);

    }

    function index_post($id, Request $request) //add new commentary
    {
        $user_id = Auth::user()->id;
        $post_id = $id;
        $content = $request->get('content');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;
        $comment->content = $content;

        $comment->save();

        return redirect ('/post/'.$id);
    }
}
