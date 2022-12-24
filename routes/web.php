<?php

use App\Http\Controllers\AdminSongsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MusicController::class, 'index'])->name('dashboard');
Route::post('/email', [EmailController::class, 'send'])->name('email');
Route::put('reset-password/{email}', [UserController::class, 'resetPassword']);
Route::view('reset-password', 'auth.reset-password');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('playlist', PlaylistController::class);
    Route::view('profile', 'profile')->name('profile');
    Route::put('update_profile/{id}', [UserController::class, 'updateProfile']);
    Route::put('update_password/{id}', [UserController::class, 'updatePassword']);
});

//Admin Routes...
Route::prefix('admin')
    ->middleware('role:' . \App\Utils\Roles::$ADMIN)
    ->group(function (){
        Route::resource('songs', AdminSongsController::class);
        Route::post('upload', [AdminSongsController::class, 'upload']);
        Route::get('clear_temp', [AdminSongsController::class, 'clearTemp']);
        Route::post('artists/get_artists', [AdminSongsController::class, 'getArtists']);
        Route::resource('users', AdminUserController::class);
        Route::resource('artists', ArtistController::class);
    });