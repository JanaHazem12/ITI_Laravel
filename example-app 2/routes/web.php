<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts', [PostController::class,'index'])->name('posts');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');

// COMMENTS //
// Route::get('/posts/comments/{post}', [CommentController::class,'show'])->name('comments.show');
Route::post('/posts/comments/{post}', [CommentController::class,'store'])->name('comments.store');
Route::put('/posts/comments/edit/{post}', [CommentController::class,'edit'])->name('comments.edit');
Route::delete('/posts/comments/del/{post}', [CommentController::class,'delete'])->name('comments.delete');
// COMMENTS //
// Route to show the edit form
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
// Route to handle the update
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::get('/posts/delete/{id}', [PostController::class, 'confirmDelete'])->name('posts.confirmDelete');
Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
// working^^^
Route::post('/posts/restore', [PostController::class, 'restore'])->name('posts.restore');

// SEARCH ABOUT ROUTE RESOURCE
// Route::resource('posts', PostController::class);
// shortcut is an alias of the URL - to call the route by id alatool
// 3ashan law habeit aghayar el route ma3odsh aghayar its name koll shwaya