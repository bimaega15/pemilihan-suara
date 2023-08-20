<?php

use App\Http\Controllers\AboutController as ControllersAboutController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DataPendukungController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\KoordinatorController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PendukungController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TpsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GalleryController as ControllersGalleryController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\StatusRegisController;
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
    Route::get('/register/{tps_id}/getTps', [RegisterController::class, 'getTps'])->name('register.getTps');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/register/checkStatus', [RegisterController::class, 'checkStatus'])->name('register.checkStatus');
    Route::post('/register/checkStatus/postCheckStatus', [RegisterController::class, 'postCheckStatus'])->name('register.checkStatus.postCheckStatus');
});



Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['checkNotLogin']], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home/fetchGrafik', [HomeController::class, 'fetchGrafik'])->name('monitoring.fetchGrafik');
    Route::get('/home/fetchDisplayGrafik', [HomeController::class, 'fetchDisplayGrafik'])->name('home.fetchDisplayGrafik');

    Route::get('/home/semuaSuara', [HomeController::class, 'semuaSuara'])->name('home.semuaSuara');
    Route::get('/home/suaraKoordinator', [HomeController::class, 'suaraKoordinator'])->name('home.suaraKoordinator');
    Route::get('/home/semuaSuaraGrafik', [HomeController::class, 'semuaSuaraGrafik'])->name('home.semuaSuaraGrafik');
    Route::get('/home/suaraKoordinatorGrafik', [HomeController::class, 'suaraKoordinatorGrafik'])->name('home.suaraKoordinatorGrafik');
    Route::get('/home/wilayah', [HomeController::class, 'wilayah'])->name('home.wilayah');


    Route::resource('roles', RolesController::class);

    Route::resource('profile', ProfileController::class)->except(['show']);

    Route::resource('users', UsersController::class)->except(['show']);
    Route::post('users/setAktif', [UsersController::class, 'setAktif'])->name('users.setAktif');
    Route::post('/users/import', [UsersController::class, 'import'])->name('users.import');

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

    Route::resource('koordinator', KoordinatorController::class)->except(['show']);
    Route::get('koordinator/usersKoordinator', [KoordinatorController::class, 'usersKoordinator'])->name('koordinator.usersKoordinator');
    Route::get('koordinator/selectKoordinator', [KoordinatorController::class, 'selectKoordinator'])->name('koordinator.selectKoordinator');
    Route::get('koordinator/saveSession', [KoordinatorController::class, 'saveSession'])->name('koordinator.saveSession');

    Route::resource('pendukung', PendukungController::class)->except(['show']);
    Route::get('pendukung/usersPendukung', [PendukungController::class, 'usersPendukung'])->name('pendukung.usersPendukung');
    Route::get('pendukung/selectPendukung', [PendukungController::class, 'selectPendukung'])->name('pendukung.selectPendukung');
    Route::get('pendukung/selectPendukungTps', [PendukungController::class, 'selectPendukungTps'])->name('pendukung.selectPendukungTps');
    Route::get('pendukung/saveSession', [PendukungController::class, 'saveSession'])->name('pendukung.saveSession');
    Route::post('pendukung/verify', [PendukungController::class, 'verify'])->name('pendukung.verify');

    Route::get('dataPendukung', [DataPendukungController::class, 'index'])->name('dataPendukung.index');
    Route::get('dataPendukung/{id}/uploadBukti', [DataPendukungController::class, 'uploadBukti'])->name('dataPendukung.uploadBukti');
    Route::post('dataPendukung/{id}/store', [DataPendukungController::class, 'store'])->name('dataPendukung.store');
    Route::get('dataPendukung/getHeaderTps', [DataPendukungController::class, 'getHeaderTps'])->name('dataPendukung.getHeaderTps');
    Route::get('dataPendukung/getUserTps', [DataPendukungController::class, 'getUserTps'])->name('dataPendukung.getHeaderTps');
});


Route::get('/', [ControllersHomeController::class, 'index'])->name('home.index');
Route::get('/about', [ControllersAboutController::class, 'index'])->name('about.index');
Route::get('/gallery', [ControllersGalleryController::class, 'index'])->name('gallery.index');
Route::get('/contactUs', [ContactUsController::class, 'index'])->name('contactUs.index');
Route::get('/statusPendaftaran', [StatusRegisController::class, 'index'])->name('tps.index');
