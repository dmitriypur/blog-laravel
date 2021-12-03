<?php

namespace App\Http\Controllers\Cabinet\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Comment\UpdateRequest;
use App\Models\Comment;

class UpdateController extends Controller
{
    public function __invoke(Comment $comment, UpdateRequest $request)
    {
        $data = $request->validated();

        $comment->update($data);

        return redirect(route('cabinet.comment'));
    }
}
