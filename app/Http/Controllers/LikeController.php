<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Post;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get('post_id');
        $user_id = Auth::user()->id;
        $exist=Like::where('user_id', '=', $user_id)
            ->where('post_id', '=', $post_id)
            ->count();

        if (!$exist)
        {
            $like = new Like();
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
            $result = 'added';
        }
        else
            {
                Like::where('user_id', '=', $user_id)
                    ->where('post_id', '=', $post_id)
                    ->delete();
                $result = 'deleted';
            }

        $likes_count = Like::
        where('post_id', '=', $post_id)
            ->count();
        $response = array(
            'status' => 'suckcess',
            'msg' => 'Setting created successfully',
            'post' => 'ya tvou mamu ebal',
            'result' => $result,
            'likes_count' => $likes_count
        );
        //echo 'cock dick';
        return \Response::json( $response );
    }
}
