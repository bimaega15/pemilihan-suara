<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Master\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'index'])->name('login.index');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/tps', [UsersController::class, 'tps'])->name('users.tps');
    Route::get('/users/getRoles', [UsersController::class, 'getRoles'])->name('users.getRoles');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');
    Route::put('/users/setAktif', [UsersController::class, 'setAktif'])->name('users.setAktif');
    Route::delete('/users/{id}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
});
