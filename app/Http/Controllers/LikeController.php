<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get('post_id');
        //echo ($post_id);
        $post2 = $post_id+2;
        $response = array(
            'status' => 'suckcess',
            'msg' => 'Setting created successfully',
            'post' => $post2
        );
        //echo 'cock dick';
        return \Response::json( $response );
    }
}
