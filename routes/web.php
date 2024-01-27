<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified']);
Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::get('dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::get('uikit/buttons', [\App\Http\Controllers\DashboardController::class, 'uikitButtonsTest'])->middleware(['auth', 'verified'])->name('test.uikit.buttons');

Route::get('expenses', [\App\Http\Controllers\ExpenseController::class, 'index'])->middleware(['auth', 'verified'])->name('expenses.index');
Route::get('expenses/create', [\App\Http\Controllers\ExpenseController::class, 'create'])->middleware(['auth', 'verified'])->name('expenses.create');
Route::post('expenses/create', [\App\Http\Controllers\ExpenseController::class, 'store'])->middleware(['auth', 'verified'])->name('expenses.store');

Route::get('wallets', [\App\Http\Controllers\WalletController::class, 'index'])->middleware(['auth', 'verified'])->name('wallets.index');
Route::get('wallets/create', [\App\Http\Controllers\WalletController::class, 'create'])->middleware(['auth', 'verified'])->name('wallets.create');


require __DIR__.'/auth.php';
