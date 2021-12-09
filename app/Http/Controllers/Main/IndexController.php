<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class IndexController extends Controller
{
    public function __invoke()
    {

        $posts = Post::where('is_published', 1)->with('category', 'likes')->paginate(5);
        $postFavorite = Post::where('favorite', 1)->with('category')->first();
        $categories = Category::with('posts')->get();
        $tags = Tag::all();

        return view('main.index', compact('posts', 'categories', 'tags', 'postFavorite'));
    }
}
