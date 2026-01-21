<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    public function index()
    {
        return view('ai.index');
    }

    public function suggest(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|string|min:3',
        ]);

        $ingredients = $request->input('ingredients');
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return back()->with('error', 'API Key is missing in .env file!');
        }

        $prompt = "I have these ingredients: {$ingredients}.
Suggest 3 recipes.
Return ONLY a JSON array.
Each object must have exactly:
- title (string)
- ingredients (array of strings)
- instructions (string)
No markdown, no ```json, no extra text.";

        // Try a primary model first, then fall back if overloaded (503)
        $models = [
            'gemini-2.5-flash',
            'gemini-2.5-pro',
            'gemini-2.0-flash',
        ];

        try {
            $response = null;

            foreach ($models as $model) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

                $response = Http::withoutVerifying()
                    ->timeout(60)
                    // Retry transient failures (incl. 503 and network hiccups)
                    ->retry(3, 1200, function ($exception) {
                        return true;
                    })
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, [
                        'contents' => [[
                            'parts' => [[ 'text' => $prompt ]]
                        ]]
                    ]);

                // Success -> stop trying models
                if ($response->successful()) {
                    break;
                }

                // If NOT 503, it's a real error (auth, bad request, etc.) -> stop and report
                if ($response->status() !== 503) {
                    break;
                }

                // If 503, try next model in the list
                Log::warning('Gemini model overloaded; trying fallback', [
                    'model'  => $model,
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
            }

            if (!$response || !$response->successful()) {
                $status = $response?->status();
                $body   = $response?->body();

                Log::error('Gemini API failed', [
                    'status' => $status,
                    'body'   => $body,
                ]);

                if ($status === 503) {
                    return back()->with('error', 'AI is busy (overloaded). Please try again in 30 seconds.');
                }

                return back()->with('error', 'AI service error: ' . ($status ?? 'unknown'));
            }

            $data = $response->json();
            $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '[]';

            // Remove any accidental code fences
            $cleanJson = str_replace(['```json', '```'], '', $rawText);
            $recipes = json_decode(trim($cleanJson), true);

            if (!is_array($recipes)) {
                Log::error('Gemini returned non-array JSON', [
                    'rawText' => $rawText
                ]);
                return back()->with('error', 'AI response format error. Please try again.');
            }

            // Normalize schema so the Blade can rely on consistent keys
            $recipes = array_map(function ($r) {
                return [
                    'title' => $r['title'] ?? ($r['Title'] ?? 'Untitled'),
                    'ingredients' => $r['ingredients'] ?? ($r['Ingredients List'] ?? ($r['Ingredients'] ?? [])),
                    'instructions' => $r['instructions'] ?? ($r['Brief Instructions'] ?? ($r['Instructions'] ?? '')),
                ];
            }, $recipes);

            return view('ai.result', [
                'recipes' => $recipes,
                'search'  => $ingredients,
            ]);

        } catch (\Throwable $e) {
            Log::error("AI Error: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'AI exception: ' . $e->getMessage());
        }
    }
}
