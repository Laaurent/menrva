<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LikeController;

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

Route::view('/', 'welcome')->name('home');
Route::view('/rechercher', 'home')->name('search');
Route::view('/ma-liste', 'pages.likes.index')->name('my-list');

// A DELETE

// USER
Route::get('/user/{id}', [UserController::class, 'read'])->name('user.read');
Route::post('/users/all', [UserController::class, 'all'])->name('user.all');
Route::get('/users/suggestions/{id}', [UserController::class, 'suggestions'])->name('user.suggestion');
Route::get('/profil/{id?}', [UserController::class, 'index'])->name('profil');
Route::get('/users/lastformation', [UserController::class, 'lastFormation'])->name('user.lastFormation');

Route::group(
    ['middleware' => 'auth'],
    function () {


        //USER

        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/auth', [UserController::class, 'auth'])->name('user.auth');


        // FORMATION
        Route::post('/formation/store', [FormationController::class, 'store'])->name('formation.store');
        Route::post('/formation/delete', [FormationController::class, 'destroy'])->name('formation.delete');

        // EXPERIENCE
        Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
        Route::post('/experience/delete', [ExperienceController::class, 'destroy'])->name('experience.delete');

        //LIKES
        Route::get('/likes', [LikeController::class, 'index'])->name('likes');
        Route::post('/likes', [LikeController::class, 'store'])->name('likes.store');
        Route::post('/likes/delete', [LikeController::class, 'destroy'])->name('likes.destroy');

        Route::get('/parametres', function () {
            return view('home');
        })->name('settings');
    }
);


/* Route::get('test', function () {
    return 'Vue de test';
})->middleware(['auth', 'password.confirm']); */

/**
 * 
 * -------------------------------
 * Email Verification Routes
 * -------------------------------
 *
 */
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
