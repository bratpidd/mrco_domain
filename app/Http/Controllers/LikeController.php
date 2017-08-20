<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->get('post_id');
        //$exist


        $response = array(
            'status' => 'suckcess',
            'msg' => 'Setting created successfully',
            'post' => 'ya tvou mamu ebal'
        );
        //echo 'cock dick';
        return \Response::json( $response );
    }
}
