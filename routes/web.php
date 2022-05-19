<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to("/articles");
    } else {
        return Redirect::to("/register");
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [ArticlesController::class, 'show'])->name('dashboard');
    // show old articles
    Route::get('/articles', [ArticlesController::class, 'show'])->name("articles");
    // creat new article
    Route::get('/new-article', function () {
        return Inertia::render('NewArticle');
    })->name("new-article");
    // creat article action
    Route::post('/new-article', [ArticlesController::class, 'create'])->name("creat-new-article");
});
