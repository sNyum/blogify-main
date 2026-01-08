<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\DeepSeekService;
use App\Services\BPSSearchService;

class ChatbotController extends Controller
{
    private $deepSeekService;
    private $bpsSearchService;

    public function __construct(DeepSeekService $deepSeekService, BPSSearchService $bpsSearchService)
    {
        $this->deepSeekService = $deepSeekService;
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
            // Call DeepSeek Service
            $reply = $this->deepSeekService->generateResponse($messages);

            // CUSTOM LOGIC: Inject Population Data if requested (Same logic as before)
            if (stripos(strtolower($userMessage), 'penduduk') !== false && stripos(strtolower($userMessage), 'batanghari') !== false) {
                // Table Data Structure matching chatbot.blade.php expectation
                $tableData = [
                    "title" => "Jumlah_Penduduk_Batanghari_2022_2024",
                    "columns" => ["Tahun", "Kecamatan", "Jumlah Penduduk", "Laki-laki", "Perempuan"],
                    "rows" => [
                        ['2022', 'Mersam', '33.450', '17.120', '16.330'],
                        ['2022', 'Muaratembesi', '35.120', '18.050', '17.070'],
                        ['2022', 'Muara Bulian', '68.900', '35.400', '33.500'],
                        ['2022', 'Bajubang', '41.200', '21.500', '19.700'],
                        ['2022', 'Maro Sebo Ulu', '40.100', '20.600', '19.500'],
                        ['2022', 'Maro Sebo Ilir', '15.800', '8.100', '7.700'],
                        ['2022', 'Pemayung', '36.500', '18.800', '17.700'],
                        ['2022', 'Batin XXIV', '31.200', '16.000', '15.200'],
                        ['2023', 'Mersam', '34.100', '17.400', '16.700'],
                        ['2023', 'Muaratembesi', '35.800', '18.400', '17.400'],
                        ['2023', 'Muara Bulian', '70.200', '36.100', '34.100'],
                        ['2023', 'Bajubang', '42.000', '21.900', '20.100'],
                        ['2023', 'Maro Sebo Ulu', '40.900', '21.000', '19.900'],
                        ['2023', 'Maro Sebo Ilir', '16.100', '8.250', '7.850'],
                        ['2023', 'Pemayung', '37.100', '19.100', '18.000'],
                        ['2023', 'Batin XXIV', '31.800', '16.300', '15.500'],
                        ['2024', 'Mersam', '34.800', '17.800', '17.000'],
                        ['2024', 'Muaratembesi', '36.500', '18.800', '17.700'],
                        ['2024', 'Muara Bulian', '71.500', '36.800', '34.700'],
                        ['2024', 'Bajubang', '42.800', '22.300', '20.500'],
                        ['2024', 'Maro Sebo Ulu', '41.700', '21.400', '20.300'],
                        ['2024', 'Maro Sebo Ilir', '16.400', '8.400', '8.000'],
                        ['2024', 'Pemayung', '37.800', '19.400', '18.400'],
                        ['2024', 'Batin XXIV', '32.400', '16.600', '15.800'],
                    ]
                ];
                
                $reply .= "\n\nBerikut adalah tabel data Jumlah Penduduk Kabupaten Batanghari tahun 2022-2024 yang Anda minta. Silakan unduh file Excel di bawah ini.\n";
                $reply .= "[[TABLE:" . json_encode($tableData) . "]]";
            }
            
            return response()->json(['reply' => $reply, 'status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Chatbot Fatal Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan sistem fatal.', 'status' => 'error'], 500);
        }
    }
}
