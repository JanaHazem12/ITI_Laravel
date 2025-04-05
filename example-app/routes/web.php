<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts', [PostController::class,'index'])->name('posts');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
// Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');

// Route to show the edit form
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
// Route to handle the update
Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');

