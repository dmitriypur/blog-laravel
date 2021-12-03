<?php

namespace App\Http\Controllers\Main\Like2;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\PostIpLike;

class StoreController extends Controller
{
    public function __invoke(Post $post)
    {

        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        elseif(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        $likeIp = Like::where('post_id', $post->id)->get();

        $data = [
            'post_id' => $post->id,
            'user_ip' => $ip,
        ];
        if($likeIp->contains('user_ip', $ip)){
            foreach ($likeIp as $item){
                if($item->user_ip == $ip ){
                    $item->delete();
                }
            }
        }else{
            Like::create($data);
        }

        return redirect()->route('home');

    }
}
