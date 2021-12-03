<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Category::firstOrCreate(['title' => $data['title']]);

        return 1;

//        return redirect(route('admin.category.index'))->with('success', 'Категория добавлена');
    }
}
