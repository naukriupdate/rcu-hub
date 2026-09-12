@extends('layouts.admin')

@section('title', 'Administrative Audit Trails')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Security & Audit Trails</h1>
        <p class="text-xs text-slate-500 mt-0.5">Immutable activity log of administrative decisions, logins, and moderation actions</p>
    </div>

    <!-- Logs Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Timestamp</th>
                        <th class="py-3 px-4">Action</th>
                        <th class="py-3 px-4">Actor</th>
                        <th class="py-3 px-4">Details</th>
                        <th class="py-3 px-4">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 whitespace-nowrap text-slate-500 font-mono text-[11px]">
                                {{ $log->created_at->format('d M Y, H:i:s') }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-semibold text-[10px] font-mono">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap font-medium text-slate-800">
                                {{ $log->user ? $log->user->name : 'System / Guest' }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-700 max-w-sm truncate">
                                {{ $log->description }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-slate-400 font-mono text-[11px]">
                                {{ $log->ip_address ?: '127.0.0.1' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">No audit logs recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $logs->links() }}
    </div>

</div>
@endsection
