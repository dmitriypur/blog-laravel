<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Post $post, UpdateRequest $request)
    {
        $data = $request->validated();

        if(isset($data['is_published'])){
            $data['is_published'] = 1;
        }else{
            $data['is_published'] = 0;
        }

        if(isset($data['favorite'])){
            $data['favorite'] = 1;
        }else{
            $data['favorite'] = 0;
        }

        if(!isset($data['tag_ids'])){
            $tagIds = [];
        }else{
            $tagIds = $data['tag_ids'];
        }

        unset($data['tag_ids']);


        if(!isset($data['image'])){
            $data['image'] = $post->image;
        }else{
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }


        $post->update($data);

        $post->tags()->sync($tagIds);


        return redirect(route('admin.post.index'));
    }
}
