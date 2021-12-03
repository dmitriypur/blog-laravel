<?php

namespace App\Http\Controllers\Cabinet\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try{
            $data = $request->validated();

            if(!isset($data['tag_ids'])){
                $tagIds = [];
            }else{
                $tagIds = $data['tag_ids'];
            }

            unset($data['tag_ids']);

            if(isset($data['image'])){
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }
            $post = Post::firstOrCreate($data);

            $post->tags()->attach($tagIds);
        }catch (\Exception $exception){
            abort(404);
        }


        return redirect(route('cabinet.post.index'));
    }
}
