<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| Routes Web
|--------------------------------------------------------------------------
*/

// 🌐 Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'submitLogin'])->name('loginSubmit');
Route::get('/register', [AuthController::class, 'register'])->name('Register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/registerSubmit', [AuthController::class, 'submitRegister'])->name('registersubmit');

// 📝 Questions (CRUD)
Route::resource('questions', QuestionController::class);

// ⚡ Routes protégées (auth) pour actions spécifiques
Route::middleware('auth')->group(function () {
Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    // 🔹 Favoris
    Route::post('/questions/{id}/favorite', [FavoriteController::class, 'toggle'])
        ->name('favorite.toggle');

    Route::get('/favorite', [FavoriteController::class, 'index'])
        ->name('favorite.index');

    // 🔹 Réponses
    Route::post('/questions/{question}/reponse', [ResponseController::class, 'store'])
        ->name('reponse.store');

    Route::put('/reponses/{id}', [ResponseController::class, 'update'])
        ->name('reponse.update');
    Route::get('/reponses/{id}', [ResponseController::class, 'edit'])
        ->name('reponse.edit');

    Route::delete('/reponses/{id}', [ResponseController::class, 'destroy'])
        ->name('reponse.destroy');
});

// 🔐 Routes admin (auth + admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {

    // Admin : toutes les questions
    Route::get('/admin/questions', [QuestionController::class, 'adminIndex'])
        ->name('questions.admin.index');

    Route::put('/admin/questions/{id}', [QuestionController::class, 'updateAdmin'])
        ->name('questions.admin.update');

    Route::delete('/admin/questions/{id}', [QuestionController::class, 'destroyAdmin'])
        ->name('questions.admin.destroy');

    // Admin : toutes les réponses (optionnel, service gère déjà les permissions)
    Route::get('/admin/reponses', [ResponseController::class, 'indexAdmin'])
        ->name('reponses.admin.index');
    
    Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('dasbord');;
});
