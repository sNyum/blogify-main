<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function generateResponse($userMessage, $history = [])
    {
        if (empty($this->apiKey)) {
            return "Maaf, sistem chatbot belum dikonfigurasi dengan benar (API Key missing).";
        }

        try {
            // Load Knowledge Base
            $knowledgeBase = "";
            if (file_exists(resource_path('chatbot/knowledge_base.txt'))) {
                $knowledgeBase = file_get_contents(resource_path('chatbot/knowledge_base.txt'));
            }

            // Construct System Prompt
            $systemPrompt = "Anda adalah Asisten CERDAS, chatbot resmi BPS Kabupaten Batanghari. " .
                "Gunakan informasi berikut sebagai pengetahuan dasar Anda:\n\n" . $knowledgeBase . 
                "\n\nJawablah dengan ramah, akurat, dan dalam Bahasa Indonesia yang baik. " .
                "Jika tidak tahu jawabannya, arahkan ke kontak resmi BPS. Jangan mengarang data.";

            // Format History for Gemini (if implementing history later)
            // For now, we simple send the current message with system prompt context
            
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemPrompt . "\n\nUser: " . $userMessage . "\nAsisten CERDAS:"]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '?key=' . $this->apiKey, $payload);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    return $data['candidates'][0]['content']['parts'][0]['text'];
                }
            }

            Log::error('Gemini API Error: ' . $response->body());
            return "Maaf, saya sedang mengalami gangguan saat menghubungi server otak saya. Silakan coba lagi nanti.";

        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return "Terjadi kesalahan pada sistem. Silakan hubungi admin.";
        }
    }
}
