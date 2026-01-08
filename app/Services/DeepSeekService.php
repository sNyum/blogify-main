<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepSeekService
{
    protected $apiKey;
    protected $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';
    protected $model = 'deepseek/deepseek-r1-0528:free';

    public function __construct()
    {
        // Use the provided key as fallback if not in env
        $this->apiKey = env('DEEPSEEK_API_KEY', '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');
    }

    public function generateResponse(array $messages)
    {
        if (empty($this->apiKey)) {
            return "Maaf, sistem chatbot belum dikonfigurasi dengan benar (API Key missing).";
        }

        try {
            $response = Http::withOptions([
                'verify' => false,
                'timeout' => 30,
                'connect_timeout' => 30,
            ])
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => url('/'), // Optional, for OpenRouter rankings
                'X-Title' => config('app.name', 'Laravel App'), // Optional
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.7,
                'top_p' => 0.9,
                // 'max_tokens' => 1024, // Optional, let model decide or set limit
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['choices'][0]['message']['content'])) {
                    return $data['choices'][0]['message']['content'];
                }
            }
            
            Log::error('DeepSeek API Error: ' . $response->body());
            return "Maaf, saya sedang mengalami gangguan saat menghubungi server otak saya. Silakan coba lagi nanti. (Status: " . $response->status() . ")";

        } catch (\Exception $e) {
            Log::error('DeepSeek Exception: ' . $e->getMessage());
            return "Maaf, sistem sedang sibuk atau mengalami gangguan koneksi. Silakan coba sesaat lagi.";
        }
    }
}
