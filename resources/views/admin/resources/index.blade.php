@extends('layouts.admin')

@section('title', 'All Resources')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Resource Management</h1>
            <p class="text-xs text-slate-500 mt-0.5">Full directory of academic materials, statuses, and download metrics</p>
        </div>

        <a href="{{ route('admin.resources.pending') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-xl shadow-xs transition-all">
            <i data-lucide="inbox" class="w-4 h-4"></i>
            <span>Pending Queue ({{ $pendingCount }})</span>
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs">
        <form action="{{ route('admin.resources.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title, subject, uploader..."
                    class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Status: All</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div>
                <select name="program_id" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Course: All</option>
                    @foreach($programs as $p)
                        <option value="{{ $p->id }}" {{ request('program_id') == $p->id ? 'selected' : '' }}>{{ $p->code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'program_id']))
                    <a href="{{ route('admin.resources.index') }}" class="px-3 py-2 text-slate-500 hover:text-slate-800">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Title / Program</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Uploader</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Downloads</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($resources as $res)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4 min-w-[200px]">
                                <a href="{{ route('admin.resources.review', $res->id) }}" class="font-bold text-slate-900 hover:text-blue-600 block truncate">
                                    {{ $res->title }}
                                </a>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ $res->program->code }} • Sem {{ $res->semester->semester_number }} • {{ $res->subject->name }}
                                </p>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-medium">
                                    {{ $res->resourceType->name }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="font-medium text-slate-800">{{ $res->uploader_name }}</span>
                                <span class="block text-[10px] text-slate-400">
                                    {{ ucfirst($res->uploader_type) }}
                                    @if($res->isVerifiedTeacherUpload())
                                        • <span class="text-emerald-600 font-bold">Verified</span>
                                    @endif
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold
                                    {{ $res->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($res->status === 'pending' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap text-slate-600 font-medium">
                                {{ number_format($res->downloads_count) }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-1">
                                @if($res->status !== 'approved')
                                    <form action="{{ route('admin.resources.approve', $res->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg inline-block" title="Approve Resource">
                                            <i data-lucide="check" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.resources.review', $res->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg inline-block" title="Review">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.resources.destroy', $res->id) }}" method="POST" class="inline" onsubmit="return confirm('Permanently delete this resource and its file?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-600 hover:bg-rose-50 rounded-lg inline-block" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">No resources matched your criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $resources->links() }}
    </div>

</div>
@endsection
