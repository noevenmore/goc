<?php

use Illuminate\Support\Facades\Route;

function register($prefix,$class)
{
    Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('admin_index');

    Route::get('/'.$prefix, [$class, 'show'])->name('admin_'.$prefix.'_show');
    Route::get('/'.$prefix.'/edit/{id}', [$class, 'edit'])->name('admin_'.$prefix.'_edit');
    Route::post('/'.$prefix.'/edit', [$class, 'edit_post'])->name('admin_'.$prefix.'_edit_post');
    Route::get('/'.$prefix.'/new', [$class, 'add'])->name('admin_'.$prefix.'_add');
    Route::post('/'.$prefix.'/new', [$class, 'add_post'])->name('admin_'.$prefix.'_add_post');
    Route::post('/'.$prefix.'/delete', [$class, 'delete_post'])->name('admin_'.$prefix.'_delete_post');
}

Route::prefix('admin')->group(function () {
    Route::post('/loadimage',[App\Http\Controllers\PhotoController::class,'load_image'])->name('admin_loadimage');
    Route::post('/deleteimage',[App\Http\Controllers\PhotoController::class,'delete_image'])->name('admin_deleteimage');
    Route::post('/category_info',[App\Http\Controllers\CategoryController::class,'info'])->name('admin_category_info');

    register('lang',App\Http\Controllers\LangController::class);
    register('category',App\Http\Controllers\CategoryController::class);
    register('post',App\Http\Controllers\PostController::class);
    register('menu_item',App\Http\Controllers\MenuItemController::class);
});

Route::get('/',[\App\Http\Controllers\SiteController::class,'index'])->name('index');
Route::get('/show/{id}/{slug?}',[\App\Http\Controllers\SiteController::class,'post_show'])->name('post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

/*
Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/test',[App\Http\Controllers\LangController::class, 'test'])->name('test');
*/