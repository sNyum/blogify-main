<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private $apiKey;
    private $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = env('GEMINI_API_KEY');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'array',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        // Load knowledge base
        $knowledgeBase = '';
        $kbPath = resource_path('chatbot/knowledge_base.txt');
        if (file_exists($kbPath)) {
            $knowledgeBase = file_get_contents($kbPath);
        }

        // Prepare system prompt
        $systemPrompt = "Anda adalah 'Asisten CERDAS', chatbot resmi BPS Kabupaten Batanghari. " .
            "Gunakan Bahasa Indonesia yang baik, sopan, dan profesional. " .
            "Jawab pertanyaan berdasarkan informasi berikut:\n\n" .
            $knowledgeBase . "\n\n" .
            "Jika jawaban tidak ada di informasi di atas, arahkan user untuk menghubungi kontak BPS. " .
            "Jangan mengarang data statistik. Jawab dengan ringkas.";

        // Format history for Gemini API
        // Gemini expects: contents: [{ role: 'user', parts: [{ text: '...' }] }, { role: 'model', parts: [{ text: '...' }] }]
        $contents = [];
        
        // Add system instruction as the first user message (a common trick if systemInstruction param is tricky, 
        // but Gemini 1.5 supports systemInstruction field properly)
        // We will use systemInstruction field.

        foreach ($history as $msg) {
            $role = $msg['role'] === 'user' ? 'user' : 'model';
            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $msg['content']]
                ]
            ];
        }

        // Add current message
        $contents[] = [
            'role' => 'user',
            'parts' => [
                ['text' => $userMessage]
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => $contents,
                'systemInstruction' => [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.7,
                    'topK' => 40,
                    'topP' => 0.95,
                    'maxOutputTokens' => 1024,
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak dapat memproses permintaan Anda saat ini.';
                
                return response()->json([
                    'reply' => $reply,
                    'status' => 'success'
                ]);
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json([
                    'reply' => 'Maaf, terjadi kesalahan pada sistem layanan AI kami. Silakan coba lagi nanti.',
                    'status' => 'error',
                    'debug' => $response->body() // Remove in production
                ], 502);
            }
        } catch (\Exception $e) {
            Log::error('Chatbot Exception: ' . $e->getMessage());
            return response()->json([
                'reply' => 'Maaf, terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda.',
                'status' => 'error'
            ], 500);
        }
    }
}
