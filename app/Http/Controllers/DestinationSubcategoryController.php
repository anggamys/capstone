<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use App\Models\DestinationSubcategory;
use App\Http\Requests\DestinationSubcategoryRequest;
use Illuminate\Http\Request;

class DestinationSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DestinationSubcategory::with('category');
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function($catQuery) use ($search) {
                      $catQuery->where('name', 'like', '%' . $search . '%');
                  });
                
                // Smart status mapping for Indonesian search keywords
                $lowerSearch = strtolower($search);
                if (str_contains($lowerSearch, 'tidak') || str_contains($lowerSearch, 'non') || str_contains($lowerSearch, 'inactive')) {
                    $q->orWhere('status', 'inactive');
                } elseif (str_contains($lowerSearch, 'aktif') || str_contains($lowerSearch, 'active')) {
                    $q->orWhere('status', 'active');
                }
            });
        }
        
        $subcategories = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.sub-kategori-destinasi.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DestinationCategory::orderBy('name')->get();
        return view('pages.admin.sub-kategori-destinasi.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinationSubcategoryRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        DestinationSubcategory::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        DestinationSubcategory::create($request->validated());

        return redirect()
            ->route('admin.sub-kategori-destinasi.index')
            ->with('success', 'Sub kategori destinasi baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subcategory = DestinationSubcategory::findOrFail($id);
        $categories = DestinationCategory::orderBy('name')->get();
        return view('pages.admin.sub-kategori-destinasi.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DestinationSubcategoryRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        DestinationSubcategory::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $subcategory = DestinationSubcategory::findOrFail($id);
        $subcategory->update($request->validated());

        return redirect()
            ->route('admin.sub-kategori-destinasi.index')
            ->with('success', 'Sub kategori destinasi berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subcategory = DestinationSubcategory::with('category')->findOrFail($id);
        return view('pages.admin.sub-kategori-destinasi.show', compact('subcategory'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subcategory = DestinationSubcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()
            ->route('admin.sub-kategori-destinasi.index')
            ->with('success', 'Sub kategori destinasi berhasil dihapus.');
    }
}
