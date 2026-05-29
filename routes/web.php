<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinationCategoryController;
use App\Http\Controllers\DestinationSubcategoryController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TravelTypeController;
use App\Http\Controllers\VisitTimeController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\DestinationController;
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

        // Kategori Destinasi Wisata
        Route::prefix('kategori-destinasi')->name('admin.kategori-destinasi.')->group(function () {
            Route::get('/', [DestinationCategoryController::class, 'index'])->name('index');
            Route::get('/create', [DestinationCategoryController::class, 'create'])->name('create');
            Route::post('/', [DestinationCategoryController::class, 'store'])->name('store');
            Route::get('/{id}', [DestinationCategoryController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [DestinationCategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [DestinationCategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [DestinationCategoryController::class, 'destroy'])->name('destroy');
        });

        // Sub Kategori Destinasi Wisata
        Route::prefix('sub-kategori-destinasi')->name('admin.sub-kategori-destinasi.')->group(function () {
            Route::get('/', [DestinationSubcategoryController::class, 'index'])->name('index');
            Route::get('/create', [DestinationSubcategoryController::class, 'create'])->name('create');
            Route::post('/', [DestinationSubcategoryController::class, 'store'])->name('store');
            Route::get('/{id}', [DestinationSubcategoryController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [DestinationSubcategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [DestinationSubcategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [DestinationSubcategoryController::class, 'destroy'])->name('destroy');
        });

        // Aktivitas Wisata
        Route::prefix('aktivitas')->name('admin.aktivitas.')->group(function () {
            Route::get('/', [ActivityController::class, 'index'])->name('index');
            Route::get('/create', [ActivityController::class, 'create'])->name('create');
            Route::post('/', [ActivityController::class, 'store'])->name('store');
            Route::get('/{id}', [ActivityController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [ActivityController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ActivityController::class, 'update'])->name('update');
            Route::delete('/{id}', [ActivityController::class, 'destroy'])->name('destroy');
        });

        // Fasilitas Wisata
        Route::prefix('fasilitas')->name('admin.fasilitas.')->group(function () {
            Route::get('/', [FacilityController::class, 'index'])->name('index');
            Route::get('/create', [FacilityController::class, 'create'])->name('create');
            Route::post('/', [FacilityController::class, 'store'])->name('store');
            Route::get('/{id}', [FacilityController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [FacilityController::class, 'edit'])->name('edit');
            Route::put('/{id}', [FacilityController::class, 'update'])->name('update');
            Route::delete('/{id}', [FacilityController::class, 'destroy'])->name('destroy');
        });

        // Tipe Perjalanan
        Route::prefix('tipe-perjalanan')->name('admin.tipe-perjalanan.')->group(function () {
            Route::get('/', [TravelTypeController::class, 'index'])->name('index');
            Route::get('/create', [TravelTypeController::class, 'create'])->name('create');
            Route::post('/', [TravelTypeController::class, 'store'])->name('store');
            Route::get('/{id}', [TravelTypeController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [TravelTypeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TravelTypeController::class, 'update'])->name('update');
            Route::delete('/{id}', [TravelTypeController::class, 'destroy'])->name('destroy');
        });

        // Waktu Kunjungan
        Route::prefix('waktu-kunjungan')->name('admin.waktu-kunjungan.')->group(function () {
            Route::get('/', [VisitTimeController::class, 'index'])->name('index');
            Route::get('/create', [VisitTimeController::class, 'create'])->name('create');
            Route::post('/', [VisitTimeController::class, 'store'])->name('store');
            Route::get('/{id}', [VisitTimeController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [VisitTimeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [VisitTimeController::class, 'update'])->name('update');
            Route::delete('/{id}', [VisitTimeController::class, 'destroy'])->name('destroy');
        });

        // Transportasi Wisata
        Route::prefix('transportasi')->name('admin.transportasi.')->group(function () {
            Route::get('/', [TransportationController::class, 'index'])->name('index');
            Route::get('/create', [TransportationController::class, 'create'])->name('create');
            Route::post('/', [TransportationController::class, 'store'])->name('store');
            Route::get('/{id}', [TransportationController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [TransportationController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TransportationController::class, 'update'])->name('update');
            Route::delete('/{id}', [TransportationController::class, 'destroy'])->name('destroy');
        });

        // Destinasi Wisata
        Route::prefix('destinasi')->name('admin.destinasi.')->group(function () {
            Route::get('/', [DestinationController::class, 'index'])->name('index');
            Route::get('/create', [DestinationController::class, 'create'])->name('create');
            Route::post('/', [DestinationController::class, 'store'])->name('store');
            Route::get('/{id}', [DestinationController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [DestinationController::class, 'edit'])->name('edit');
            Route::put('/{id}', [DestinationController::class, 'update'])->name('update');
            Route::delete('/{id}', [DestinationController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
