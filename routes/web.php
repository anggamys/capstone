<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::get('/', function () {
    return view('pages.guest.home');
})->name('home');

Route::get('/explore', function () {
    return view('pages.guest.explore');
})->name('explore');

Route::get('/planner', function () {
    return view('pages.guest.planner');
})->name('planner');

Route::get('/blog', function () {
    return view('pages.guest.blog');
})->name('blog');

Route::get('/about', function () {
    return view('pages.guest.about');
})->name('about');

// Admin Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        // Manajemen Blog Artikel
        Route::prefix('blog-artikel')->name('admin.blog-artikel.')->group(function () {
            Route::get('/', function () { return view('pages.admin.blog-artikel.index'); })->name('index');
            Route::get('/create', function () { return view('pages.admin.blog-artikel.create'); })->name('create');
            Route::get('/{id}', function () { return view('pages.admin.blog-artikel.show'); })->name('show');
            Route::get('/{id}/edit', function () { return view('pages.admin.blog-artikel.edit'); })->name('edit');
        });

        // Kategori Artikel Blog
        Route::prefix('kategori-blog-artikel')->name('admin.kategori-blog-artikel.')->group(function () {
            Route::get('/', function () { return view('pages.admin.kategori-blog-artikel.index'); })->name('index');
            Route::get('/create', function () { return view('pages.admin.kategori-blog-artikel.create'); })->name('create');
            Route::get('/{id}', function () { return view('pages.admin.kategori-blog-artikel.show'); })->name('show');
            Route::get('/{id}/edit', function () { return view('pages.admin.kategori-blog-artikel.edit'); })->name('edit');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
