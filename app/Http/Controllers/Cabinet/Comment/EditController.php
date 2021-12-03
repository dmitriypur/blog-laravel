<?php

namespace App\Http\Controllers\Cabinet\Comment;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;

class EditController extends Controller
{
    public function __invoke(Comment $comment)
    {

        return view('cabinet.comment.edit', compact('comment'));
    }
}
