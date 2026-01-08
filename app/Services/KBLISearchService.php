<?php

namespace App\Services;

class KBLISearchService
{
    protected $dataPath;
    protected $data = null;

    public function __construct()
    {
        $this->dataPath = storage_path('app/kbli_data.json');
    }

    public function search(string $query, int $limit = 3): array
    {
        // Load data if not loaded
        if ($this->data === null) {
            if (!file_exists($this->dataPath)) {
                return [];
            }
            $json = file_get_contents($this->dataPath);
            $this->data = json_decode($json, true);
        }

        if (empty($this->data)) {
            return [];
        }

        $results = [];
        $queryLower = strtolower($query);
        $keywords = explode(' ', $queryLower);

        // Simple scoring based on keyword matches
        foreach ($this->data as $item) {
            $contentLower = strtolower($item['content']);
            $score = 0;
            $matches = 0;

            foreach ($keywords as $keyword) {
                if (strlen($keyword) < 3) continue; // Skip short words
                if (strpos($contentLower, $keyword) !== false) {
                    $score++;
                    $matches++;
                }
            }

            if ($matches > 0) {
                // Boost score if the content contains "KBLI" + a code (e.g. 0111) closer to the keyword match?
                // For now, simple keyword extraction is enough for RAG context.
                
                // If query is looking for a specific code (e.g. "01111"), boost heavily
                if (preg_match('/\d{4,5}/', $query, $codeMatch)) {
                    if (strpos($contentLower, $codeMatch[0]) !== false) {
                        $score += 10;
                    }
                }

                $results[] = [
                    'page' => $item['page'],
                    'content' => $item['content'],
                    'score' => $score
                ];
            }
        }

        // Sort by score descending
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Return top N
        return array_slice($results, 0, $limit);
    }
}
