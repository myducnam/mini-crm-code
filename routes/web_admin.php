<?php

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

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('', [HomeController::class, 'index'])->name('home');

    Route::resource('company', CompanyController::class)
        ->only([
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);

    Route::resource('employe', EmployeController::class)
        ->only([
            'index',
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);
});
