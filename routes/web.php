<?php

use App\Http\Controllers\AdController;
use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home', ['ads' => Ad::all(), 'branches' => Branch::all()]);
});
Route::resource('ads', AdController::class);
Route::get('/search', [AdController::class, 'find']);
