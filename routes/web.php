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

    $destinations = Destination::where('status', 'active')
        ->with('category')
        ->inRandomOrder()
        ->limit(3)
        ->get();

    return view('pages.guest.home', compact('blogs', 'destinations'));
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
    // Check/create guest token cookie
    $guestToken = request()->cookie('planner_guest_token');
    $cookieToQueue = null;
    if (!$guestToken) {
        $guestToken = (string) \Illuminate\Support\Str::uuid();
        $cookieToQueue = cookie('planner_guest_token', $guestToken, 2628000); // 5 years
    }

    // If logged in, associate previous anonymous entries with this user
    if (\Illuminate\Support\Facades\Auth::check() && $guestToken) {
        \App\Models\PlannerHistory::where('guest_token', $guestToken)
            ->whereNull('user_id')
            ->update(['user_id' => \Illuminate\Support\Facades\Auth::id()]);
    }

    $categories = DestinationCategory::where('status', 'active')->orderBy('name')->get();
    $activities = \App\Models\Activity::where('status', 'active')->orderBy('name')->get();
    $travelTypes = \App\Models\TravelType::where('status', 'active')->orderBy('name')->get();
    $transportations = \App\Models\Transportation::where('status', 'active')->orderBy('name')->get();
    $visitTimes = \App\Models\VisitTime::where('status', 'active')->orderBy('name')->get();

    $response = response()->view('pages.guest.ai-planner.index', compact('categories', 'activities', 'travelTypes', 'transportations', 'visitTimes'));
    if ($cookieToQueue) {
        $response->withCookie($cookieToQueue);
    }
    return $response;
})->name('planner');

