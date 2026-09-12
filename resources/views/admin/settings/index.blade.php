@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Platform Configuration & Settings</h1>
        <p class="text-xs text-slate-500 mt-0.5">Control global application behavior, upload limits, and WordPress sync settings</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-2xs">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5 text-xs sm:text-sm">
            @csrf

            <!-- Branding -->
            <div class="space-y-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider pb-2 border-b border-slate-100">
                    Platform Branding
                </h3>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Site Title</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] }}" required
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Tagline</label>
                    <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] }}" required
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Contact / Support Email</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] }}" required
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Upload Security & Limits -->
            <div class="space-y-4 pt-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider pb-2 border-b border-slate-100">
                    Upload Policies & Limits
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Max Upload File Size (MB)</label>
                        <input type="number" name="max_upload_size" value="{{ $settings['max_upload_size'] }}" min="1" max="50" required
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Allowed Document Formats</label>
                        <input type="text" name="allowed_extensions" value="{{ $settings['allowed_extensions'] }}" required
                            class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-[10px] text-slate-400 mt-1">Comma-separated (e.g. pdf,docx,pptx,xlsx,jpg,png)</p>
                    </div>
                </div>
            </div>

            <!-- RCU WordPress REST API Configuration -->
            <div class="space-y-4 pt-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider pb-2 border-b border-slate-100">
                    RCU Official Portal Integration
                </h3>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Official WordPress REST API Posts Endpoint</label>
                    <input type="url" name="rcu_api_url" value="{{ $settings['rcu_api_url'] }}" required
                        class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl font-mono text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-[11px] text-slate-400 mt-1">
                        Endpoint used by background synchronization tasks. Example: <code class="font-mono text-slate-600">https://www.rcu.edu.in/wp-json/wp/v2/posts</code>
                    </p>
                </div>
            </div>

            <!-- Disclaimer Text -->
            <div class="space-y-4 pt-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider pb-2 border-b border-slate-100">
                    Legal Disclaimer Text
                </h3>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Footer & Notice Disclaimer</label>
                    <textarea name="disclaimer_text" rows="3" class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs">{{ $settings['disclaimer_text'] }}</textarea>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs transition-all">
                    Save Configuration Changes
                </button>
            </div>

        </form>
    </div>

</div>
@endsection
