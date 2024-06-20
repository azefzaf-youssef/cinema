<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\CategoryController;

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
Auth::routes();




Route::middleware(['auth'])->group(function () {

    Route::post('/new', [App\Http\Controllers\MoviesController::class, 'addPost'])->name('MOVIE-ADD-POST');
    Route::get('/', [App\Http\Controllers\MoviesController::class, 'index'])->name('MOVIE-INDEX');
    Route::delete('/delete/{id}', [App\Http\Controllers\MoviesController::class, 'deleteMovie'])->name('MOVIE-DELETE-ILUSTRATION');
    Route::get('/voir/{titre}', [App\Http\Controllers\MoviesController::class, 'afficherMovie'])->name('MOVIE-AFFICHER-ILUSTRATION')->withoutMiddleware(['auth']);



});


Route::prefix('utilisateur')->group(function () {

    Route::get('/index', [UtilisateurController::class, 'index'])->name('GESTION-UTILISATEUR');
    Route::get('/edit/{id}', [UtilisateurController::class, 'editUtilisateur'])->name('GESTION-UTILISATEUR-EDIT');
    Route::post('/post', [UtilisateurController::class, 'postUtilisateur'])->name('GESTION-UTILISATEUR-POST');
    Route::delete('/delete/{id}', [UtilisateurController::class, 'deleteUtilisateur'])->name('GESTION-UTILISATEUR-DELETE');


});

Route::prefix('category')->group(function () {

    Route::get('/index', [CategoryController::class, 'index'])->name('GESTION-CATEGORY');
    Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('GESTION-CATEGORY-EDIT');
    Route::post('/post', [CategoryController::class, 'postCategory'])->name('GESTION-CATEGORY-POST');
    Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('GESTION-CATEGORY-DELETE');


});




