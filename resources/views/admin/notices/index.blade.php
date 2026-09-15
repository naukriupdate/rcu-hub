@extends('layouts.admin')

@section('title', 'Official Notices & RCU WordPress Sync')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Official Notices & API Sync</h1>
            <p class="text-xs text-slate-500 mt-0.5">Automated synchronization with Ramchandra Chandravanshi University (RCU) WordPress REST API</p>
        </div>

        <!-- Sync Trigger Button -->
        <form action="{{ route('admin.notices.sync') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                <span>Sync From Official RCU Website</span>
            </button>
        </form>
    </div>

    <!-- API Status Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <i data-lucide="globe" class="w-6 h-6"></i>
            </div>
            <div>
                <h3 class="font-bold text-slate-900 text-sm">WordPress REST API Source</h3>
                <p class="text-xs font-mono text-slate-500 truncate max-w-md">{{ $apiUrl }}</p>
                <p class="text-[11px] text-slate-400 mt-0.5">
                    Last synchronized: <span class="font-semibold text-slate-700">{{ $lastSync ?: 'Not synced yet' }}</span>
                </p>
            </div>
        </div>
        <a href="{{ route('admin.settings.index') }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition-colors shrink-0">
            Configure Endpoint &rarr;
        </a>
    </div>

    <!-- Notices Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Title / Source</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Published Date</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($notices as $notice)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 min-w-[240px]">
                                <a href="{{ route('notices.show', $notice->slug) }}" target="_blank" class="font-bold text-slate-900 hover:text-blue-600 block truncate">
                                    {{ $notice->title }}
                                </a>
                                <p class="text-[11px] text-slate-400 mt-0.5 truncate">
                                    ID: {{ $notice->external_id }} • Source: {{ $notice->source }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-medium text-[11px]">
                                    {{ $notice->category }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-slate-600">
                                {{ $notice->published_at ? $notice->published_at->format('d M Y') : 'N/A' }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $notice->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $notice->is_active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-2">
                                <a href="{{ $notice->original_url }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline">
                                    Original Link
                                </a>
                                <form action="{{ route('admin.notices.toggle', $notice->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs font-semibold text-slate-600 hover:underline">
                                        {{ $notice->is_active ? 'Hide' : 'Show' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No notices synchronized yet. Click "Sync From Official RCU Website" above.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $notices->links() }}
    </div>

</div>
@endsection
