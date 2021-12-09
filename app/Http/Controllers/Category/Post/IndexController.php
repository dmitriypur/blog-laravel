<?php

namespace App\Http\Controllers\Category\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->with('category', 'tags', 'likes')->get();

        return view('category.post.index', compact('posts'));
    }
}
