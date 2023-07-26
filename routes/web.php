<?php

use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\DataTestingController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JawabanKuisionerController;
use App\Http\Controllers\Admin\KonfigurasiController;
use App\Http\Controllers\Admin\KuisionerController;
use App\Http\Controllers\Admin\PernyataanController;
use App\Http\Controllers\Admin\PernyataanDetailController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RangeBobotController;
use App\Http\Controllers\Admin\RolesController;
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

    Route::resource('kuisioner', KuisionerController::class)->except(['show']);
    Route::get('/kuisioner/autoNumber', [KuisionerController::class, 'autoNumber'])->name('kuisioner.autoNumber');

    Route::resource('jawabanKuisioner', JawabanKuisionerController::class)->except(['show']);
    Route::get('/jawabanKuisioner/autoNumber', [JawabanKuisionerController::class, 'autoNumber'])->name('jawabanKuisioner.autoNumber');

    Route::resource('pernyataan', PernyataanController::class)->except(['show']);
    Route::get('/pernyataan/autoNumber', [PernyataanController::class, 'autoNumber'])->name('pernyataan.autoNumber');

    Route::get('/pernyataanDetail/{id}/index', [PernyataanDetailController::class, 'index'])->name('pernyataanDetail.index');
    Route::post('/pernyataanDetail/{id}/store', [PernyataanDetailController::class, 'store'])->name('pernyataanDetail.store');

    Route::resource('rangeBobot', RangeBobotController::class);

    Route::get('/dataTesting', [DataTestingController::class, 'index'])->name('dataTesting.index');
    Route::post('/dataTesting/store', [DataTestingController::class, 'store'])->name('dataTesting.store');
    Route::get('/dataTesting/storeSession', [DataTestingController::class, 'storeSession'])->name('dataTesting.storeSession');
    Route::get('/dataTesting/getStoreSession', [DataTestingController::class, 'getStoreSession'])->name('dataTesting.getStoreSession');

    Route::resource('hasil', HasilController::class)->except(['show']);
    Route::get('/hasil/{id}/detail', [HasilController::class, 'detail'])->name('hasil.detail');
});

Route::get('/', [HomeControllerUser::class, 'index'])->name('home.index');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
Route::group(['prefix' => 'users/', 'as' => 'users.'], function () {
    Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
    Route::post('/diagnosa/store', [DiagnosaController::class, 'store'])->name('diagnosa.store');
    Route::get('/diagnosa/storeSession', [DiagnosaController::class, 'storeSession'])->name('diagnosa.storeSession');
    Route::get('/diagnosa/getStoreSession', [DiagnosaController::class, 'getStoreSession'])->name('diagnosa.getStoreSession');

    Route::resource('hasil', HasilUsersController::class)->except(['show']);
    Route::get('/hasil/{id}/detail', [HasilUsersController::class, 'detail'])->name('hasil.detail');
});
