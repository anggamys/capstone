<?php

namespace App\Http\Controllers;

use App\Models\Transportation;
use App\Http\Requests\TransportationRequest;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transportation::query();
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
        $transportations = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.transportasi.index', compact('transportations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.transportasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransportationRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Transportation::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        Transportation::create($request->validated());

        return redirect()
            ->route('admin.transportasi.index')
            ->with('success', 'Transportasi baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transportation = Transportation::findOrFail($id);
        return view('pages.admin.transportasi.edit', compact('transportation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransportationRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Transportation::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $transportation = Transportation::findOrFail($id);
        $transportation->update($request->validated());

        return redirect()
            ->route('admin.transportasi.index')
            ->with('success', 'Transportasi berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transportation = Transportation::findOrFail($id);
        return view('pages.admin.transportasi.show', compact('transportation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transportation = Transportation::findOrFail($id);
        $transportation->delete();

        return redirect()
            ->route('admin.transportasi.index')
            ->with('success', 'Transportasi berhasil dihapus.');
    }
}
