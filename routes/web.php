<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', 'HomeController@login')->name('login');
Route::get('/register', 'HomeController@register')->name('register');
Route::group(['namespace'=> 'Main'], function(){
    Route::get('/', 'IndexController')->name('home');
    Route::get('/posts/{post}', 'ShowController')->name('post.show');

    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function(){
        Route::post('/', 'StoreController')->name('post.comment.store');
    });

    Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function(){
        Route::post('/', 'StoreController')->name('post.like.store');
    });

    Route::group(['namespace' => 'Like2', 'prefix' => '{post}/likes2'], function(){
        Route::post('/', 'StoreController')->name('post.like2.store');
    });

    Route::group(['namespace' => 'Search', 'prefix' => 'search'], function(){
        Route::get('/', 'SearchController')->name('search');
    });
});

Route::group(['namespace'=> 'Category', 'prefix' => 'categories'], function(){
    Route::get('/', 'IndexController')->name('category.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{category}/posts'], function(){
        Route::get('/', 'IndexController')->name('category.post.index');
    });
});

Route::group(['namespace'=> 'Tag', 'prefix' => 'tags'], function(){
    Route::get('/', 'IndexController')->name('tag.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{tag}/posts'], function(){
        Route::get('/', 'IndexController')->name('tag.post.index');
    });
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth','admin', 'verified']], function(){
    Route::get('/', 'IndexController')->name('admin.home');
    Route::group(['namespace'=> 'Main'], function(){
        Route::get('/posts', 'IndexController')->name('admin.posts');
    });
    Route::group(['namespace'=> 'Post', 'prefix' => 'posts'], function(){
        Route::get('/', 'IndexController')->name('admin.post.index');
        Route::get('/create', 'CreateController')->name('admin.post.create');
        Route::post('/', 'StoreController')->name('admin.post.store');
        Route::get('/{post}/edit', 'EditController')->name('admin.post.edit');
        Route::patch('/{post}/update', 'UpdateController')->name('admin.post.update');
        Route::delete('/{post}/delete', 'DestroyController')->name('admin.post.delete');
    });
    Route::group(['namespace'=> 'Category', 'prefix' => 'categories'], function(){
        Route::get('/', 'IndexController')->name('admin.category.index');
        Route::get('/create', 'CreateController')->name('admin.category.create');
        Route::post('/', 'StoreController')->name('admin.category.store');
        Route::get('/{category}/edit', 'EditController')->name('admin.category.edit');
        Route::patch('/{category}/update', 'UpdateController')->name('admin.category.update');
        Route::delete('/{category}/delete', 'DestroyController')->name('admin.category.delete');
    });
    Route::group(['namespace'=> 'Tag', 'prefix' => 'tags'], function(){
        Route::get('/', 'IndexController')->name('admin.tag.index');
        Route::get('/create', 'CreateController')->name('admin.tag.create');
        Route::post('/', 'StoreController')->name('admin.tag.store');
        Route::get('/{tag}/edit', 'EditController')->name('admin.tag.edit');
        Route::patch('/{tag}/update', 'UpdateController')->name('admin.tag.update');
        Route::delete('/{tag}/delete', 'DestroyController')->name('admin.tag.delete');
    });
    Route::group(['namespace'=> 'User', 'prefix' => 'users'], function(){
        Route::get('/', 'IndexController')->name('admin.user.index');
        Route::get('/create', 'CreateController')->name('admin.user.create');
        Route::post('/', 'StoreController')->name('admin.user.store');
        Route::get('/{user}/edit', 'EditController')->name('admin.user.edit');
        Route::patch('/{user}/update', 'UpdateController')->name('admin.user.update');
        Route::delete('/{user}/delete', 'DestroyController')->name('admin.user.delete');
    });
    Route::group(['namespace'=> 'Comment'], function(){
        Route::get('/comment', 'IndexController')->name('admin.comment');
        Route::get('/{comment}/edit', 'EditController')->name('admin.comment.edit');
        Route::patch('/{comment}', 'UpdateController')->name('admin.comment.update');
        Route::delete('/{comment}/delete', 'DestroyController')->name('admin.comment.delete');
    });
});


Route::group(['namespace' => 'Cabinet', 'prefix' => 'cabinet', 'middleware' => ['auth','cabinet', 'verified']], function(){
    Route::get('/', 'IndexController')->name('cabinet.home');

    Route::group(['namespace'=> 'Liked'], function(){
        Route::get('/liked', 'IndexController')->name('cabinet.liked');
        Route::delete('/{like}', 'DeleteController')->name('cabinet.liked.delete');
    });

    Route::group(['namespace'=> 'User'], function(){
        Route::patch('/{user}/update', 'UpdateController')->name('cabinet.user.update');
    });
    Route::group(['namespace'=> 'Comment'], function(){
        Route::get('/comment', 'IndexController')->name('cabinet.comment');
        Route::get('/{comment}/edit', 'EditController')->name('cabinet.comment.edit');
        Route::patch('/{comment}', 'UpdateController')->name('cabinet.comment.update');
        Route::delete('/{comment}/delete', 'DestroyController')->name('cabinet.comment.delete');
    });

    Route::group(['namespace'=> 'Post', 'prefix' => 'posts'], function(){
        Route::get('/', 'IndexController')->name('cabinet.post.index');
        Route::get('/create', 'CreateController')->name('cabinet.post.create');
        Route::post('/', 'StoreController')->name('cabinet.post.store');
        Route::get('/{post}/edit', 'EditController')->name('cabinet.post.edit');
        Route::patch('/{post}/update', 'UpdateController')->name('cabinet.post.update');
        Route::delete('/{post}/delete', 'DestroyController')->name('cabinet.post.delete');
    });
});


Route::get('/page/{slug}', 'PageController@show')->name('page.show');


Auth::routes();

