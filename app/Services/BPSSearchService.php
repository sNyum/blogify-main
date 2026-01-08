<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class BPSSearchService
{
    public function search(string $query): string
    {
        // Add BPS site context to the query
        $bpsQuery = "site:batangharikab.bps.go.id OR site:bps.go.id " . $query;
        $url = 'https://html.duckduckgo.com/html/?q=' . urlencode($bpsQuery);
        
        return $this->scrapeDuckDuckGo($url);
    }

    private function scrapeDuckDuckGo($url)
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
            ])->withOptions(['verify' => false])->get($url);

            if ($response->failed()) {
                Log::error("DDG Search Failed: " . $response->status());
                return "Maaf, saya sedang mengalami gangguan koneksi ke pencarian BPS.";
            }

            $html = $response->body();
            $crawler = new Crawler($html);
            $items = [];

            // DuckDuckGo HTML Selectors
            $crawler->filter('.result')->each(function (Crawler $node) use (&$items) {
                if (count($items) >= 5) return; // Limit to 5 results

                try {
                    $titleNode = $node->filter('.result__title > a');
                    $snippetNode = $node->filter('.result__snippet');

                    if ($titleNode->count() > 0) {
                        $title = trim($titleNode->text());
                        $rawHref = $titleNode->attr('href');
                        
                        // Extract real URL from DDG redirect (//duckduckgo.com/l/?uddg=REAL_URL&rut=...)
                        $link = $rawHref;
                        parse_str(parse_url($rawHref, PHP_URL_QUERY), $params);
                        if (isset($params['uddg'])) {
                            $link = $params['uddg'];
                        }

                        $snippet = $snippetNode->count() > 0 ? trim($snippetNode->text()) : '';

                        if (!empty($title) && !empty($link)) {
                            $items[] = [
                                'title' => $title,
                                'link' => $link,
                                'snippet' => $snippet
                            ];
                        }
                    }
                } catch (\Exception $e) {
                    // Ignore parsing error for single item
                }
            });

            if (empty($items)) {
                return "Maaf, tidak ditemukan hasil pencarian di BPS untuk kata kunci tersebut.";
            }

            $output = "Berikut informasi terbaru dari Web BPS:\n\n";
            foreach ($items as $item) {
                $output .= "- [" . $item['title'] . "](" . $item['link'] . ")\n";
                if (!empty($item['snippet'])) {
                    $output .= "  " . $item['snippet'] . "\n";
                }
                $output .= "\n";
            }

            return $output;

        } catch (\Exception $e) {
            Log::error("Search Service Error: " . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mencari data.";
        }
    }
}
