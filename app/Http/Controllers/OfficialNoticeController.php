<?php

namespace App\Http\Controllers;

use App\Models\OfficialNotice;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OfficialNoticeController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('category', 'all');

        $query = OfficialNotice::active();

        if ($category && $category !== 'all') {
            $query->where('category', ucfirst($category));
        }

        $notices = $query->recent()->paginate(12)->withQueryString();

        return view('notices.index', compact('notices', 'category'));
    }

    public function show(string $slug): View
    {
        $notice = OfficialNotice::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $recentNotices = OfficialNotice::active()
            ->where('id', '!=', $notice->id)
            ->recent()
            ->take(5)
            ->get();

        return view('notices.show', compact('notice', 'recentNotices'));
    }
}
