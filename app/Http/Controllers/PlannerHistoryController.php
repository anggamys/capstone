<?php

namespace App\Http\Controllers;

use App\Models\PlannerHistory;
use Illuminate\Http\Request;

class PlannerHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PlannerHistory::with(['user', 'travelType', 'transportation']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                // Search by user name or email
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', '%' . $search . '%')
                              ->orWhere('email', 'like', '%' . $search . '%');
                });

                // Search by travel type
                $q->orWhereHas('travelType', function($travelQuery) use ($search) {
                    $travelQuery->where('name', 'like', '%' . $search . '%');
                });

                // Search by transportation
                $q->orWhereHas('transportation', function($transQuery) use ($search) {
                    $transQuery->where('name', 'like', '%' . $search . '%');
                });

                // Search by other columns
                $q->orWhere('budget', 'like', '%' . $search . '%')
                  ->orWhere('access_level', 'like', '%' . $search . '%')
                  ->orWhere('crowd_level', 'like', '%' . $search . '%');
                  
                // If searching for guest/anonim
                $lowerSearch = strtolower($search);
                if (str_contains($lowerSearch, 'guest') || str_contains($lowerSearch, 'anonim') || str_contains($lowerSearch, 'tanpa nama')) {
                    $q->orWhereNull('user_id');
                }
            });
        }

        $histories = $query->latest()->paginate(10)->withQueryString();

        $categoryMap = \App\Models\DestinationCategory::pluck('name', 'id')->toArray();
        $activityMap = \App\Models\Activity::pluck('name', 'id')->toArray();
        $visitTimeMap = \App\Models\VisitTime::pluck('name', 'id')->toArray();

        return view('pages.admin.riwayat-preferensi.index', compact('histories', 'categoryMap', 'activityMap', 'visitTimeMap'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $history = PlannerHistory::with(['user', 'travelType', 'transportation'])->findOrFail($id);

        $categoryMap = \App\Models\DestinationCategory::pluck('name', 'id')->toArray();
        $activityMap = \App\Models\Activity::pluck('name', 'id')->toArray();
        $visitTimeMap = \App\Models\VisitTime::pluck('name', 'id')->toArray();

        // Fetch destination images
        $recommendationNames = $history->recommendations ?? [];
        $destinations = \App\Models\Destination::whereIn('name', $recommendationNames)->get();
        $destinationImageMap = $destinations->pluck('image_url', 'name')->toArray();

        return view('pages.admin.riwayat-preferensi.show', compact('history', 'categoryMap', 'activityMap', 'visitTimeMap', 'destinationImageMap'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $history = PlannerHistory::findOrFail($id);
        $history->delete();

        return redirect()
            ->route('admin.riwayat-preferensi.index')
            ->with('success', 'Riwayat preferensi user berhasil dihapus.');
    }
}
