<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\UpdateRequest;
use App\Models\Comment;

class UpdateController extends Controller
{
    public function __invoke(Comment $comment, UpdateRequest $request)
    {
        $data = $request->validated();

        if(isset($data['is_published'])){
            $data['is_published'] = 1;
        }else{
            $data['is_published'] = 0;
        }

        $comment->update($data);

        return redirect(route('admin.comment'));
    }
}
