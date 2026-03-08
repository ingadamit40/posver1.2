<?php

use App\Livewire\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', LoginController::class)->name('login');
