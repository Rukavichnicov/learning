<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\Admin\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/redis', [\App\Http\Controllers\RedisController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog',
];

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [\App\Http\Controllers\DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');
});

Route::group($groupData, function () {
    //BlogCategories
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPosts
    Route::resource('posts', \App\Http\Controllers\Blog\Admin\PostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});
