<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected $apiKey;
    protected $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected $model = 'xiaomi/mimo-v2-flash:free';

    public function __construct()
    {
        // Use the provided key
        $this->apiKey = env('OPENROUTER_API_KEY', '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');
    }

    public function generateResponse(array $messages)
    {
        if (empty($this->apiKey)) {
            return "Maaf, sistem chatbot belum dikonfigurasi dengan benar (API Key missing).";
        }

        $maxRetries = 3;
        $retryDelay = 2; // seconds

        for ($attempt = 0; $attempt < $maxRetries; $attempt++) {
            try {
                $response = Http::withOptions([
                    'verify' => false,
                    'timeout' => 30, // Increased timeout for complex queries
                    'connect_timeout' => 30,
                ])
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'HTTP-Referer' => url('/'), 
                    'X-Title' => config('app.name', 'Laravel App'),
                    'Content-Type' => 'application/json',
                ])->post($this->baseUrl, [
                    'model' => $this->model,
                    'messages' => $messages,
                    'temperature' => 0.7,
                    'top_p' => 0.9,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['choices'][0]['message']['content'])) {
                        return $data['choices'][0]['message']['content'];
                    }
                }
                
                // If 429, retry
                if ($response->status() === 429) {
                    Log::warning("OpenRouter 429 Rate Limit hit. Retrying attempt " . ($attempt + 1) . "...");
                    sleep($retryDelay * ($attempt + 1)); // Exponential backoff (2s, 4s, 6s)
                    continue;
                }

                Log::error('OpenRouter API Error: ' . $response->body());
                return "Maaf, saya sedang mengalami gangguan saat menghubungi server otak saya. Silakan coba lagi nanti. (Status: " . $response->status() . ")";

            } catch (\Exception $e) {
                // If this is the last attempt, return error
                if ($attempt === $maxRetries - 1) {
                    Log::error('OpenRouter Exception: ' . $e->getMessage());
                    return "Maaf, sistem sedang sibuk atau mengalami gangguan koneksi. Silakan coba sesaat lagi.";
                }
                sleep($retryDelay);
            }
        }

        // FALLBACK: If Gemini fails, try DeepSeek
        Log::warning("Gemini 2.0 Flash unavailable. Falling back to DeepSeek R1...");
        
        try {
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 45,
                'connect_timeout' => 30,
            ])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => url('/'),
                'X-Title' => config('app.name', 'Laravel App'),
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => 'deepseek/deepseek-r1:free', // Fallback Model
                'messages' => $messages,
                'temperature' => 0.7,
                'top_p' => 0.9,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['choices'][0]['message']['content'])) {
                    return $data['choices'][0]['message']['content'] . "\n\n*(Dijawab menggunakan DeepSeek R1 karena server Gemini sedang sibuk)*";
                }
            }
        } catch (\Exception $e) {
            Log::error('OpenRouter Fallback Exception: ' . $e->getMessage());
        }
        
        return "Maaf, sistem sedang sibuk (Semua model AI penuh). Silakan coba beberapa saat lagi.";
    }
}
