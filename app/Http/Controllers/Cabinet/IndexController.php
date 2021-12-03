<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::where('user_id', auth()->user()->id)->get();
        return view('cabinet.index', compact('posts'));
    }
}
