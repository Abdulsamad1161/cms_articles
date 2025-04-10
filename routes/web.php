<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
  return view('auth.login');
});

Route::post('/logout', [\Laravel\Jetstream\Http\Controllers\LogoutController::class, 'store'])->name('logout');

// Public Article Routes (no authentication required)
Route::get('/publish/cms', [PublicArticleController::class, 'cms'])->name('publish.cms');

// Group all authenticated routes together
Route::middleware(['auth'])->group(function () {
  Route::get('/published-articles', [ArticleController::class, 'published'])->name('articles.published');
    // Published and Draft Articles Routes (Only authenticated users can access)
    Route::get('/draft-articles', [ArticleController::class, 'drafts'])->name('articles.drafts');
    
    // Resourceful route for articles (CRUD operations)
    Route::resource('articles', ArticleController::class);
    
    // Admin and Sub-admin specific routes
    Route::middleware(['role:admin,sub-admin'])->group(function () {
        // Routes for viewing articles
        Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    });

    // Admin-specific routes (creating, updating, deleting articles)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    });
});

// CKEditor upload route (No authentication required)
Route::post('/ckeditor/upload', [ArticleController::class, 'upload'])->name('ckeditor.upload');


require __DIR__ . '/auth.php';