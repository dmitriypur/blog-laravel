<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->tags()->sync([]);
        Storage::disk('public')->delete($post->image);
        $post->delete();

        return redirect(route('admin.post.index'));
    }
}
