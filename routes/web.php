<?php

use App\Http\Controllers\AboutController as ControllersAboutController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TpsController;
use App\Http\Controllers\Admin\TpsDetailController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GalleryController as ControllersGalleryController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\TpsController as ControllersTpsController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/clear', function () {
    Artisan::call('route:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
});

Route::group(['middleware' => ['checkAlreadyLogin', 'throttle:login']], function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'index'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(['guest', 'throttle:10,1'])
        ->name('login.attempt');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['checkNotLogin']], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');

    Route::resource('roles', RolesController::class);

    Route::resource('profile', ProfileController::class);

    Route::resource('users', UsersController::class)->except(['show']);
    Route::post('users/setAktif', [UsersController::class, 'setAktif'])->name('users.setAktif');

    Route::resource('konfigurasi', KonfigurasiController::class);

    Route::resource('menu', MenuController::class)->except('show');
    Route::post('menu/{menu}/postSubMenu', [MenuController::class, 'postSubMenu'])->name('menu.postSubmenu');
    Route::get('menu/showMenu', [MenuController::class, 'showMenu'])->name('menu.showMenu');

    Route::resource('access', AccessController::class)->except('show');
    Route::get('access/managementMenu', [AccessController::class, 'managementMenu'])->name('access.managementMenu');
    Route::get('access/managementMenuById', [AccessController::class, 'managementMenuById'])->name('access.managementMenuById');
    Route::post('access/updateAccess', [AccessController::class, 'updateAccess'])->name('access.updateAccess');

    // 
    Route::resource('tps', TpsController::class)->except(['show']);
    Route::get('/tps/getKoordinator', [TpsController::class, 'getKoordinator'])->name('tps.getKoordinator');

    Route::resource('tpsDetail', TpsDetailController::class)->except(['show']);
    Route::post('/tpsDetail/{id}/uploadBuktiCoblos', [TpsDetailController::class, 'uploadBuktiCoblos'])->name('tpsDetail.uploadBuktiCoblos');
    Route::post('/tpsDetail/{id}/verificationCoblos', [TpsDetailController::class, 'verificationCoblos'])->name('tpsDetail.verificationCoblos');


    Route::resource('jabatan', JabatanController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('about', AboutController::class)->except(['show']);
    Route::post('about/setAktif', [AboutController::class, 'setAktif'])->name('about.setAktif');
    Route::post('/about/deleteMultipleImage', [AboutController::class, 'deleteMultipleImage'])->name('gambar.deleteMultipleImage');

    Route::resource('gallery', GalleryController::class);
    Route::resource('provinsi', ProvinsiController::class);
    Route::resource('kabupaten', KabupatenController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);

    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{id}/detail', [MonitoringController::class, 'detail'])->name('monitoring.detail');
    Route::get('/monitoring/fetchDukungan', [MonitoringController::class, 'fetchDukungan'])->name('monitoring.fetchDukungan');
    Route::get('/monitoring/fetchProgres', [MonitoringController::class, 'fetchProgres'])->name('monitoring.fetchProgres');
    Route::get('/monitoring/fetchGrafik', [MonitoringController::class, 'fetchGrafik'])->name('monitoring.fetchGrafik');
    Route::get('/monitoring/fetchDisplayGrafik', [MonitoringController::class, 'fetchDisplayGrafik'])->name('monitoring.fetchDisplayGrafik');
});

Route::get('/', [ControllersHomeController::class, 'index'])->name('home.index');
Route::get('/about', [ControllersAboutController::class, 'index'])->name('about.index');
Route::get('/gallery', [ControllersGalleryController::class, 'index'])->name('gallery.index');
Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contactUs.index');
Route::get('/tps', [ControllersTpsController::class, 'index'])->name('tps.index');

