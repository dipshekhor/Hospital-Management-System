<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class NewsService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.newsapi.key');
        $this->baseUrl = config('services.newsapi.url');
    }

    public function getHealthNews($limit = 3)
    {
        // Cache for 30 minutes to avoid hitting API limits but get fresher news
        return Cache::remember('health_news', 1800, function () use ($limit) {
            try {
                // Use top-headlines endpoint with health category for better filtering
                $response = $this->client->get('https://newsapi.org/v2/top-headlines', [
                    'query' => [
                        'category' => 'health',
                        'language' => 'en',
                        'pageSize' => $limit,
                        'apiKey' => $this->apiKey,
                    ],
                    'timeout' => 5, // 5 second timeout
                    'connect_timeout' => 3 // 3 second connection timeout
                ]);

                $data = json_decode($response->getBody(), true);
                
                // Filter out any political content that might slip through
                $articles = $data['articles'] ?? [];
                $filteredArticles = array_filter($articles, function($article) {
                    $title = strtolower($article['title'] ?? '');
                    $description = strtolower($article['description'] ?? '');
                    
                    // Exclude political keywords
                    $politicalKeywords = ['trump', 'biden', 'election', 'senate', 'congress', 'minister', 'parliament', 'politics', 'government'];
                    
                    foreach ($politicalKeywords as $keyword) {
                        if (str_contains($title, $keyword) || str_contains($description, $keyword)) {
                            return false;
                        }
                    }
                    
                    return true;
                });
                
                return array_values($filteredArticles);

            } catch (\Exception $e) {
                Log::error('News API Error: ' . $e->getMessage());
                return $this->getFallbackNews();
            }
        });
    }

    private function getFallbackNews()
    {
        // Return static fallback news if API fails
        return [
            [
                'title' => 'List of Countries without Coronavirus case',
                'description' => 'Stay updated with global health news',
                'url' => '#',
                'urlToImage' => asset('fronend/assets/img/blog/blog_1.jpg'),
                'publishedAt' => now()->subWeek()->toISOString(),
                'source' => ['name' => 'Health News'],
                'author' => 'Health Desk'
            ],
            [
                'title' => 'Recovery Room: News beyond the pandemic',
                'description' => 'Latest medical breakthroughs',
                'url' => '#',
                'urlToImage' => asset('fronend/assets/img/blog/blog_2.jpg'),
                'publishedAt' => now()->subWeeks(4)->toISOString(),
                'source' => ['name' => 'Medical Journal'],
                'author' => 'Medical Team'
            ],
            [
                'title' => 'What is the impact of eating too much sugar?',
                'description' => 'Nutrition and health insights',
                'url' => '#',
                'urlToImage' => asset('fronend/assets/img/blog/blog_3.jpg'),
                'publishedAt' => now()->subMonths(2)->toISOString(),
                'source' => ['name' => 'Health Magazine'],
                'author' => 'Nutrition Expert'
            ]
        ];
    }
}
