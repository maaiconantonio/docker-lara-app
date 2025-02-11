<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/cake', [CakeController::class, 'index'])->name('cake.index');
Route::get('/create-cake', [CakeController::class, 'create'])->name('cake.create');
Route::post('/store-cake', [CakeController::class, 'store'])->name('cake.store');
Route::get('/show-cake/{cake}', [CakeController::class, 'show'])->name('cake.show');
Route::get('/edit-cake/{cake}', [CakeController::class, 'edit'])->name('cake.edit');
Route::put('/update-cake/{cake}', [CakeController::class, 'update'])->name('cake.update');
Route::delete('/destroy-cake/{cake}', [CakeController::class, 'destroy'])->name('cake.destroy');
