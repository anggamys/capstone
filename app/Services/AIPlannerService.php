<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIPlannerService
{
    public function recommend(array $payload): array
    {
        $baseUrl = config('services.ai_planner.url');

        try {
            $response = Http::timeout(20)
                ->acceptJson()
                ->post($baseUrl . '/recommend', $payload);

            if ($response->failed()) {
                Log::error('AI Planner API failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return [
                    'success' => false,
                    'message' => 'Gagal mendapatkan rekomendasi dari AI Planner.',
                    'recommendations' => [],
                ];
            }

            return $response->json();

        } catch (\Throwable $e) {
            Log::error('AI Planner API error', [
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Service AI Planner belum tersedia.',
                'recommendations' => [],
            ];
        }
    }
}