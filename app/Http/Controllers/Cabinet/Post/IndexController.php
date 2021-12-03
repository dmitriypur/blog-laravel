<?php

namespace App\Http\Controllers\Cabinet\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $userId = auth()->user()->id;
        $posts = Post::where('user_id', $userId)->paginate(20);

        return view('cabinet.posts.index', compact('posts'));
    }
}
