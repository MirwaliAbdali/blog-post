<?php

use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
})->name('home');


Route::get('/about', function () {
    return view('frontend.about.index');
})->name('about');


Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');

Route::get('/post', function () {
    return view('frontend.sample_post.index');
})->name('samplepost');


Route::resource('post', PostController::class);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
