<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', function () {
    return view('guest.home');
})->name('home');

Route::get('/explore', function () {
    return view('guest.explore');
})->name('explore');

Route::get('/planner', function () {
    return view('guest.planner');
})->name('planner');

Route::get('/blog', function () {
    return view('guest.blog');
})->name('blog');

Route::get('/about', function () {
    return view('guest.about');
})->name('about');

// Admin Protected Routes
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
