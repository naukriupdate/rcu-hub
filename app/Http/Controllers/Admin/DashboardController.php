<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialNotice;
use App\Models\Report;
use App\Models\Resource;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // 4 KPI Cards matching screenshot:
        // Total Resources: 1,284
        // Pending Uploads: 17
        // Total Downloads: 45,892
        // Total Users: 2,341
        $totalResources = Resource::count();
        $pendingUploads = Resource::pending()->count();
        $totalDownloads = Resource::sum('downloads_count');
        $totalUsers = User::count();

        // Extra stats
        $verifiedTeachers = User::whereNotNull('teacher_verified_at')->count();
        $pendingReports = Report::where('status', 'pending')->count();

        // Recent Uploads
        $recentUploads = Resource::with(['program', 'semester', 'subject', 'user', 'resourceType'])
            ->latest()
            ->take(8)
            ->get();

        // Recent Registered Users
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalResources',
            'pendingUploads',
            'totalDownloads',
            'totalUsers',
            'verifiedTeachers',
            'pendingReports',
            'recentUploads',
            'recentUsers'
        ));
    }
}
