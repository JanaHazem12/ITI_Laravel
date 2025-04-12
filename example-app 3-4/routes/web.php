<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Post;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->get('/posts', [PostController::class,'index'])->name('posts');
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
Route::post('/posts/upload/{id}', [PostController::class, 'upload'])->name('posts.upload');
require __DIR__.'/auth.php';
