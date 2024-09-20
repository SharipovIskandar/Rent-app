<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AuthController;
use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});
Route::get('/login', static function (){
   return view('login');
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/home', static function () {
    return view('home', ['ads' => Ad::all(), 'branches' => Branch::all()]);
})->name('home');
Route::resource('ads', AdController::class);
Route::get('/search', [AdController::class, 'search']);
