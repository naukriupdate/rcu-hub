<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'RCU Student Resource Hub'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Learn • Share • Grow'),
            'contact_email' => SiteSetting::get('contact_email', 'contact@rcustudenthub.in'),
            'rcu_api_url' => SiteSetting::get('rcu_api_url', 'https://www.rcu.edu.in/wp-json/wp/v2/posts'),
            'max_upload_size' => SiteSetting::get('max_upload_size', '10'),
            'allowed_extensions' => SiteSetting::get('allowed_extensions', 'pdf,docx,pptx,xlsx,jpg,png'),
            'disclaimer_text' => SiteSetting::get('disclaimer_text', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'rcu_api_url' => ['required', 'url', 'max:500'],
            'max_upload_size' => ['required', 'integer', 'min:1', 'max:50'],
            'allowed_extensions' => ['required', 'string'],
            'disclaimer_text' => ['nullable', 'string'],
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, (string) $value, 'general');
        }

        AuditService::log('settings_updated', 'Updated global site settings');

        return back()->with('success', 'Site settings updated successfully.');
    }
}
