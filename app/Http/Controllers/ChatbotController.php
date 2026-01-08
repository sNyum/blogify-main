<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\OpenRouterService;
use App\Services\BPSSearchService;

class ChatbotController extends Controller
{
    protected $openRouterService;
    protected $bpsSearchService;

    public function __construct(OpenRouterService $openRouterService, BPSSearchService $bpsSearchService)
    {
        $this->openRouterService = $openRouterService;
        $this->bpsSearchService = $bpsSearchService;
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

        // Perform BPS Search
        // We always search to provide up-to-date context, or we could condition it
        $searchResults = $this->bpsSearchService->search($userMessage);

        // Prepare system prompt
        $systemPrompt = "ROLE: Anda adalah 'Asisten CERDAS', chatbot resmi BPS Kabupaten Batanghari.\n" .
            "INSTRUCTION: Jawab pertanyaan dalam Bahasa Indonesia yang sopan, profesional, dan BERBASIS DATA.\n" .
            "CONTEXT (INTERNAL KNOWLEDGE):\n" .
            $knowledgeBase . "\n\n" .
            "CONTEXT (REAL-TIME SEARCH RESULTS):\n" .
            $searchResults . "\n\n" . // Inject Search Results Here
            "FORMATTING RULES (PENTING):\n" .
            "1. Jika user meminta VISUALISASI DATA / GRAFIK, berikan data JSON khusus di akhir respon dengan format:\n" .
            "   [[CHART:{\"type\":\"bar\",\"labels\":[\"A\",\"B\"],\"data\":[10,20],\"title\":\"Judul Grafik\"}]]\n" .
            "   (Gunakan type: 'bar' atau 'line' atau 'pie').\n\n" .
            "2. Jika user meminta DOWNLOAD DATA / TABEL EXCEL, berikan data JSON khusus di akhir respon dengan format:\n" .
            "   [[TABLE:{\"columns\":[\"Kolom1\",\"Kolom2\"],\"rows\":[[\"Data1\",10],[\"Data2\",20]],\"title\":\"Nama File\"}]]\n\n" .
            "CONSTRAINT: Gunakan informasi dari Context (Knowledge Base atau Search Results) sebagai prioritas. Jika tidak ada info, arahkan ke website BPS. Jangan mengarang data.";

        // Construct Messages Array for DeepSeek (OpenAI compatible)
        $messages = [];
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        
        // Add History
        foreach ($history as $msg) {
            // Skip if message doesn't have required fields
            if (!isset($msg['text']) || !isset($msg['isUser'])) {
                continue;
            }
            
            $role = $msg['isUser'] ? 'user' : 'assistant'; // OpenAI uses 'assistant', Gemini used 'model'
            $messages[] = ['role' => $role, 'content' => $msg['text']];
        }

        // Add Current User Message
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            // 5. Generate Response via OpenRouter (Gemini)
            $reply = $this->openRouterService->generateResponse($messages);

            
            return response()->json(['reply' => $reply, 'status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Chatbot Fatal Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan sistem fatal.', 'status' => 'error'], 500);
        }
    }
}