Route::match(['get', 'post'], '/planner/result', function () {
    // Check if any search input is present in the request
    $hasInputs = request()->hasAny(['categories', 'activities', 'travel_type', 'transportation', 'visit_time', 'budget', 'access_level', 'crowd_level']);

    if ($hasInputs) {
        // Save current search to session
        session([
            'ai_planner_last_search' => [
                'categories' => request('categories', []),
                'activities' => request('activities', []),
                'travel_type' => request('travel_type'),
                'transportation' => request('transportation'),
                'visit_time' => request('visit_time', []),
                'budget' => request('budget', 'hemat'),
                'access_level' => request('access_level', 'sedang'),
                'crowd_level' => request('crowd_level', 'sedang'),
            ]
        ]);
    }

    // Retrieve from session if request has no inputs, defaulting to fallback values
    $searchData = session('ai_planner_last_search', [
        'categories' => [],
        'activities' => [],
        'travel_type' => null,
        'transportation' => null,
        'visit_time' => [],
        'budget' => 'hemat',
        'access_level' => 'sedang',
        'crowd_level' => 'sedang',
    ]);

    $selectedCategories = $hasInputs ? request('categories', []) : $searchData['categories'];
    $selectedActivities = $hasInputs ? request('activities', []) : $searchData['activities'];
    $selectedTravelType = $hasInputs ? request('travel_type') : $searchData['travel_type'];
    $selectedTrans = $hasInputs ? request('transportation') : $searchData['transportation'];
    $selectedVisit = $hasInputs ? request('visit_time', []) : $searchData['visit_time'];
    $selectedBudget = $hasInputs ? request('budget', 'hemat') : $searchData['budget'];
    $selectedAccess = $hasInputs ? request('access_level', 'sedang') : $searchData['access_level'];
    $selectedCrowd = $hasInputs ? request('crowd_level', 'sedang') : $searchData['crowd_level'];

    // Fetch all active destinations with relationships
    $destinations = Destination::where('status', 'active')
        ->with(['category', 'activities', 'travelTypes', 'visitTimes', 'transportations', 'facilities'])
        ->get();

    $recommendations = [];

    foreach ($destinations as $dest) {
        $score = 0;

        // 1. Category Match (25 pts)
        if (!empty($selectedCategories)) {
            if (in_array($dest->destination_category_id, $selectedCategories)) {
                $score += 25;
            }
        } else {
            $score += 25;
        }

        // 2. Activity Match (20 pts)
        if (!empty($selectedActivities)) {
            $destActivityIds = $dest->activities->pluck('id')->toArray();
            $matches = array_intersect($selectedActivities, $destActivityIds);
            if (count($selectedActivities) > 0) {
                $score += (count($matches) / count($selectedActivities)) * 20;
            } else {
                $score += 20;
            }
        } else {
            $score += 20;
        }

        // 3. Travel Type Match (15 pts)
        if ($selectedTravelType) {
            $destTravelTypeIds = $dest->travelTypes->pluck('id')->toArray();
            if (in_array($selectedTravelType, $destTravelTypeIds)) {
                $score += 15;
            }
        } else {
            $score += 15;
        }

        // 4. Transportation Match (15 pts)
        if ($selectedTrans) {
            $destTransIds = $dest->transportations->pluck('id')->toArray();
            if (in_array($selectedTrans, $destTransIds)) {
                $score += 15;
            }
        } else {
            $score += 15;
        }

        // 5. Visit Time Match (10 pts)
        if (!empty($selectedVisit)) {
            $destVisitIds = $dest->visitTimes->pluck('id')->toArray();
            if (is_array($selectedVisit)) {
                $matchesVisit = array_intersect($selectedVisit, $destVisitIds);
                if (count($selectedVisit) > 0) {
                    $score += (count($matchesVisit) / count($selectedVisit)) * 10;
                } else {
                    $score += 10;
                }
            } else {
                if (in_array($selectedVisit, $destVisitIds)) {
                    $score += 10;
                }
            }
        } else {
            $score += 10;
        }

        // 6. Budget Match (10 pts)
        $price = $dest->ticket_price;
        if ($selectedBudget === 'hemat') {
            if ($price <= 15000) {
                $score += 10;
            } elseif ($price <= 30000) {
                $score += 5;
            }
        } elseif ($selectedBudget === 'sedang') {
            if ($price <= 50000) {
                $score += 10;
            } else {
                $score += 5;
            }
        } elseif ($selectedBudget === 'mewah') {
            $score += 10;
        }

        // 7. Access Level Match (5 pts)
        $access = strtolower($dest->access_level);
        if ($selectedAccess === 'mudah') {
            if ($access === 'mudah') {
                $score += 5;
            }
        } elseif ($selectedAccess === 'sedang') {
            if ($access === 'mudah' || $access === 'sedang') {
                $score += 5;
            }
        } elseif ($selectedAccess === 'menantang') {
            $score += 5;
        }

        // Normalize matching score
        $matchPercent = round($score);
        if ($matchPercent < 60) {
            $matchPercent = 60 + ($dest->id % 25);
        }
        if ($matchPercent > 99) {
            $matchPercent = 99;
        }

        // Generate dynamic AI reason based on database attributes
        $actName = $dest->activities->first()?->name ?? 'menikmati keindahan alam';
        $reason = "Destinasi ini sangat cocok karena merupakan kawasan {$dest->category->name} yang mendukung aktivitas {$actName}. Aksesibilitasnya bertipe {$dest->access_level} dengan tiket masuk seharga " . ($dest->ticket_price == 0 ? 'Gratis' : 'Rp ' . number_format($dest->ticket_price, 0, ',', '.')) . ".";

        $recommendations[] = [
            'name' => $dest->name,
            'slug' => $dest->slug,
            'image' => $dest->image_url,
            'match_score' => $matchPercent,
            'category' => $dest->category->name,
            'district' => $dest->district ?? 'Banyuwangi',
            'best_time' => $dest->operational_hours ?? 'Pagi - Sore',
            'budget' => $dest->ticket_price == 0 ? 'Gratis' : 'Rp ' . number_format($dest->ticket_price, 0, ',', '.'),
            'reason' => $reason,
            'access_level' => $dest->access_level ?? 'Sedang',
            'activities' => $dest->activities->take(2)->pluck('name')->join(', '),
            'facilities' => $dest->facilities->take(2)->pluck('name')->join(', '),
            'google_maps_url' => $dest->google_maps_url
        ];
    }

    // Sort by match score descending
    usort($recommendations, function ($a, $b) {
        return $b['match_score'] <=> $a['match_score'];
    });

    // Take top 6
    $recommendations = array_slice($recommendations, 0, 6);

    // Get/create guest token cookie
    $guestToken = request()->cookie('planner_guest_token');
    $cookieToQueue = null;
    if (!$guestToken) {
        $guestToken = (string) \Illuminate\Support\Str::uuid();
        $cookieToQueue = cookie('planner_guest_token', $guestToken, 2628000); // 5 years
    }

    if ($hasInputs) {
        \App\Models\PlannerHistory::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'guest_token' => $guestToken,
            'categories' => $selectedCategories,
            'activities' => $selectedActivities,
            'travel_type_id' => $selectedTravelType,
            'transportation_id' => $selectedTrans,
            'visit_times' => $selectedVisit,
            'budget' => $selectedBudget,
            'access_level' => $selectedAccess,
            'crowd_level' => $selectedCrowd,
            'recommendations' => collect($recommendations)->pluck('name')->toArray()
        ]);
    }

    // If logged in, associate previous anonymous entries with this user
    if (\Illuminate\Support\Facades\Auth::check() && $guestToken) {
        \App\Models\PlannerHistory::where('guest_token', $guestToken)
            ->whereNull('user_id')
            ->update(['user_id' => \Illuminate\Support\Facades\Auth::id()]);
    }

    $response = response()->view('pages.guest.ai-planner.result', compact('recommendations', 'selectedCategories', 'selectedTravelType', 'selectedTrans', 'selectedVisit', 'selectedBudget', 'selectedAccess', 'selectedCrowd'));
    if ($cookieToQueue) {
        $response->withCookie($cookieToQueue);
    }
    return $response;
})->name('planner.result');

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
        $totalRekomendasiUser = \App\Models\PlannerHistory::count();
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

        // Riwayat Preferensi User
        Route::prefix('riwayat-preferensi')->name('admin.riwayat-preferensi.')->group(function () {
            Route::get('/', [\App\Http\Controllers\PlannerHistoryController::class, 'index'])->name('index');
            Route::get('/{id}', [\App\Http\Controllers\PlannerHistoryController::class, 'show'])->name('show');
            Route::delete('/{id}', [\App\Http\Controllers\PlannerHistoryController::class, 'destroy'])->name('destroy');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';