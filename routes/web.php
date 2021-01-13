<?php

use Illuminate\Support\Facades\Route;

function register($prefix,$class)
{
    Route::get('/'.$prefix, [$class, 'show'])->name('admin_'.$prefix.'_show');
    Route::get('/'.$prefix.'/edit/{id}', [$class, 'edit'])->name('admin_'.$prefix.'_edit');
    Route::post('/'.$prefix.'/edit', [$class, 'edit_post'])->name('admin_'.$prefix.'_edit_post');
    Route::get('/'.$prefix.'/new', [$class, 'add'])->name('admin_'.$prefix.'_add');
    Route::post('/'.$prefix.'/new', [$class, 'add_post'])->name('admin_'.$prefix.'_add_post');
    Route::post('/'.$prefix.'/delete', [$class, 'delete_post'])->name('admin_'.$prefix.'_delete_post');
}

Route::prefix('admin')->group(function () {
    Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('admin_index');
    Route::post('/loadimage',[App\Http\Controllers\PhotoController::class,'load_image'])->name('admin_loadimage');
    Route::post('/deleteimage',[App\Http\Controllers\PhotoController::class,'delete_image'])->name('admin_deleteimage');
    Route::post('/category_info',[App\Http\Controllers\CategoryController::class,'info'])->name('admin_category_info');
    Route::get('/system',[App\Http\Controllers\SystemController::class,'edit'])->name('admin_system_config_edit');
    Route::post('/system',[App\Http\Controllers\SystemController::class,'edit_post'])->name('admin_system_config_edit_post');

    register('lang',App\Http\Controllers\LangController::class);
    register('category',App\Http\Controllers\CategoryController::class);
    register('post',App\Http\Controllers\PostController::class);
    register('menu_item',App\Http\Controllers\MenuItemController::class);
    register('mp_slider',App\Http\Controllers\MainPageSliderController::class);
    register('users',App\Http\Controllers\UserController::class);
    register('social_links',App\Http\Controllers\SocialLinksController::class);
});

Route::get('/',[\App\Http\Controllers\SiteController::class,'index'])->name('index');
Route::get('/lang/{id}',[\App\Http\Controllers\SiteController::class,'set_language'])->name('language');
Route::get('/show/{id}/{slug?}',[\App\Http\Controllers\SiteController::class,'post_show'])->name('post');
Route::get('/category/{id}/{slug?}',[\App\Http\Controllers\SiteController::class,'category_show'])->name('category');
Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
Route::get('/map',[\App\Http\Controllers\SiteController::class,'map'])->name('map');
Route::get('/search',[\App\Http\Controllers\SiteController::class,'search'])->name('search');

Auth::routes();

/*
FOR DEV ONLY
*/
Route::prefix('test')->group(function () {
    Route::get('/make_root',[\App\Http\Controllers\TestController::class,'make_root']);
});