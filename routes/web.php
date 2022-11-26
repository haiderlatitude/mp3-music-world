<?php

use App\Http\Controllers\AdminSongsController;

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::view('test', 'test');

//Admin Routes...
Route::prefix('admin')
    ->middleware('role:' . \App\Utils\Roles::$ADMIN)
    ->group(function (){
        Route::resource('songs', AdminSongsController::class);
        Route::post('upload', [AdminSongsController::class, 'upload']);
        Route::get('clear_temp', [AdminSongsController::class, 'clearTemp']);
        Route::post('artists/get_artists', [AdminSongsController::class, 'getArtists']);
        Route::resource('users', AdminUserController::class);
    });
