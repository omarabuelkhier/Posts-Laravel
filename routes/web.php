<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    #this is my controller function.
    function () {
        return view('welcome');
    }
);

// Route::get('/postsTask', [PostController::class, 'allPosts'])->name("postsTask.all_posts");
// Route::get('/postsTask/post_create', [PostController::class, 'create'])->name("postsTask.post_create");
// Route::post('/postsTask/post_create', [PostController::class, 'store'])->name("postsTask.store");
// Route::get('/postsTask/posts_show/{id}', [PostController::class, 'show'])->name("postsTask.posts_show");
// Route::get('/postsTask/post_update/{id}', [PostController::class, 'edit'])->where('id', '[0-9]')->name('postsTask.edit');
// Route::put('/postsTask/post_update/{id}', [PostController::class, 'update'])->where('id', '[0-9]')->name('postsTask.post_update');
// Route::get('/postsTask/all_posts/{id}/destroy', [PostController::class, 'delete'])->name('postsTask.destroy')->where('id', '[0-9]+');

// Route::view("/notfound", 'notfound');




Route::resource('postsTask', PostController::class);
Route::post('/archive', [PostController::class, 'archive'])->name("postsTask.archive")->withTrashed();
Route::post('/restore/{id}', [PostController::class, 'restore'])->name('postsTask.restore');
Route::delete('/post/{id}/delete', [PostController::class, 'hardDelete'])->name('postsTask.hardDelete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
