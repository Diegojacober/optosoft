<?php

use App\Http\Controllers\OptometristController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('opto')->middleware('auth')->group(function () {
    Route::get('/profile',[OptometristController::class,'profile'])->name('opto.profile');
    Route::put('/profile',[OptometristController::class,'updateProfile'])->name('opto.profile.update');

});