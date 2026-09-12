@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Registered Users</h1>
            <p class="text-xs text-slate-500 mt-0.5">Control student and teacher access, roles, and suspension states</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-2xs">
        <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..."
                    class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <select name="role" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Role: All</option>
                    <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ request('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div>
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl">
                    <option value="">Status: All</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'role', 'status']))
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-2 text-slate-500 hover:text-slate-800">Clear</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-4">User</th>
                        <th class="py-3 px-4">Role</th>
                        <th class="py-3 px-4">Verification</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Uploads</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-slate-900 block">{{ $user->name }}</span>
                                <span class="text-[11px] text-slate-400">{{ $user->email }}</span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $user->isAdmin() ? 'bg-amber-100 text-amber-800' : ($user->isTeacher() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($user->isVerifiedTeacher())
                                    <span class="text-emerald-700 font-bold text-xs flex items-center gap-1">
                                        🏅 Verified
                                    </span>
                                @elseif($user->isTeacher())
                                    <span class="text-amber-600 text-xs">Unverified</span>
                                @else
                                    <span class="text-slate-400 text-xs">—</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $user->isActive() ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 whitespace-nowrap font-medium text-slate-600">
                                {{ $user->resources_count }}
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-2">
                                @if(!$user->isAdmin())
                                    <!-- Toggle block/active -->
                                    <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs font-semibold {{ $user->isActive() ? 'text-rose-600 hover:underline' : 'text-emerald-600 hover:underline' }}">
                                            {{ $user->isActive() ? 'Block User' : 'Unblock' }}
                                        </button>
                                    </form>
                                @else
                                    <span class="text-slate-400 text-[10px]">Protected Admin</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection
