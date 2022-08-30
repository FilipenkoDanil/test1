<?php

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


Auth::routes();

Route::group(['middleware' => 'user-role'], function () {
    Route::get('/');
});

Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::post('/user/create-ticket', [\App\Http\Controllers\UserController::class, 'create'])->name('create-ticket');
});

Route::group(['middleware' => ['role:manager', 'auth']], function () {
    Route::get('/manager', [\App\Http\Controllers\ManagerController::class, 'index'])->name('manager');
    Route::post('/manager/change/', [\App\Http\Controllers\ManagerController::class, 'change'])->name('change');
    Route::get('/download/{filename}', [\App\Http\Controllers\ManagerController::class, 'download'])->name('download');
});


