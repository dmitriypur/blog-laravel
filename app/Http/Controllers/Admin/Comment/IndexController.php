<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class IndexController extends Controller
{
    public function __invoke()
    {
        $comments = Comment::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.comment.index', compact('comments'));
    }
}
