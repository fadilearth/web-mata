<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ManageAdminController;
use App\Http\Controllers\Admin\ManagePasienController;
use App\Http\Controllers\AnalisaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Front\Admin\DashboardController;
use App\Http\Controllers\Front\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('analisa', [AnalisaController::class, 'index'])->name('analisa');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'loginAct'])->name('loginAct');
Route::post('register', [AuthController::class, 'registerAct'])->name('registerAct');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:pasien']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
});

Route::group(['prefix' => 'A'], function () {
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('manage-admin/load_data', [ManageAdminController::class, 'load_data'])->name('admin.manage-admin.load_data');
        Route::resource('manage-admin', ManageAdminController::class);

        // Data Pasien
        Route::get('manage-pasien/load_data', [ManagePasienController::class, 'load_data'])->name('admin.manage-pasien.load_data');
        Route::resource('manage-pasien', ManagePasienController::class);

        Route::get('profile', [AuthController::class, 'profile'])->name('admin.profile');
    });
});
