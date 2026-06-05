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
use App\Http\Controllers\CategoryBlogController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\Blog;

// Guest Routes
Route::get('/', function () {
    $blogs = Blog::where('status', 'published')
        ->with(['category', 'admin'])
        ->latest('published_at')
        ->limit(3)
        ->get();
    return view('pages.guest.home', compact('blogs'));
})->name('home');

Route::get('/explore', function () {
    $search = request()->query('search');
    $categorySlug = request()->query('category');

    // Total semua destinasi aktif di database
    $totalCount = Destination::where('status', 'active')->count();

    // Ambil kategori aktif untuk tab filter
    $categories = DestinationCategory::where('status', 'active')->orderBy('name')->get();

    // Tentukan destinasi pilihan/terpopuler (hanya di halaman 1 dan tanpa filter/pencarian aktif)
    $featuredDestinations = collect();
    if (!request()->has('page') || request()->query('page') == 1) {
        if (!$search && (!$categorySlug || $categorySlug === 'semua')) {
            $featuredDestinations = Destination::where('status', 'active')
                ->where('rating', '>=', 4.5)
                ->with('category')
                ->inRandomOrder()
                ->limit(4) // Ambil 4 destinasi teratas secara acak untuk slider
                ->get();
        }
    }

    $query = Destination::where('status', 'active')
        ->with('category')
        ->latest();

    // Terapkan pencarian jika ada
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('district', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    // Terapkan filter kategori jika ada
    if ($categorySlug && $categorySlug !== 'semua') {
        $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    $destinations = $query->paginate(6)->withQueryString();

    // Hitung jumlah yang disaring (filteredCount)
    if (!$search && (!$categorySlug || $categorySlug === 'semua')) {
        $filteredCount = $totalCount;
    } else {
        $filteredCount = $destinations->total();
    }

    return view('pages.guest.explore', compact('categories', 'destinations', 'totalCount', 'filteredCount', 'featuredDestinations'));
})->name('explore');

Route::get('/explore/{slug}', function ($slug) {
    $destination = Destination::where('slug', $slug)
        ->where('status', 'active')
        ->with(['category', 'subcategory', 'activities', 'facilities', 'travelTypes', 'visitTimes', 'transportations'])
        ->firstOrFail();
    return view('pages.guest.show', compact('destination'));
})->name('explore.show');

Route::get('/planner', function () {
    return view('pages.guest.planner');
})->name('planner');

Route::get('/blog', function () {
    $search = request()->query('search');
    $categorySlug = request()->query('category');

    // Total semua blog yang berstatus published di database
    $totalCount = Blog::where('status', 'published')->count();

    // Ambil kategori aktif untuk tab filter
    $categories = \App\Models\CategoryBlog::where('status', 'active')->orderBy('name')->get();

    // Tentukan blog utama/featured (hanya di halaman 1 dan tanpa filter/pencarian aktif)
    // Namun kita harus selalu mengecualikan ID-nya di semua halaman agar tidak terjadi duplikasi
    $featuredBlog = null;
    $featuredBlogId = null;
    if (!$search && (!$categorySlug || $categorySlug === 'semua')) {
        $latestBlog = Blog::where('status', 'published')
            ->with(['category', 'admin'])
            ->latest('published_at')
            ->first();
        
        if ($latestBlog) {
            $featuredBlogId = $latestBlog->id;
            if (!request()->has('page') || request()->query('page') == 1) {
                $featuredBlog = $latestBlog;
            }
        }
    }

    $query = Blog::where('status', 'published')
        ->with(['category', 'admin'])
        ->latest('published_at');

    // Jika ada blog utama, selalu kecualikan dari daftar grid di semua halaman
    if ($featuredBlogId) {
        $query->where('id', '!=', $featuredBlogId);
    }

    // Terapkan pencarian jika ada
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('content', 'like', '%' . $search . '%');
        });
    }

    // Terapkan filter kategori jika ada
    if ($categorySlug && $categorySlug !== 'semua') {
        $query->whereHas('category', function($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    $blogs = $query->paginate(6)->withQueryString();

    // Hitung jumlah yang disaring (filteredCount)
    if (!$search && (!$categorySlug || $categorySlug === 'semua')) {
        $filteredCount = $totalCount;
    } else {
        $filteredCount = $blogs->total();
    }

    return view('pages.guest.blog', compact('blogs', 'featuredBlog', 'categories', 'totalCount', 'filteredCount'));
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    $blog = Blog::where('slug', $slug)
        ->where('status', 'published')
        ->with(['category', 'admin'])
        ->firstOrFail();
    
    // Tingkatkan jumlah tayangan (views) blog
    $blog->increment('views');
    
    $recentBlogs = Blog::where('status', 'published')
        ->where('id', '!=', $blog->id)
        ->latest('published_at')
        ->limit(5)
        ->get();

    return view('pages.guest.blog-show', compact('blog', 'recentBlogs'));
})->name('blog.show');

Route::get('/about', function () {
    return view('pages.guest.about');
})->name('about');

// Admin Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $totalDestinasi = Destination::count();
        $totalBlogArtikel = Blog::count();
        $totalRekomendasiUser = 24; // Mock count for user recommendations
        return view('pages.admin.dashboard', compact('totalDestinasi', 'totalBlogArtikel', 'totalRekomendasiUser'));
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        // Manajemen Blog
        Route::prefix('blog')->name('admin.blog.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{id}', [BlogController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{id}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{id}', [BlogController::class, 'destroy'])->name('destroy');
        });

        // Kategori Artikel Blog
        Route::prefix('kategori-blog-artikel')->name('admin.kategori-blog.')->group(function () {
            Route::get('/', [CategoryBlogController::class, 'index'])->name('index');
            Route::get('/create', [CategoryBlogController::class, 'create'])->name('create');
            Route::post('/', [CategoryBlogController::class, 'store'])->name('store');
            Route::get('/{id}', [CategoryBlogController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [CategoryBlogController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CategoryBlogController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryBlogController::class, 'destroy'])->name('destroy');
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