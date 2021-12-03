<?php

namespace App\Http\Controllers\Cabinet\Liked;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()->likedPosts;

        return view('cabinet.liked.index', compact('posts'));
    }
}
