<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/cekData', [AuthController::class, 'cekData'])->name('cekData');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/tiket', [FirebaseController::class, 'aksesNilai'])->name('tiket');
    Route::get('/tsel', [FirebaseController::class, 'getTsel'])->name('tsel');
    Route::get('/pivot', [FirebaseController::class, 'getPivot'])->name('pivot');
    Route::get('/', [FirebaseController::class, 'index'])->name('index');
    Route::get('/logOut', [AuthController::class, 'logOut'])->name('logOut');
});
