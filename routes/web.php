<?php

use App\Livewire\Auth\LoginController;
use App\Livewire\Categorias\CategoriasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', LoginController::class)->name('login');
Route::get('/dashboard/{welcome?}', App\Livewire\Home\DashboardController::class)
    ->name('dashboard')
    ->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/categorias', CategoriasController::class)
    ->name('categorias')
    ->middleware('auth');
