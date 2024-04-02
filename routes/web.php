<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TripayCallbackController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('login');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::resource('/dashboard', DashboardController::class)->middleware('auth');

Route::post('/transaksi_process', [TransaksiController::class, 'store'])->name('process');
Route::get('/transaksi/{reference}', [TransaksiController::class, 'show'])->name('transaksi.show');
Route::resource('/donate', CharityController::class)->except('edit', 'update', 'destroy', 'create', 'store');

Route::post('callback', [TripayCallbackController::class, 'handle']);
