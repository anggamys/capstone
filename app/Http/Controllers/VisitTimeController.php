<?php

namespace App\Http\Controllers;

use App\Models\VisitTime;
use App\Http\Requests\VisitTimeRequest;
use Illuminate\Http\Request;

class VisitTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = VisitTime::query();
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
        $visitTimes = $query->latest()->paginate(5)->withQueryString();
        return view('pages.admin.waktu-kunjungan.index', compact('visitTimes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.waktu-kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitTimeRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        VisitTime::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        VisitTime::create($request->validated());

        return redirect()
            ->route('admin.waktu-kunjungan.index')
            ->with('success', 'Waktu kunjungan baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $visitTime = VisitTime::findOrFail($id);
        return view('pages.admin.waktu-kunjungan.edit', compact('visitTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitTimeRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        VisitTime::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $visitTime = VisitTime::findOrFail($id);
        $visitTime->update($request->validated());

        return redirect()
            ->route('admin.waktu-kunjungan.index')
            ->with('success', 'Waktu kunjungan berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visitTime = VisitTime::findOrFail($id);
        return view('pages.admin.waktu-kunjungan.show', compact('visitTime'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visitTime = VisitTime::findOrFail($id);
        $visitTime->delete();

        return redirect()
            ->route('admin.waktu-kunjungan.index')
            ->with('success', 'Waktu kunjungan berhasil dihapus.');
    }
}
