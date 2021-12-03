<?php

namespace App\Http\Controllers\Cabinet\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class CreateController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('cabinet.posts.create', compact('categories', 'tags'));
    }
}
