<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [BlogController::class,'index'])->name('post.index');
Route::middleware(['auth'])->group(function(){
    // post routes
    // Route::resources([BlogController::class]);
    Route::get('post/create',[BlogController::class,'create'])->name('post.create');
    Route::post('post/store',[BlogController::class,'store'])->name('post.store');
    Route::get('post/show/{id}',[BlogController::class,'show'])->name('post.show');
    Route::get('post/edit/{id}',[BlogController::class,'edit'])->name('post.edit');
    Route::get('post/delete/{id}',[BlogController::class,'delete'])->name('post.delete');
    Route::patch('post/update/{id}',[BlogController::class,'update'])->name('post.update');
    // categories
    Route::get('category/index',[CategoryController::class,'index'])->name('category.index');
    Route::get('category/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
    Route::get('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    // admin post actions
    Route::get('/admin', [BlogController::class,'adminIndex'])->name('admin.index');
    Route::get('admin/post/publish/{id}',[BlogController::class,'adminPublish'])->name('post.publish.admin');
    Route::get('admin/post/delete/{id}',[BlogController::class,'adminDelete'])->name('post.delete.admin');
    Route::get('admin/post/draft/{id}',[BlogController::class,'adminDraft'])->name('post.draft.admin');
    
    Route::get('user/blogs/{name}/{id}',[UserController::class,'userBlogs'])->name('user.blogs');
});