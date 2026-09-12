@extends('layouts.admin')

@section('title', 'Teacher Verification Queue')

@section('content')
<div class="space-y-6">
    
    <div class="pb-4 border-b border-slate-200">
        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Teacher Verification Queue</h1>
        <p class="text-xs text-slate-500 mt-0.5">
            Manually verify academic faculty accounts. Verified educators display the official <strong>🏅 Verified Teacher</strong> badge on all public study resources.
        </p>
    </div>

    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs text-amber-900 flex items-start gap-3">
        <i data-lucide="shield-alert" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
        <div>
            <p class="font-bold">Security & Trust Policy</p>
            <p class="text-amber-800 mt-0.5">
                Selecting "Teacher" during user registration or file upload does <strong>never</strong> grant a user the verified badge automatically. Verification must be explicitly approved by an administrator here.
            </p>
        </div>
    </div>

    <!-- Teachers Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">Faculty Member</th>
                        <th class="py-3 px-4">Registered Email</th>
                        <th class="py-3 px-4">Approved Uploads</th>
                        <th class="py-3 px-4">Verification Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-4 px-4">
                                <span class="font-bold text-slate-900 text-sm block">{{ $teacher->name }}</span>
                                <span class="text-[11px] text-slate-400">Registered {{ $teacher->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="py-4 px-4 text-slate-600 font-mono">
                                {{ $teacher->email }}
                            </td>
                            <td class="py-4 px-4 text-slate-700 font-semibold">
                                {{ $teacher->resources_count }} approved resources
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($teacher->isVerifiedTeacher())
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-xs">
                                        🏅 Verified Teacher
                                    </span>
                                    <span class="block text-[10px] text-slate-400 mt-0.5">
                                        Since {{ $teacher->teacher_verified_at->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 font-semibold text-xs">
                                        Pending Verification
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right whitespace-nowrap">
                                @if(!$teacher->isVerifiedTeacher())
                                    <form action="{{ route('admin.teachers.verify', $teacher->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-xs transition-all">
                                            Grant Verified Badge
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.teachers.revoke', $teacher->id) }}" method="POST" class="inline" onsubmit="return confirm('Revoke verified teacher badge from this user?');">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 font-semibold rounded-xl transition-colors">
                                            Revoke Verification
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">No teacher accounts registered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $teachers->links() }}
    </div>

</div>
@endsection
