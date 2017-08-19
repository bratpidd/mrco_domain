<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get('post_id');
        echo ($post_id);
        $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
            'post' => $request->get('post')
        );

        return \Response::json( $response );
    }
}
