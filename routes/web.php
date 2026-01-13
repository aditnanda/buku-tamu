<?php

use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index']);

// Buku Tamu (tanpa Livewire - HTML/CSS/JS)
Route::post('/buku-tamu/proses', [GuestbookController::class, 'prosesNomor'])->name('buku-tamu.proses');
Route::post('/buku-tamu/submit', [GuestbookController::class, 'submit'])->name('buku-tamu.submit');
