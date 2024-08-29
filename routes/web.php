<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    #this is my controller function.
    function () {
        return view('welcome');
    }
);

Route::resource('posts', PostController::class);
Route::post('/archive', [PostController::class, 'archive'])->name("posts.archive")->withTrashed();
Route::post('/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/post/{id}/delete', [PostController::class, 'hardDelete'])->name('posts.hardDelete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
