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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('playlist', PlaylistController::class);
    Route::post('getPlaylists', [PlaylistController::class, 'getPlaylists']);
    Route::post('/', [MusicController::class, 'store']);
    Route::post('/remove', [MusicController::class, 'update']);
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
