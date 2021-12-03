<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try{
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

            $data['image'] = Post::uploadImage($request);

            $post = Post::firstOrCreate($data);

            $post->tags()->attach($tagIds);

        }catch (\Exception $exception){
            abort(404);
        }

        return redirect(route('admin.post.index'))->with('success', 'Пост добавлен');
    }
}
