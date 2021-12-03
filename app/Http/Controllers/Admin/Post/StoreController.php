<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

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

            if(isset($data['image'])){
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }

            dd($request['image']);

            $post = Post::firstOrCreate($data);

            $post->tags()->attach($tagIds);

        }catch (\Exception $exception){
            abort(404);
        }

        return redirect(route('admin.post.index'));
    }
}
