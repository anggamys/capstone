<?php

namespace App\Http\Controllers;

use App\Models\TravelType;
use App\Http\Requests\TravelTypeRequest;
use Illuminate\Http\Request;

class TravelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TravelType::query();
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
        $travelTypes = $query->paginate(5)->withQueryString();
        return view('pages.admin.tipe-perjalanan.index', compact('travelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.tipe-perjalanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelTypeRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        TravelType::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        TravelType::create($request->validated());

        return redirect()
            ->route('admin.tipe-perjalanan.index')
            ->with('success', 'Tipe perjalanan baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $travelType = TravelType::findOrFail($id);
        return view('pages.admin.tipe-perjalanan.edit', compact('travelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelTypeRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        TravelType::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $travelType = TravelType::findOrFail($id);
        $travelType->update($request->validated());

        return redirect()
            ->route('admin.tipe-perjalanan.index')
            ->with('success', 'Tipe perjalanan berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $travelType = TravelType::findOrFail($id);
        return view('pages.admin.tipe-perjalanan.show', compact('travelType'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $travelType = TravelType::findOrFail($id);
        $travelType->delete();

        return redirect()
            ->route('admin.tipe-perjalanan.index')
            ->with('success', 'Tipe perjalanan berhasil dihapus.');
    }
}
