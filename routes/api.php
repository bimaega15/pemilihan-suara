<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Dashboard\HomeController;
use App\Http\Controllers\Api\Korlap\DataPendukungController;
use App\Http\Controllers\Api\Master\JabatanController;
use App\Http\Controllers\Api\Master\KabupatenController;
use App\Http\Controllers\Api\Master\KecamatanController;
use App\Http\Controllers\Api\Master\KelurahanController;
use App\Http\Controllers\Api\Master\ProvinsiController;
use App\Http\Controllers\Api\Master\UsersController;
use App\Http\Controllers\Api\Tps\KoordinatorController;
use App\Http\Controllers\Api\Tps\PendukungController;
use App\Http\Controllers\Api\Tps\TpsController;
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
    Route::get('/home/index', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home/suaraKoordinator', [HomeController::class, 'suaraKoordinator'])->name('home.suaraKoordinator');
    Route::get('/home/pendukungKoordinator', [HomeController::class, 'pendukungKoordinator'])->name('home.pendukungKoordinator');
    Route::get('/home/suaraKoordinatorGrafik', [HomeController::class, 'suaraKoordinatorGrafik'])->name('home.suaraKoordinatorGrafik');

    Route::get('/home/fetchGrafik', [HomeController::class, 'fetchGrafik'])->name('home.fetchGrafik');
    Route::get('/home/semuaSuara', [HomeController::class, 'semuaSuara'])->name('home.semuaSuara');
    Route::get('/home/fetchDisplayGrafik', [HomeController::class, 'fetchDisplayGrafik'])->name('home.fetchDisplayGrafik');
    Route::get('/home/semuaSuaraGrafik', [HomeController::class, 'semuaSuaraGrafik'])->name('home.semuaSuaraGrafik');
    Route::get('/home/wilayah', [HomeController::class, 'wilayah'])->name('home.wilayah');

    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/tps', [UsersController::class, 'tps'])->name('users.tps');
    Route::get('/users/getRoles', [UsersController::class, 'getRoles'])->name('users.getRoles');
    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');
    Route::put('/users/setAktif', [UsersController::class, 'setAktif'])->name('users.setAktif');
    Route::delete('/users/{id}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');

    Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
    Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('kelurahan.index');

    Route::get('/tps', [TpsController::class, 'index'])->name('tps.index');
    Route::post('/tps/store', [TpsController::class, 'store'])->name('tps.store');
    Route::put('/tps/{id}/update', [tpsController::class, 'update'])->name('tps.update');
    Route::delete('/tps/{id}/destroy', [tpsController::class, 'destroy'])->name('tps.destroy');

    Route::get('/koordinator', [KoordinatorController::class, 'index'])->name('koordinator.index');
    Route::post('/koordinator/store', [KoordinatorController::class, 'store'])->name('koordinator.store');
    Route::put('/koordinator/{id}/update', [KoordinatorController::class, 'update'])->name('koordinator.update');
    Route::delete('/koordinator/{id}/destroy', [KoordinatorController::class, 'destroy'])->name('koordinator.destroy');
    Route::get('koordinator/usersKoordinator', [KoordinatorController::class, 'usersKoordinator'])->name('koordinator.usersKoordinator');
    Route::get('koordinator/selectKoordinator', [KoordinatorController::class, 'selectKoordinator'])->name('koordinator.selectKoordinator');

    Route::get('/pendukung', [PendukungController::class, 'index'])->name('pendukung.index');
    Route::post('/pendukung/store', [PendukungController::class, 'store'])->name('pendukung.store');
    Route::put('/pendukung/{id}/update', [PendukungController::class, 'update'])->name('pendukung.update');
    Route::delete('/pendukung/{id}/destroy', [PendukungController::class, 'destroy'])->name('pendukung.destroy');

    Route::get('pendukung/usersPendukung', [PendukungController::class, 'usersPendukung'])->name('pendukung.usersPendukung');
    Route::get('pendukung/selectPendukung', [PendukungController::class, 'selectPendukung'])->name('pendukung.selectPendukung');
    Route::get('pendukung/selectPendukungTps', [PendukungController::class, 'selectPendukungTps'])->name('pendukung.selectPendukungTps');
    Route::get('pendukung/saveSession', [PendukungController::class, 'saveSession'])->name('pendukung.saveSession');
    Route::post('pendukung/verify', [PendukungController::class, 'verify'])->name('pendukung.verify');
    Route::post('pendukung/coblos', [PendukungController::class, 'coblos'])->name('pendukung.coblos');


    Route::get('dataPendukung', [DataPendukungController::class, 'index'])->name('dataPendukung.index');
    Route::get('dataPendukung/{id}/uploadBukti', [DataPendukungController::class, 'uploadBukti'])->name('dataPendukung.uploadBukti');
    Route::post('dataPendukung/{id}/uploadCoblos', [DataPendukungController::class, 'uploadCoblos'])->name('dataPendukung.uploadCoblos');
    Route::post('dataPendukung/{id}/store', [DataPendukungController::class, 'store'])->name('dataPendukung.store');
    Route::get('dataPendukung/getHeaderTps', [DataPendukungController::class, 'getHeaderTps'])->name('dataPendukung.getHeaderTps');
    Route::get('dataPendukung/getUserTps', [DataPendukungController::class, 'getUserTps'])->name('dataPendukung.getUserTps');
});
