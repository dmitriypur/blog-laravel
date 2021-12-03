<?php

namespace App\Http\Controllers\Cabinet\Comment;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $comments = auth()->user()->comments()->paginate(20);
        return view('cabinet.comment.index', compact('comments'));
    }
}
