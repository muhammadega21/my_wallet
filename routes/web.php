<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FriendlistController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/register', [LoginController::class, 'register'])->middleware('guest');
Route::post('/register', [LoginController::class, 'registerStore']);

// Dashboard
Route::get('/dashboard', [Controller::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/search', [Controller::class, 'search'])->name('search');

// Profile
Route::get('/profile', [Controller::class, 'profile'])->middleware('auth');
Route::put('/profile/update/{user}', [Controller::class, 'profileUpdate'])->middleware('auth');
Route::put('/user/update/{user}', [Controller::class, 'userUpdate'])->middleware('auth');

// Wallet
Route::resource('/wallet', WalletController::class)->middleware('auth');
Route::get('/pembelian', [Controller::class, 'purchase'])->middleware('auth');

// Rekening
Route::resource('/rekening', RekeningController::class)->middleware('auth');

// Pembelian
Route::resource('/pembelian', PurchaseController::class)->middleware('auth');

// Riwayat Pembelian
Route::get('/riwayat', [Controller::class, 'riwayat'])->middleware('auth');

// Friendlist
Route::resource('/friendlist', FriendlistController::class)->middleware('auth');
Route::post('friendlist/{user}/{friendID}', [FriendlistController::class, 'store'])->middleware('auth');
Route::get('user/{user:username}', [Controller::class, 'showUser'])->middleware('auth');

// Notifikasi
Route::get('notifikasi', [NotifController::class, 'notif'])->middleware('auth');

// api
Route::get('/api/wallet', [Controller::class, 'walletApi']);
