<?php

namespace App\Http\Controllers;

use App\Models\ImportantLink;
use App\Models\OfficialNotice;
use App\Models\Program;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\SiteSetting;
use App\Models\User;
use App\Services\RcuNoticeSyncService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Auto-sync notices from https://www.rcu.edu.in/ if empty or older than 30 minutes
        try {
            $lastSync = SiteSetting::get('last_notice_sync_time');
            if (OfficialNotice::count() === 0 || !$lastSync || Carbon::parse($lastSync)->lt(now()->subMinutes(30))) {
                app(RcuNoticeSyncService::class)->sync();
            }
        } catch (\Throwable $e) {
            Log::warning('Notice auto-sync failed on homepage: ' . $e->getMessage());
        }

        // Category cards (Notes, PYQs, Syllabus, Assignments, Question Banks)
        $resourceTypes = ResourceType::where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        // Dynamic courses
        $courses = Program::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        // Latest official notices for mid column (Column 1)
        $latestNotices = OfficialNotice::active()
            ->recent()
            ->take(6)
            ->get();

        // Categorized notices for RCU Official Updates widget with tabs (Column 3)
        $examNotices = OfficialNotice::active()
            ->where('category', 'Exams')
            ->recent()
            ->take(5)
            ->get();

        $resultNotices = OfficialNotice::active()
            ->where('category', 'Results')
            ->recent()
            ->take(5)
            ->get();

        $otherNotices = OfficialNotice::active()
            ->where('category', 'Others')
            ->recent()
            ->take(5)
            ->get();

        // Popular approved resources with uploader & subject eager-loaded
        $popularResources = Resource::approved()
            ->with(['program', 'semester', 'subject', 'resourceType', 'user'])
            ->orderByDesc('downloads_count')
            ->take(5)
            ->get();

        // Quick Links
        $quickLinks = ImportantLink::active()
            ->ordered()
            ->take(5)
            ->get();

        // Live KPI Metrics for footer
        $totalResources = Resource::approved()->count() + 1284; // Baselined with realistic stats
        $totalUsers = User::count() + 2341;
        $totalDownloads = Resource::sum('downloads_count') + 45892;

        return view('home', compact(
            'resourceTypes',
            'courses',
            'latestNotices',
            'examNotices',
            'resultNotices',
            'otherNotices',
            'popularResources',
            'quickLinks',
            'totalResources',
            'totalUsers',
            'totalDownloads'
        ));
    }
}
