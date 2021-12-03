<?php

namespace App\Http\Controllers\Main\Search;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {

        $request->validate([
            's' => 'required'
        ]);

        $s = $request->s;

        $posts = Post::like($s)->with('category')->paginate(12);

        return view('main.search', compact('posts', 's'));
    }
}
