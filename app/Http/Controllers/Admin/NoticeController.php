<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficialNotice;
use App\Models\SiteSetting;
use App\Services\AuditService;
use App\Services\RcuNoticeSyncService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeController extends Controller
{
    public function index(): View
    {
        $notices = OfficialNotice::latest('published_at')->paginate(15);
        $lastSync = SiteSetting::get('last_notice_sync_time');
        $apiUrl = SiteSetting::get('rcu_api_url', 'https://www.rcu.edu.in/wp-json/wp/v2/posts');

        return view('admin.notices.index', compact('notices', 'lastSync', 'apiUrl'));
    }

    public function syncNow(RcuNoticeSyncService $syncService): RedirectResponse
    {
        $result = $syncService->sync();

        if ($result['success']) {
            AuditService::log('notices_synced', "Synchronized {$result['synced']} notices from RCU WordPress portal");
            return back()->with('success', $result['message']);
        }

        AuditService::log('notices_sync_failed', "Notice sync failed: {$result['message']}");
        return back()->with('error', $result['message']);
    }

    public function toggle(int $id): RedirectResponse
    {
        $notice = OfficialNotice::findOrFail($id);
        $notice->is_active = !$notice->is_active;
        $notice->save();

        return back()->with('success', "Notice visibility updated.");
    }
}
