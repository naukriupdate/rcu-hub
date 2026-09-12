@extends('layouts.admin')

@section('title', 'Community Reports')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Community Resource Reports</h1>
        <p class="text-xs text-slate-500 mt-0.5">Triage user-submitted copyright concerns, incorrect syllabi, or corrupted files</p>
    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Reported Resource</th>
                        <th class="py-3 px-4">Reason</th>
                        <th class="py-3 px-4">Reporter</th>
                        <th class="py-3 px-4">Details</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $report)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 min-w-[200px]">
                                @if($report->resource)
                                    <a href="{{ route('admin.resources.review', $report->resource->id) }}" class="font-bold text-slate-900 hover:text-blue-600 truncate block">
                                        {{ $report->resource->title }}
                                    </a>
                                    <span class="text-[10px] text-slate-400">
                                        {{ $report->resource->program->code }} • Sem {{ $report->resource->semester_id }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic">Deleted Resource</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 uppercase">
                                    {{ str_replace('_', ' ', $report->reason) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="font-medium text-slate-800 block">{{ $report->reporter_name }}</span>
                                <span class="text-[11px] text-slate-400">{{ $report->reporter_email }}</span>
                            </td>
                            <td class="py-3.5 px-4 max-w-xs truncate text-slate-600">
                                {{ $report->details }}
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                    {{ $report->status === 'actioned' ? 'bg-rose-50 text-rose-700' : ($report->status === 'dismissed' ? 'bg-slate-100 text-slate-600' : 'bg-amber-50 text-amber-700') }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST" class="inline-flex items-center gap-1.5">
                                    @csrf
                                    <select name="status" class="px-2 py-1 bg-slate-50 border border-slate-200 rounded-lg text-[11px]">
                                        <option value="reviewed" {{ $report->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="actioned" {{ $report->status === 'actioned' ? 'selected' : '' }}>Actioned (Unpublish)</option>
                                        <option value="dismissed" {{ $report->status === 'dismissed' ? 'selected' : '' }}>Dismissed</option>
                                    </select>
                                    <button type="submit" class="px-2.5 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-[11px] font-semibold">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">No community reports filed.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $reports->links() }}
    </div>

</div>
@endsection
