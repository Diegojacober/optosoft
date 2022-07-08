<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OptometristController;
use App\Http\Controllers\OticaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\UserController;
use App\Models\Receita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout',[LoginController::class,'logout'])->middleware('auth');
Route::prefix('opto')->middleware('auth')->group(function () {
    Route::get('/profile',[OptometristController::class,'profile'])->name('opto.profile');
    Route::put('/profile',[OptometristController::class,'updateProfile'])->name('opto.profile.update');
    Route::get('/oticas',[OticaController::class,'index'])->name('otica.index');
    Route::get('/oticas/{id}/activeorinactive',[OticaController::class,'action'])->name('otica.action');
    Route::post('/oticas/store',[OticaController::class,'store'])->name('otica.store');
    Route::put('/oticas/edit/{id}',[OticaController::class,'update'])->name('otica.edit');
    Route::get('/users',[OptometristController::class,'usersIndex'])->name('opto.users');
    Route::post('/new/users/store',[UserController::class,'store'])->name('users.store');
    Route::post('/permissions/store/{id}',[PermissionController::class,'store'])->name('permissions.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.profile.update');
    Route::post('/users/delete/{id}', [UserController::class,'destroy']);
});


Route::prefix('receitas')->middleware('auth')->group(function () {
    Route::get('/', [ReceitaController::class,'index'])->name('receitas.index');
    Route::get('/new', [ReceitaController::class,'create'])->name('receitas.create');
    Route::post('/store', [ReceitaController::class,'store'])->name('receitas.store');
    Route::get('/getOtica/{id}', [ReceitaController::class,'getReceitas']);
    Route::post('/searchreceita', [ReceitaController::class,'searchReceita']);
    Route::post('/delete/{id}',[ReceitaController::class,'delete']);
    Route::post('/update/{id}',[ReceitaController::class,'update']);
});