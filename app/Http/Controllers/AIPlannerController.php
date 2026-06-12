<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\PlannerHistory;
use App\Models\TravelType;
use App\Models\Transportation;
use App\Services\AIPlannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AIPlannerController extends Controller
{
    public function index()
    {
        return view('pages.guest.ai-planner.index');
    }

    public function result(Request $request, AIPlannerService $aiPlannerService)
    {
        $validated = $request->validate([
            'categories' => ['nullable', 'array'],
            'categories.*' => ['string'],

            'activities' => ['nullable', 'array'],
            'activities.*' => ['string'],

            'travel_type' => ['nullable', 'string'],
            'transportation' => ['nullable', 'string'],

            'visit_times' => ['nullable', 'array'],
            'visit_times.*' => ['string'],

            'budget' => ['nullable'],
            'access_level' => ['nullable', 'string'],
            'crowd_level' => ['nullable', 'string'],
        ]);

        $guestToken = session()->get('guest_token');

        if (!$guestToken) {
            $guestToken = (string) Str::uuid();
            session()->put('guest_token', $guestToken);
        }

        $budget = isset($validated['budget'])
            ? (int) preg_replace('/[^0-9]/', '', $validated['budget'])
            : 0;

        $payload = [
            'user_id' => Auth::check() ? Auth::id() : null,
            'guest_token' => $guestToken,

            'categories' => $validated['categories'] ?? [],
            'activities' => $validated['activities'] ?? [],

            'travel_type' => $validated['travel_type'] ?? '',
            'transportation' => $validated['transportation'] ?? '',
            'visit_times' => $validated['visit_times'] ?? [],

            'budget' => $budget,

            'access_level' => $validated['access_level'] ?? '',
            'crowd_level' => $validated['crowd_level'] ?? '',
        ];

        // Panggil FastAPI
        $apiResult = $aiPlannerService->recommend($payload);

        $apiRecommendations = $apiResult['recommendations'] ?? [];

        // Ubah response FastAPI agar cocok dengan result.blade.php
        $recommendations = collect($apiRecommendations)
            ->map(function ($rec) {
                $destinationName = $rec['destination_name'] ?? null;

                $destination = Destination::with(['category', 'activities', 'facilities'])
                    ->where('name', $destinationName)
                    ->orWhere('name', 'like', '%' . $destinationName . '%')
                    ->first();

                // Jika destinasi dari FastAPI tidak ditemukan di database Laravel,
                // skip agar tidak error di halaman result.
                if (!$destination) {
                    return null;
                }

                return [
                    'name' => $destination->name,
                    'slug' => $destination->slug,
                    'image' => $destination->image_url ?? asset('images/default-destination.jpg'),
                    'match_score' => $rec['score_percent'] ?? round($rec['score'] ?? 0),
                    'category' => $destination->category?->name ?? '-',
                    'district' => $destination->district ?? 'Banyuwangi',
                    'best_time' => $destination->operational_hours ?? 'Fleksibel',

                    'budget' => $destination->ticket_price == 0
                        ? 'Gratis'
                        : 'Rp ' . number_format($destination->ticket_price, 0, ',', '.'),

                    'reason' => isset($rec['reasons']) && is_array($rec['reasons'])
                        ? implode(', ', $rec['reasons'])
                        : ($rec['label'] ?? 'Direkomendasikan oleh AI Planner.'),

                    'access_level' => $destination->access_level ?? '-',

                    'activities' => $destination->activities
                        ? $destination->activities->take(2)->pluck('name')->join(', ')
                        : '',

                    'facilities' => $destination->facilities
                        ? $destination->facilities->take(2)->pluck('name')->join(', ')
                        : '',

                    'google_maps_url' => $destination->google_maps_url,
                ];
            })
            ->filter()
            ->values()
            ->toArray();

        if (count($recommendations) < 8) {
            $existingSlugs = collect($recommendations)->pluck('slug')->toArray();

            $fallbackDestinations = Destination::where('status', 'active')
                ->whereNotIn('slug', $existingSlugs)
                ->with(['category', 'activities', 'facilities'])
                ->inRandomOrder()
                ->limit(8 - count($recommendations))
                ->get()
                ->map(function ($destination) {
                    return [
                        'name' => $destination->name,
                        'slug' => $destination->slug,
                        'image' => $destination->image_url ?? asset('images/default-destination.jpg'),
                        'match_score' => 75,
                        'category' => $destination->category?->name ?? '-',
                        'district' => $destination->district ?? 'Banyuwangi',
                        'best_time' => $destination->operational_hours ?? 'Fleksibel',

                        'budget' => $destination->ticket_price == 0
                            ? 'Gratis'
                            : 'Rp ' . number_format($destination->ticket_price, 0, ',', '.'),

                        'reason' => 'Destinasi ini ditambahkan sebagai alternatif rekomendasi berdasarkan data wisata aktif di Laras Banyuwangi.',

                        'access_level' => $destination->access_level ?? '-',

                        'activities' => $destination->activities
                            ? $destination->activities->take(2)->pluck('name')->join(', ')
                            : '',

                        'facilities' => $destination->facilities
                            ? $destination->facilities->take(2)->pluck('name')->join(', ')
                            : '',

                        'google_maps_url' => $destination->google_maps_url,
                    ];
                })
                ->toArray();

            $recommendations = array_merge($recommendations, $fallbackDestinations);
        }



        $travelTypeId = TravelType::where('name', $payload['travel_type'])->value('id');

        $transportationId = Transportation::where('name', $payload['transportation'])->value('id');

        $plannerHistory = PlannerHistory::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'guest_token' => $guestToken,

            'categories' => $payload['categories'],
            'activities' => $payload['activities'],

            'travel_type_id' => $travelTypeId,
            'transportation_id' => $transportationId,

            'visit_times' => $payload['visit_times'],
            'budget' => $payload['budget'],
            'access_level' => $payload['access_level'],
            'crowd_level' => $payload['crowd_level'],

            'recommendations' => $recommendations,
        ]);

        return view('pages.guest.ai-planner.result', [
            'preferences' => $payload,
            'recommendations' => $recommendations,
            'apiSuccess' => $apiResult['success'] ?? false,
            'apiMessage' => $apiResult['message'] ?? null,

            'selectedCategories' => $payload['categories'],
            'selectedTravelType' => $payload['travel_type'],
            'selectedTrans' => $payload['transportation'],
            'selectedVisit' => $payload['visit_times'],
            'selectedBudget' => $payload['budget'],
            'selectedAccess' => $payload['access_level'],
            'selectedCrowd' => $payload['crowd_level'],

            'historyUrl' => route('planner.history.show', $plannerHistory->id),
        ]);
    }

    public function showHistory(PlannerHistory $plannerHistory)
    {
        $travelTypeName = $plannerHistory->travelType?->name ?? '';
        $transportationName = $plannerHistory->transportation?->name ?? '';

        return view('pages.guest.ai-planner.result', [
            'preferences' => [
                'categories' => $plannerHistory->categories ?? [],
                'activities' => $plannerHistory->activities ?? [],
                'travel_type' => $travelTypeName,
                'transportation' => $transportationName,
                'visit_times' => $plannerHistory->visit_times ?? [],
                'budget' => $plannerHistory->budget,
                'access_level' => $plannerHistory->access_level,
                'crowd_level' => $plannerHistory->crowd_level,
            ],

            'recommendations' => $plannerHistory->recommendations ?? [],
            'apiSuccess' => true,
            'apiMessage' => null,

            'selectedCategories' => $plannerHistory->categories ?? [],
            'selectedTravelType' => $travelTypeName,
            'selectedTrans' => $transportationName,
            'selectedVisit' => $plannerHistory->visit_times ?? [],
            'selectedBudget' => $plannerHistory->budget,
            'selectedAccess' => $plannerHistory->access_level,
            'selectedCrowd' => $plannerHistory->crowd_level,

            'historyUrl' => route('planner.history.show', $plannerHistory->id),
        ]);
    }
}