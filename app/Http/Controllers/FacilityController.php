<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Http\Requests\FacilityRequest;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Facility::query();
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
        $facilities = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.fasilitas.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Facility::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        Facility::create($request->validated());

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $facility = Facility::findOrFail($id);
        return view('pages.admin.fasilitas.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacilityRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Facility::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $facility = Facility::findOrFail($id);
        $facility->update($request->validated());

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $facility = Facility::findOrFail($id);
        return view('pages.admin.fasilitas.show', compact('facility'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}
