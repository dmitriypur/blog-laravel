<?php

namespace App\Http\Controllers\Cabinet\Liked;

use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke($id)
    {
        auth()->user()->likedPosts()->detach($id);

        return redirect(route('cabinet.liked'));
    }
}
