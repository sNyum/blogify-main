<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class BpsApiService
{
    protected $apiKey;
    protected $domainId;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.bps.api_key');
        $this->domainId = config('services.bps.domain_id');
        $this->baseUrl = config('services.bps.base_url');
    }

    /**
     * Search for data across Static Tables, Variables, and Publications.
     * 
     * @param string $keyword
     * @return array
     */
    public function searchContent(string $keyword): array
    {
        return Cache::remember('bps_search_v2_' . md5($keyword), 3600, function () use ($keyword) {
            $results = [
                'static_tables' => [],
                'variables' => [],
                'publications' => [],
            ];

            // 1. Search Static Tables
            try {
                $tables = $this->fetchFromApi("list/model/statictable/domain/{$this->domainId}/keyword/{$keyword}");
                if (!empty($tables['data'][1])) {
                    $results['static_tables'] = array_slice($tables['data'][1], 0, 3);
                }
            } catch (\Exception $e) { Log::warning("BPS Table Search Failed: " . $e->getMessage()); }

            // 2. Search Variables (Indicators)
            try {
                $vars = $this->fetchFromApi("list/model/var/domain/{$this->domainId}/keyword/{$keyword}");
                if (!empty($vars['data'][1])) {
                    $results['variables'] = array_slice($vars['data'][1], 0, 3);
                }
            } catch (\Exception $e) { Log::warning("BPS Var Search Failed: " . $e->getMessage()); }

            // 3. Search Publications
            try {
                $pubs = $this->fetchFromApi("list/model/publication/domain/{$this->domainId}/keyword/{$keyword}");
                if (!empty($pubs['data'][1])) {
                    $results['publications'] = array_slice($pubs['data'][1], 0, 3);
                }
            } catch (\Exception $e) { Log::warning("BPS Pub Search Failed: " . $e->getMessage()); }

            return $results;
        });
    }

    /**
     * Fetch detail content for various types.
     */
    public function fetchStaticTableContent(int $tableId): ?string
    {
        return Cache::remember('bps_table_' . $tableId, 86400, function () use ($tableId) {
            $response = $this->fetchFromApi("view/model/statictable/domain/{$this->domainId}/id/{$tableId}");
            if (empty($response['data'])) return null;

            $data = $response['data'];
            return "📋 Tabel: " . ($data['title'] ?? 'N/A') . "\n" .
                   "Update: " . ($data['updt_date'] ?? '-') . "\n" .
                   "Download: " . ($data['excel'] ?? 'N/A');
        });
    }

    public function fetchVariableContent(int $varId): ?string
    {
        return Cache::remember('bps_var_' . $varId, 86400, function () use ($varId) {
            $response = $this->fetchFromApi("list/model/data/domain/{$this->domainId}/var/{$varId}");
            // Variable data structure is complex or requires iteration. 
            // For now, usually the 'view' endpoint for generic var doesn't exist, we use 'data'.
            // If data is complex, we might just return the ID reference.
             if (empty($response['data'])) return null;
             
             // Simplification: just say data exists
             return null; // For now, do not try to parse complex data logic without more testing.
        });
    }

    public function fetchPublicationContent(string $pubId): ?string
    {
        return Cache::remember('bps_pub_' . $pubId, 86400, function () use ($pubId) {
             $response = $this->fetchFromApi("view/model/publication/domain/{$this->domainId}/id/{$pubId}");
             if (empty($response['data'])) return null;

             $data = $response['data'];
             return "📚 Publikasi: " . ($data['title'] ?? 'N/A') . "\n" .
                    "Rilis: " . ($data['rl_date'] ?? '-') . "\n" .
                    "PDF: " . ($data['pdf'] ?? 'N/A') . "\n" . 
                    "Abstract: " . substr(strip_tags($data['abstract'] ?? ''), 0, 100) . "...";
        });
    }

    /**
     * Fetch dynamic variable data.
     * 
     * @param int $varId
     * @return array|null
     */
    public function fetchVariableData(int $varId): ?array
    {
         return Cache::remember('bps_var_' . $varId, 86400, function () use ($varId) {
            return $this->fetchFromApi("list/model/data/domain/{$this->domainId}/var/{$varId}");
         });
    }

    /**
     * General method to make API calls.
     */
    protected function fetchFromApi(string $endpoint)
    {
        $url = "{$this->baseUrl}/{$endpoint}/key/{$this->apiKey}/";
        
        try {
            $response = Http::timeout(10)->get($url);
            
            if ($response->successful()) {
                $data = $response->json();
                if (($data['status'] ?? '') === 'OK') {
                    return $data;
                }
            }
            
            Log::warning("BPS API Error: " . $url . " - " . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error("BPS API Exception: " . $e->getMessage());
            return null;
        }
    }
}
