<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    function index($id)
    {
        $post = Post::withCount('comments')->where('id', $id)->first();
        $comments = Comment::with('author')->where('post_id', $id)->orderBy('updated_at', 'desc')->get();
     //   $commentNum = Post::find($id)->comments()->count();
     //   $commentNum = Post::withCount('comments')->get();
        //dd ($post);
        return view('post',[
            'post' => $post,
            'comments' => $comments,
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
