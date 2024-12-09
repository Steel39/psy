<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\Pages\MainPageController;
use App\Http\Controllers\Admin\Pages\ServicePageController;
use App\Http\Controllers\Admin\Pages\ContactPageController;
use App\Http\Controllers\Admin\Pages\FeedbackPageController;
use App\Http\Controllers\Admin\Pages\AboutPageController;
use App\Http\Controllers\Admin\Pages\AnswerPageController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\User\IndexController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('welcome');

Route::group([''], function () {
    Route::get('/', [IndexController::class, 'index'])->name('welcome');
    Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
    Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
    Route::get('/about', [IndexController::class, 'about'])->name('about');
    Route::get('/answer', [IndexController::class, 'answer'])->name('answer');
    Route::get('/feedback', [IndexController::class, 'feedback'])->name('feedback');
    Route::get('/services', [IndexController::class, 'service'])->name('service');
    Route::get('/certificates', [IndexController::class, 'certificate'])->name('certificate');
    Route::get('/post/{id}', [IndexController::class, 'post'])->name('post');
    Route::get('/posts_of_category/{category_name}/{id}', [IndexController::class, 'categoryPost'])->name('category.posts');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/question', [UserQuestionController::class, 'index'])->name('user.question.index');
Route::post('/question/store', [UserQuestionController::class, 'store'])->name('user.question.store');

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
        Route::get('/show/{id}', [PostController::class, 'show'])->name('post.show');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');
        Route::put('/delete_image/{id}', [PostController::class, 'deletePostImage'])->name('post.delete.image');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'tag'], function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::post('/store', [TagController::class, 'store'])->name('tag.store');
        Route::delete('/delete/{id}', [TagController::class, 'destroy'])->name('tag.delete');
        Route::patch('/update/{id}', [TagController::class, 'update'])->name('tag.update');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'certificate'], function () {
        Route::get('/', [CertificateController::class, 'index'])->name('certificate.index');
        Route::post('/store', [CertificateController::class, 'store'])->name('certificate.store');
        Route::delete('/delete/{id}', [CertificateController::class, 'destroy'])->name('certificate.delete');
        Route::patch('/update/{id}', [CertificateController::class, 'update'])->name('certificate.update');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'question'], function () {
        Route::get('/', [QuestionController::class, 'index'])->name('admin.question.index');
        Route::delete('/delete/{id}', [QuestionController::class, 'destroy'])->name('admin.question.delete');
    });
    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user-page'], function () {
        Route::group(['prefix' => 'main'], function () {
            Route::get('/', [MainPageController::class, 'index'])->name('admin.page.main');
            Route::post('/store', [MainPageController::class, 'store'])->name('admin.page.main.store');
            Route::put('/update/{id}', [MainPageController::class, 'update'])->name('admin.page.main.update');
            Route::delete('/delete/{id}', [MainPageController::class, 'destroy'])->name('admin.page.main.delete');
        });
        Route::group(['prefix' => 'services'], function () {
            Route::get('/', [ServicePageController::class, 'index'])->name('admin.page.service');
            Route::post('/store', [ServicePageController::class, 'store'])->name('admin.page.service.store');
            Route::put('/update', [ServicePageController::class, 'update'])->name('admin.page.service.update');
            Route::delete('/delete/{id}', [ServicePageController::class, 'destroy'])->name('admin.page.service.delete');
        });
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', [ContactPageController::class, 'index'])->name('admin.page.contact');
            Route::post('/store', [ContactPageController::class, 'store'])->name('admin.page.contact.store');
            Route::put('/update', [ContactPageController::class, 'update'])->name('admin.page.contact.update');
        });
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', [AboutPageController::class, 'index'])->name('admin.page.about');
            Route::post('/store', [AboutPageController::class, 'store'])->name('admin.page.about.store');
            Route::put('/update/{id}', [AboutPageController::class, 'update'])->name('admin.page.about.update');
            Route::delete('/update/{id}', [AboutPageController::class, 'destroy'])->name('admin.page.about.delete');
        });
        Route::group(['prefix' => 'feedback'], function () {
            Route::get('/', [FeedbackPageController::class, 'index'])->name('admin.page.feedback');
            Route::post('/store', [FeedbackPageController::class, 'store'])->name('admin.page.feedback.store');
            Route::put('/update', [FeedbackPageController::class, 'update'])->name('admin.page.feedback.update');
        });
        Route::group(['prefix' => 'answer'], function () {
            Route::get('/', [AnswerPageController::class, 'index'])->name('admin.page.answer');
            Route::post('/store', [AnswerPageController::class, 'store'])->name('admin.page.answer.store');
            Route::put('/update', [AnswerPageController::class, 'update'])->name('admin.page.answer.update');
            Route::put('/delete/{id}', [AnswerPageController::class, 'destroy'])->name('admin.page.answer.delete');
        });
    });
});

require __DIR__ . '/auth.php';
