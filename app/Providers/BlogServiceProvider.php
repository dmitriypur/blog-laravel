<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->topMenu();
    }

    //Sidebar menu
    public function topMenu(){
        View::composer('part.menu', function($view){
            $view->with('categories', Category::where('parent_id', 0)->where('is_published', 1)->get());
        });
    }
}
