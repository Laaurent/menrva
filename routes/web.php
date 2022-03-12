<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\UserController;

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
    return view('home');
})->name('home');

Route::get('/rechercher', function () {
    return view('home');
})->name('search');

// A DELETE

// USER
Route::get('/user/{id}', [UserController::class, 'read'])->name('user.read');


Route::group(
    ['middleware' => 'auth'],
    function () {

        // USER
        Route::get('/profil', [UserController::class, 'index'])->name('profil');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/auth', [UserController::class, 'auth'])->name('user.auth');

        // FORMATION
        Route::post('/formation/store', [FormationController::class, 'store'])->name('formation.store');
        Route::post('/formation/delete', [FormationController::class, 'delete'])->name('formation.delete');

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
