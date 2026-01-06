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

        // Format for Gemini API
        // We will inject the system prompt as the very first 'user' part to ensure compatibility
        $contents = [];
        
        // 1. Add System Prompt
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $systemPrompt]]
        ];

        // 2. Add Model Acknowledgement (to prime the conversation)
        $contents[] = [
            'role' => 'model',
            'parts' => [['text' => 'Mengerti. Saya siap membantu sebagai Asisten CERDAS BPS Batanghari.']]
        ];

        // 3. Add History
        foreach ($history as $msg) {
            $role = $msg['role'] === 'user' ? 'user' : 'model';
            $contents[] = [
                'role' => $role,
                'parts' => [['text' => $msg['content']]]
            ];
        }

        // 4. Add Current Message
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $userMessage]]
        ];

        try {
            // Log::info('Sending request to Gemini: ' . $this->apiUrl); 
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => $contents,
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
                
                return response()->json([
                    'reply' => $reply,
                    'status' => 'success'
                ]);
            } else {
                Log::error('Gemini API Error (' . $response->status() . '): ' . $response->body());
                return response()->json([
                    'reply' => 'Maaf, terjadi masalah koneksi ke AI. Silakan coba lagi.',
                    'status' => 'error',
                    'debug' => $response->body()
                ], 502);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'reply' => 'Maaf, terjadi kesalahan sistem.',
                'status' => 'error'
            ], 500);
        }
    }
}
