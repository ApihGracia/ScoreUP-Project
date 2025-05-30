<?php

use App\Livewire\AdminHome;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/admin', AdminHome::class)->name('home');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    // Route::get('collage', AdminHome::class)->name('collage');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
