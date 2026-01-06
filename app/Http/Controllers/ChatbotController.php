<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private $apiKey;
    private $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent';

    public function __construct()
    {
        $this->apiKey = trim(env('GEMINI_API_KEY', ''));
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'array',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        if (empty($this->apiKey)) {
            Log::error('Gemini API Key is missing');
            return response()->json([
                'reply' => 'Maaf, sistem sedang dalam konfigurasi (API Key hilang).',
                'status' => 'error'
            ], 500);
        }

        // Load knowledge base
        $knowledgeBase = '';
        $kbPath = resource_path('chatbot/knowledge_base.txt');
        if (file_exists($kbPath)) {
            $knowledgeBase = file_get_contents($kbPath);
        }

        // Prepare system prompt
        $systemPrompt = "ROLE: Anda adalah 'Asisten CERDAS', chatbot resmi BPS Kabupaten Batanghari.\n" .
            "INSTRUCTION: Jawab pertanyaan dalam Bahasa Indonesia yang sopan dan profesional.\n" .
            "CONTEXT: Gunakan informasi berikut sebagai referensi utama:\n" .
            $knowledgeBase . "\n\n" .
            "CONSTRAINT: Jika jawaban tidak ada di Context, arahkan user ke kontak BPS. Jangan mengarang data.";

        $contents = [];
        $contents[] = ['role' => 'user', 'parts' => [['text' => $systemPrompt]]];
        $contents[] = ['role' => 'model', 'parts' => [['text' => 'Mengerti. Saya siap membantu sebagai Asisten CERDAS BPS Batanghari.']]];

        foreach ($history as $msg) {
            $role = $msg['role'] === 'user' ? 'user' : 'model';
            $contents[] = ['role' => $role, 'parts' => [['text' => $msg['content']]]];
        }

        $contents[] = ['role' => 'user', 'parts' => [['text' => $userMessage]]];

        // Configuration for Google Search (Grounding)
        $tools = [
            [
                'googleSearch' => (object)[] // Empty object for standard google search
            ]
        ];

        try {
            // Attempt 1: Try with Google Search
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($this->apiUrl . '?key=' . $this->apiKey, [
                    'contents' => $contents,
                    'tools' => $tools,
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 1024,
                    ]
                ]);

            if (!$response->successful()) {
                throw new \Exception('API Error with Tools: ' . $response->body());
            }

            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat memahami respons.';
            
            return response()->json(['reply' => $reply, 'status' => 'success']);

        } catch (\Exception $e) {
            // Log the error but don't fail yet
            Log::warning('Chatbot Search Tool Failed, retrying without tools. Error: ' . $e->getMessage());

            // Attempt 2: Fallback without tools (Standard text generation)
            try {
                $response = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->post($this->apiUrl . '?key=' . $this->apiKey, [
                        'contents' => $contents,
                        // No tools here
                        'generationConfig' => [
                            'temperature' => 0.7,
                            'topK' => 40,
                            'topP' => 0.95,
                            'maxOutputTokens' => 1024,
                        ]
                    ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat memahami respons.';
                    return response()->json(['reply' => $reply, 'status' => 'success']);
                } else {
                    Log::error('Gemini API Fallback Error: ' . $response->body());
                    return response()->json([
                        'reply' => 'Maaf, saat ini saya mengalami gangguan koneksi. Mohon coba lagi nanti.',
                        'status' => 'error',
                        'debug' => $response->body()
                    ], 502);
                }
            } catch (\Exception $ex) {
                Log::error('Chatbot Fatal Error: ' . $ex->getMessage());
                return response()->json(['reply' => 'Terjadi kesalahan sistem fatal.', 'status' => 'error'], 500);
            }
        }
    }
}
