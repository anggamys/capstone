<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationCategory;
use App\Models\DestinationSubcategory;
use App\Models\Activity;
use App\Models\Facility;
use App\Models\TravelType;
use App\Models\VisitTime;
use App\Models\Transportation;
use App\Http\Requests\DestinationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Destination::with(['category', 'subcategory']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('district', 'like', '%' . $search . '%')
                  ->orWhereHas('category', function($catQuery) use ($search) {
                      $catQuery->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('subcategory', function($subcatQuery) use ($search) {
                      $subcatQuery->where('name', 'like', '%' . $search . '%');
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

        $destinations = $query->paginate(5)->withQueryString();
        return view('pages.admin.destinasi.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DestinationCategory::where('status', 'active')->orderBy('name')->get();
        $subcategories = DestinationSubcategory::where('status', 'active')->orderBy('name')->get();
        $activities = Activity::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        $travelTypes = TravelType::orderBy('name')->get();
        $visitTimes = VisitTime::orderBy('name')->get();
        $transportations = Transportation::orderBy('name')->get();

        return view('pages.admin.destinasi.create', compact(
            'categories', 
            'subcategories', 
            'activities', 
            'facilities', 
            'travelTypes', 
            'visitTimes', 
            'transportations'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinationRequest $request)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Destination::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('destinations', 'public');
        }

        $destination = Destination::create($data);

        // Sync many-to-many relationships
        $destination->activities()->sync($request->input('activities', []));
        $destination->facilities()->sync($request->input('facilities', []));
        $destination->travelTypes()->sync($request->input('travel_types', []));
        $destination->visitTimes()->sync($request->input('visit_times', []));
        $destination->transportations()->sync($request->input('transportations', []));

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $destination = Destination::with([
            'activities', 
            'facilities', 
            'travelTypes', 
            'visitTimes', 
            'transportations'
        ])->findOrFail($id);

        $categories = DestinationCategory::where('status', 'active')->orderBy('name')->get();
        $subcategories = DestinationSubcategory::where('status', 'active')->orderBy('name')->get();
        $activities = Activity::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();
        $travelTypes = TravelType::orderBy('name')->get();
        $visitTimes = VisitTime::orderBy('name')->get();
        $transportations = Transportation::orderBy('name')->get();

        return view('pages.admin.destinasi.edit', compact(
            'destination',
            'categories', 
            'subcategories', 
            'activities', 
            'facilities', 
            'travelTypes', 
            'visitTimes', 
            'transportations'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DestinationRequest $request, $id)
    {
        // Permanently delete any soft-deleted records with the same slug to prevent unique constraint violation
        Destination::onlyTrashed()->where('slug', $request->slug)->forceDelete();

        $destination = Destination::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($destination->main_image) {
                Storage::disk('public')->delete($destination->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('destinations', 'public');
        }

        $destination->update($data);

        // Sync many-to-many relationships
        $destination->activities()->sync($request->input('activities', []));
        $destination->facilities()->sync($request->input('facilities', []));
        $destination->travelTypes()->sync($request->input('travel_types', []));
        $destination->visitTimes()->sync($request->input('visit_times', []));
        $destination->transportations()->sync($request->input('transportations', []));

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destination = Destination::with([
            'category', 
            'subcategory', 
            'activities', 
            'facilities', 
            'travelTypes', 
            'visitTimes', 
            'transportations'
        ])->findOrFail($id);

        return view('pages.admin.destinasi.show', compact('destination'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()
            ->route('admin.destinasi.index')
            ->with('success', 'Destinasi wisata berhasil dihapus.');
    }
}
