<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DataTestingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\JawabanKuisionerController;
use App\Http\Controllers\Admin\KabupatenController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\KuisionerController;
use App\Http\Controllers\Admin\PernyataanController;
use App\Http\Controllers\Admin\PernyataanDetailController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProvinsiController;
use App\Http\Controllers\Admin\RangeBobotController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TpsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\HomeController as HomeControllerUser;
use App\Http\Controllers\User\ContactsController;
use App\Http\Controllers\User\DiagnosaController;
use App\Http\Controllers\User\HasilController as HasilUsersController;

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
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['checkNotLogin']], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');

    Route::resource('roles', RolesController::class);

    Route::resource('profile', ProfileController::class);

    Route::resource('users', UsersController::class);

    Route::resource('konfigurasi', KonfigurasiController::class);

    Route::resource('menu', MenuController::class)->except('show');
    Route::post('menu/{menu}/postSubMenu', [MenuController::class, 'postSubMenu'])->name('menu.postSubmenu');
    Route::get('menu/showMenu', [MenuController::class, 'showMenu'])->name('menu.showMenu');

    Route::resource('access', AccessController::class)->except('show');
    Route::get('access/managementMenu', [AccessController::class, 'managementMenu'])->name('access.managementMenu');
    Route::get('access/managementMenuById', [AccessController::class, 'managementMenuById'])->name('access.managementMenuById');
    Route::post('access/updateAccess', [AccessController::class, 'updateAccess'])->name('access.updateAccess');

    // 
    Route::resource('tps', TpsController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('about', AboutController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('provinsi', ProvinsiController::class);
    Route::resource('kabupaten', KabupatenController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::resource('kelurahan', KelurahanController::class);
});
