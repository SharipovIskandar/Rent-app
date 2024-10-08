<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;

Route::get('/welcome', static function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', static function () {
    return view('ads.home', ['ads' => Ad::all(), 'branches' => Branch::all()]);
})->name('ads.home');
Route::resource('ads', AdController::class);
Route::get('/search', [AdController::class, 'search']);

Route::post('/ads/{id}/bookmark', [UserController::class, 'toggleBookmarks'])->name('ads.bookmark');

require __DIR__.'/auth.php';
