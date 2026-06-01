<?php

namespace App\Http\Controllers;

use App\Models\DestinationCategory;
use App\Http\Requests\DestinationCategoryRequest;
use Illuminate\Http\Request;

class DestinationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DestinationCategory::query();
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%');
                
                // Smart status mapping for Indonesian search keywords
                $lowerSearch = strtolower($search);
                if (str_contains($lowerSearch, 'tidak') || str_contains($lowerSearch, 'non') || str_contains($lowerSearch, 'inactive')) {
                    $q->orWhere('status', 'inactive');
                } elseif (str_contains($lowerSearch, 'aktif') || str_contains($lowerSearch, 'active')) {
                    $q->orWhere('status', 'active');
                }
            });
        }
        $categories = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.kategori-destinasi.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.kategori-destinasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinationCategoryRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        DestinationCategory::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        DestinationCategory::create($request->validated());

        return redirect()
            ->route('admin.kategori-destinasi.index')
            ->with('success', 'Kategori destinasi baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = DestinationCategory::findOrFail($id);
        return view('pages.admin.kategori-destinasi.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DestinationCategoryRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        DestinationCategory::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $category = DestinationCategory::findOrFail($id);
        $category->update($request->validated());

        return redirect()
            ->route('admin.kategori-destinasi.index')
            ->with('success', 'Kategori destinasi berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = DestinationCategory::findOrFail($id);
        return view('pages.admin.kategori-destinasi.show', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = DestinationCategory::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('admin.kategori-destinasi.index')
            ->with('success', 'Kategori destinasi berhasil dihapus.');
    }
}
