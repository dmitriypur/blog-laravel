<?php

namespace App\Http\Controllers\Cabinet\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(User $user, UpdateRequest $request)
    {
        $data = $request->validated();


        if(isset($data['photo'])){
            $folder = date('Y-m-d');
            $data['photo'] = Storage::disk('public')->put("/avatar/{$folder}", $data['photo']);
        }

//        dd($data['photo']);
        $user->update($data);


        return redirect(route('cabinet.home'));
    }
}
