<?php

namespace App\Http\Controllers;

use App\Models\OfficialNotice;
use App\Models\Program;
use App\Models\Resource;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function disclaimer(): View
    {
        return view('pages.disclaimer');
    }

    public function sitemap(): Response
    {
        $resources = Resource::approved()->latest()->take(500)->get();
        $courses = Program::where('is_active', true)->get();
        $notices = OfficialNotice::active()->latest()->take(100)->get();

        $content = view('pages.sitemap', compact('resources', 'courses', 'notices'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $content = "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /dashboard/\nDisallow: /upload/\nSitemap: " . url('/sitemap.xml');

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
