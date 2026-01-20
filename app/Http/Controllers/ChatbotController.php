<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\OpenRouterService;
use App\Services\BPSSearchService;
use App\Services\KBLISearchService;
use App\Services\BpsApiService; // New Import

class ChatbotController extends Controller
{
    protected $openRouterService;
    protected $bpsSearchService;
    protected $kbliSearchService;
    protected $bpsApiService; // New Property

    public function __construct(
        OpenRouterService $openRouterService, 
        BPSSearchService $bpsSearchService,
        KBLISearchService $kbliSearchService,
        BpsApiService $bpsApiService // New Injection
    )
    {
        $this->openRouterService = $openRouterService;
        $this->bpsSearchService = $bpsSearchService;
        $this->kbliSearchService = $kbliSearchService;
        $this->bpsApiService = $bpsApiService; // New Assignment
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

        // Perform Static JSON Search (Existing)
        $searchResults = $this->bpsSearchService->search($userMessage);

        // Perform Real-Time BPS API Search (New)
        $apiResults = [];
        try {
            // Only search API if message seems like a data query
            if (strlen($userMessage) > 3) {
                 $apiResults = $this->bpsApiService->searchContent($userMessage);
            }
        } catch (\Exception $e) {
            Log::warning('BPS API Search Failed: ' . $e->getMessage());
        }

        // Prepare system prompt
        $systemPrompt = "ROLE: Anda adalah 'Asisten CERDAS', chatbot resmi BPS Kabupaten Batanghari.\n" .
            "INSTRUCTION: Jawab pertanyaan dalam Bahasa Indonesia yang sopan, profesional, dan BERBASIS DATA.\n" .
            "CONTEXT (INTERNAL KNOWLEDGE):\n" .
            $knowledgeBase . "\n\n" .
            "CONTEXT (STATIC SEARCH RESULTS):\n" .
            $searchResults . "\n\n";

        // Inject API Results if available
        if (!empty($apiResults['static_tables']) || !empty($apiResults['variables']) || !empty($apiResults['publications'])) {
             $systemPrompt .= "CONTEXT (REAL-TIME BPS API RESULTS - SANGAT TERPERCAYA):\n" . json_encode($apiResults, JSON_UNESCAPED_UNICODE) . "\n\n";
        }
            
        $systemPrompt .= "FORMATTING RULES (PENTING):\n" .
            "1. Jika memberikan data statistik, WAJIB sertakan DUA format berikut di akhir respon:\n" .
            "   a. VISUALISASI GRAFIK:\n" .
            "      [[CHART:{\"type\":\"bar\",\"labels\":[\"A\",\"B\"],\"data\":[10,20],\"title\":\"Judul Grafik\"}]]\n" .
            "   b. DATA TABEL (Untuk Download/View):\n" .
            "      [[TABLE:{\"columns\":[\"Kolom1\",\"Kolom2\"],\"rows\":[[\"Data1\",10],[\"Data2\",20]],\"title\":\"Nama File\"}]]\n\n" .
            "   (Berikan keduanya agar user bisa melihat grafik DAN mendownload data).\n\n" .
            "CONSTRAINT: Gunakan informasi dari Context (Knowledge Base atau Search Results) sebagai prioritas. Jika tidak ada info, arahkan ke website BPS. Jangan mengarang data.";

        // INJECT STATIC DATA FROM CONFIG
        $bpsConfigs = [
            'bps_fun_facts', 
            'bps_demography', 
            'bps_pdrb', 
            'bps_education_index', 
            'bps_health_index',
            'bps_labor_participation',
            'bps_unemployment_rate',
            'bps_poverty_index',
            'bps_human_development_index', // Verify if this exists, if not, skip
            'bps_gini_ratio', // Verify
            'bps_population_growth',
            'bps_population_density',
            'bps_sex_ratio', // Verify name
            'bps_marriage',
            'bps_crime_statistics'
        ];
        
        // INJECT STATIC DATA FROM CONFIG (SMART SELECTION / PRIMITIVE RAG)
        // To prevent Context Window Overflow, we only inject relevant datasets based on keywords.
        
        $availableDatasets = [
            'bps_marriage' => ['nikah', 'kawin', 'cerai', 'rujuk', 'pernikahan', 'perkawinan'],
            'bps_demography' => ['penduduk', 'warga', 'jiwa', 'demografi', 'laki', 'perempuan', 'umur'],
            'bps_population_growth' => ['pertumbuhan', 'laju'],
            'bps_population_density' => ['kepadatan', 'padat'],
            'bps_pdrb' => ['pdrb', 'ekonomi', 'pendapatan', 'uang', 'rupiah'],
            'bps_education_index' => ['sekolah', 'pendidikan', 'kuliah', 'sd', 'smp', 'sma', 'guru'],
            'bps_health_index' => ['sehat', 'sakit', 'kesehatan', 'obat', 'rs', 'puskesmas'],
            'bps_life_expectancy' => ['harapan hidup', 'umur panjang'],
            'bps_poverty_index' => ['miskin', 'kemiskinan', 'sejahtera'],
            'bps_unemployment_rate' => ['ganggur', 'kerja', 'lowongan', 'tpk'],
            'bps_labor_participation' => ['angkatan kerja', 'bekerja'],
            'bps_road_length' => ['jalan', 'aspal', 'rusak', 'infrastruktur', 'transportasi'],
            'bps_vehicles' => ['kendaraan', 'mobil', 'motor'],
            'bps_crime_statistics' => ['kriminal', 'kejahatan', 'pencurian', 'polisi'],
            'bps_fun_facts' => ['fakta', 'unik', 'tahu gak', 'tahukah', 'batang hari', 'batanghari'],
            'opendata_jambi_index' => ['jambi', 'provinsi'],
            'bps_palm_oil' => ['sawit', 'karet', 'kebun', 'tanam', 'perkebunan', 'kelapa sawit'],
            'bps_trade' => ['dagang', 'ekspor', 'impor', 'trade', 'neraca'],
            'bps_expenditure' => ['pengeluaran', 'teh', 'makanan', 'konsumsi'],
            'bps_population_age' => ['umur', 'usia', 'muda', 'tua', 'produktif'],
            'bps_se2026' => ['sensus', 'ekonomi', '2026', 'usaha'],
            'bps_field_stories' => ['cerita', 'lapangan', 'suka duka', 'petugas'],
            'bps_population_by_district' => ['kecamatan', 'sebaran', 'distribusi penduduk'],
            'bps_population_distribution' => ['persentase penduduk', 'distribusi'],
            'bps_schooling_years' => ['lama sekolah', 'rls', 'hls', 'rata-rata sekolah'],
            'bps_vital_statistics' => ['kelahiran', 'kematian', 'lahir', 'mati', 'vital'],
        ];

        $matchedDatasets = [];
        $lowerMessage = strtolower($userMessage);

        foreach ($availableDatasets as $configKey => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($lowerMessage, $keyword) !== false) {
                    $matchedDatasets[] = $configKey;
                    break; // Found a match for this dataset, move to next
                }
            }
        }

        // Always include 'bps_fun_facts' if nothing else matches or as default
        if (empty($matchedDatasets)) {
            $matchedDatasets[] = 'bps_fun_facts';
        }

        // Dedup
        $matchedDatasets = array_unique($matchedDatasets);

        $staticContext = "";
        foreach ($matchedDatasets as $key) {
            $data = config($key);
            if (!empty($data)) {
                $staticContext .= "\n[DATASET: " . strtoupper($key) . "]\n" . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n";
            }
        }

        if (!empty($staticContext)) {
            $systemPrompt .= "\n\nCONTEXT (STATIC BPS DATASETS - RELEVANT):\n" . $staticContext;
        }

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
            // 4. KBLI 2025 Context Injection (RAG - Local PDF Data)
        // Check if query is related to KBLI
        if (stripos($userMessage, 'kbli') !== false || stripos($userMessage, 'usaha') !== false || stripos($userMessage, 'kode') !== false || stripos($userMessage, 'bisnis') !== false || stripos($userMessage, 'dagang') !== false) {
            $kbliResults = $this->kbliSearchService->search($userMessage);
            if (!empty($kbliResults)) {
                $systemPrompt .= "\n\n[SUMBER DATA KBLI 2025 (PDF INTERNAL)]:\n";
                foreach ($kbliResults as $result) {
                    $systemPrompt .= "- (Halaman " . $result['page'] . "): " . substr($result['content'], 0, 800) . "...\n";
                }
                $systemPrompt .= "\nGunakan informasi di atas untuk menjawab pertanyaan terkait kode KBLI atau klasifikasi lapangan usaha.\n";
            }
        }

        // 5. Generate Response via OpenRouter (Gemini/Xiaomi)
            $reply = $this->openRouterService->generateResponse($messages);

            
            return response()->json(['reply' => $reply, 'status' => 'success']);

        } catch (\Exception $e) {
            Log::error('Chatbot Fatal Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan sistem fatal.', 'status' => 'error'], 500);
        }
    }
}
