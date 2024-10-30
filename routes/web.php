<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
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

Route::prefix('dashboard')->group(function () {
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('createPost');
        Route::post('/store', [PostController::class, 'store'])->name('storePost');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'tag'], function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::post('/store', [TagController::class, 'store'])->name('tag.store');
        Route::delete('/delete/{id}', [TagController::class, 'destroy'])->name('tag.delete');
        Route::patch('/update/{id}', [TagController::class, 'update'])->name('tag.update');
    });
});

require __DIR__.'/auth.php';
