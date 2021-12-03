<?php

namespace App\Http\Controllers\Category\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke(Category $category)
    {

        $posts = $category->posts;

        return view('category.post.index', compact('posts'));
    }
}
