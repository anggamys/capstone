<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\ActivityRequest;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Activity::query();
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
        $activities = $query->paginate(5)->withQueryString();
        return view('pages.admin.aktivitas.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.aktivitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Activity::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        Activity::create($request->validated());

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('pages.admin.aktivitas.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Activity::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $activity = Activity::findOrFail($id);
        $activity->update($request->validated());

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);
        return view('pages.admin.aktivitas.show', compact('activity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()
            ->route('admin.aktivitas.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}
