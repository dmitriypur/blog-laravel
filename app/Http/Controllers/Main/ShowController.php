<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;


class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $date = Carbon::parse($post->created_at);
        $tags = Tag::all();
        $categories = Category::with('posts')->get();
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->with('category')
            ->get()
            ->take(2);
        $likedPosts = Post::withCount('likedUsers')->orderby('liked_users_count', 'DESC')->get()->take(4);

        event('postHasViewed', $post);

        return view('main.show', compact('post','relatedPosts', 'likedPosts', 'categories', 'tags', 'date'));
    }
}
