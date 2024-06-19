<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtilisateurController;

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




Route::middleware(['auth'])->prefix('illustration')->group(function () {

    Route::post('/new', [App\Http\Controllers\IllustrationController::class, 'addPost'])->name('USER-LOGGED-ADD-POST');
    Route::get('/index', [App\Http\Controllers\IllustrationController::class, 'index'])->name('USER-LOGGED-INDEX');
    Route::delete('/delete/{id}', [App\Http\Controllers\IllustrationController::class, 'deleteIllustration'])->name('USER-LOGGED-DELETE-ILUSTRATION');
    Route::get('/add/{titre}', [App\Http\Controllers\IllustrationController::class, 'addComposantIllustration'])->name('USER-LOGGED-ADD-COMPOSANT-ILUSTRATION');
    Route::get('/edit/{titre}', [App\Http\Controllers\IllustrationController::class, 'editComposantIllustration'])->name('USER-LOGGED-EDIT-COMPOSANT-ILUSTRATION');
    Route::get('/voir/{titre}', [App\Http\Controllers\IllustrationController::class, 'afficherIllustration'])->name('USER-LOGGED-AFFICHER-ILUSTRATION')->withoutMiddleware(['auth']);
    Route::post('/postComposant', [App\Http\Controllers\IllustrationController::class, 'postAddComposantIllustration'])->name('USER-LOGGED-POST-ADD-COMPOSANT-ILUSTRATION');
    Route::post('/postEditComposant', [App\Http\Controllers\IllustrationController::class, 'postEditComposantIllustration'])->name('USER-LOGGED-POST-EDIT-COMPOSANT-ILUSTRATION');

    Route::get('/addTraduction/{titre?}/{id_langue?}', [App\Http\Controllers\IllustrationController::class, 'addTraductionComposantIllustration'])->name('USER-LOGGED-ADD-TRADUCTION-COMPOSANT-ILUSTRATION');
    Route::post('/postAddTraductionComposant', [App\Http\Controllers\IllustrationController::class, 'postAddTraductionComposantIllustration'])->name('USER-LOGGED-POST-ADD-TRADUCTION-COMPOSANT-ILUSTRATION');
    Route::get('/editTraduction/{titre?}/{id_langue?}', [App\Http\Controllers\IllustrationController::class, 'editTraductionComposantIllustration'])->name('USER-LOGGED-EDIT-TRADUCTION-COMPOSANT-ILUSTRATION');
    Route::post('/postEditTraductionComposant', [App\Http\Controllers\IllustrationController::class, 'postEditTraductionComposantIllustration'])->name('USER-LOGGED-POST-EDIT-TRADUCTION-COMPOSANT-ILUSTRATION');
    Route::delete('/deleteTraduction/{id}', [App\Http\Controllers\IllustrationController::class, 'deleteIllustrationTraduction'])->name('USER-LOGGED-DELETE-ILUSTRATION-TRADUCTION');

    Route::post('/getTraduction', [App\Http\Controllers\IllustrationController::class, 'getIllustrationTraduction'])->name('USER-LOGGED-GET-ILUSTRATION-TRADUCTION')->withoutMiddleware(['auth']);


});


Route::prefix('utilisateur')->group(function () {

    Route::get('/index', [UtilisateurController::class, 'index'])->name('GESTION-UTILISATEUR');
    Route::get('/edit/{id}', [UtilisateurController::class, 'editUtilisateur'])->name('GESTION-UTILISATEUR-EDIT');
    Route::post('/post', [UtilisateurController::class, 'postUtilisateur'])->name('GESTION-UTILISATEUR-POST');
    Route::delete('/delete/{id}', [UtilisateurController::class, 'deleteUtilisateur'])->name('GESTION-UTILISATEUR-DELETE');


});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('HOME');




