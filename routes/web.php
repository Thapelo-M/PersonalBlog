<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Models\Articles;
use Illuminate\Routing\RouteRegistrar;

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

Route::get('/', [ArticlesController::class, 'visitorArticles']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route for admin to add an article
Route::get('/add', function() {
    return view('add');
})->middleware(['auth', 'verified'])->name('add');

Route::post('/add-article', [ArticlesController::class, 'addArticle'])->name('add-article');

//Route for admin to delete an Article
Route::get('/show', [ArticlesController::class, 'showArticles'])->middleware(['auth', 'verified'])->name('show');

Route::get('/deleteArticle/{id}', [ArticlesController::class, 'deleteArticle'])->middleware(['auth', 'verified'])->name('delete');

//Route for admin to update an Article
Route::get('/update/{id}', [ArticlesController::class, 'getArticle'])->middleware(['auth', 'verified'])->name('update');

Route::post('/update-article/{id}', [ArticlesController::class, 'updateArticle'])->middleware(['auth', 'verified'])->name('update-article');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/categories', [ArticlesController::class, 'filterByCategory']);

Route::get('/article/{id}', [ArticlesController::class, 'viewArticle'])->name('article');


require __DIR__.'/auth.php';
