<?php

namespace App\Http\Controllers\Cabinet\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class EditController extends Controller
{
    public function __invoke(Comment $comment)
    {

        return view('cabinet.comment.edit', compact('comment'));
    }
}
