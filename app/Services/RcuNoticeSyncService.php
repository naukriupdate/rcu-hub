<?php

namespace App\Services;

use App\Models\OfficialNotice;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RcuNoticeSyncService
{
    public function sync(): array
    {
        $apiUrl = SiteSetting::get('rcu_api_url', 'https://www.rcu.edu.in/wp-json/wp/v2/posts');

        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'User-Agent' => 'RCU-Student-Resource-Hub-Bot/1.0',
                    'Accept' => 'application/json',
                ])
                ->get($apiUrl, [
                    'per_page' => 15,
                    '_embed' => 1,
                ]);

            if (!$response->successful()) {
                Log::warning("RCU WordPress API returned status: " . $response->status());
                return [
                    'success' => false,
                    'message' => "WordPress API returned HTTP status {$response->status()}",
                    'synced' => 0,
                ];
            }

            $posts = $response->json();
            if (!is_array($posts)) {
                return [
                    'success' => false,
                    'message' => "Invalid API response format received from university portal.",
                    'synced' => 0,
                ];
            }

            $syncedCount = 0;
            foreach ($posts as $post) {
                if (!isset($post['id'])) continue;

                $externalId = 'wp_' . $post['id'];
                $title = html_entity_decode(strip_tags($post['title']['rendered'] ?? 'Notice'));
                $slug = Str::slug($title) ?: ('notice-' . $post['id']);
                $content = $post['content']['rendered'] ?? '';
                $excerpt = strip_tags($post['excerpt']['rendered'] ?? '');
                $date = isset($post['date']) ? Carbon::parse($post['date']) : now();
                $originalUrl = $post['link'] ?? 'https://www.rcu.edu.in/';

                // Featured image
                $featuredImage = null;
                if (isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                    $featuredImage = $post['_embedded']['wp:featuredmedia'][0]['source_url'];
                }

                // Categorization heuristic based on title and excerpt
                $combinedText = strtolower($title . ' ' . $excerpt);
                $category = 'Others';
                if (str_contains($combinedText, 'exam') || str_contains($combinedText, 'timetable') || str_contains($combinedText, 'admit') || str_contains($combinedText, 'hall ticket') || str_contains($combinedText, 'schedule')) {
                    $category = 'Exams';
                } elseif (str_contains($combinedText, 'result') || str_contains($combinedText, 'marks') || str_contains($combinedText, 'revaluation') || str_contains($combinedText, 'rank')) {
                    $category = 'Results';
                }

                $cleanExcerpt = Str::limit(trim(strip_tags($post['excerpt']['rendered'] ?? '')) ?: trim(strip_tags($content)), 250);
                $isNew = ($syncedCount < 3) || $date->gt(now()->subDays(30));

                OfficialNotice::updateOrCreate(
                    [
                        'external_id' => $externalId,
                        'source' => 'rcu_wordpress_api',
                    ],
                    [
                        'title' => $title,
                        'slug' => $slug,
                        'category' => $category,
                        'excerpt' => $cleanExcerpt,
                        'content' => $content,
                        'published_at' => $date,
                        'featured_image_url' => $featuredImage,
                        'original_url' => $originalUrl,
                        'is_new' => $isNew,
                        'is_active' => true,
                        'last_synced_at' => now(),
                    ]
                );

                $syncedCount++;
            }

            SiteSetting::set('last_notice_sync_time', now()->toDateTimeString(), 'sync');

            return [
                'success' => true,
                'message' => "Successfully synchronized {$syncedCount} official notices from RCU portal.",
                'synced' => $syncedCount,
            ];
        } catch (\Throwable $e) {
            Log::error("Failed to sync RCU notices: " . $e->getMessage());
            return [
                'success' => false,
                'message' => "Could not reach official RCU website: " . $e->getMessage(),
                'synced' => 0,
            ];
        }
    }
}
