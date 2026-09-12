@extends('layouts.app')

@section('title', 'Upload Academic Resource — RCU Student Resource Hub')
@section('meta_description', 'Share notes, previous year question papers, and study guides with fellow RCU students.')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-6">
    
    <!-- Top Header (Matching Screen 5) -->
    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-200">
        <a href="{{ url()->previous() ?: route('dashboard') }}" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 rounded-lg">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Upload Resource</h1>
            <p class="text-xs text-slate-500">Fast, simple academic resource sharing</p>
        </div>
    </div>

    <!-- UPLOAD FORM (Screen 5 from Mobile Reference Image) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 sm:p-7 shadow-2xs">
        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs sm:text-sm">
            @csrf

            <!-- 1. Resource Title * -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Title <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Java Notes, DBMS Unit 3 PYQs"
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900 text-xs sm:text-sm">
            </div>

            <!-- 2. Uploader Role & Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200/60">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">I am a <span class="text-rose-500">*</span></label>
                    <div class="flex items-center gap-4 mt-1.5">
                        <label class="flex items-center gap-1.5 cursor-pointer">
                            <input type="radio" name="uploader_type" value="student" {{ old('uploader_type', auth()->user()->role ?? 'student') === 'student' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700">Student</span>
                        </label>
                        <label class="flex items-center gap-1.5 cursor-pointer">
                            <input type="radio" name="uploader_type" value="teacher" {{ old('uploader_type', auth()->user()->role ?? '') === 'teacher' ? 'checked' : '' }} class="text-blue-600 focus:ring-blue-500">
                            <span class="text-xs font-medium text-slate-700">Teacher</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Your Display Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="uploader_name" value="{{ old('uploader_name', auth()->user()->name ?? '') }}" required placeholder="Full Name"
                        class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <!-- 3. Cascading Academic Dropdowns -->
            <!-- Department -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Department / Faculty <span class="text-rose-500">*</span>
                </label>
                <select id="departmentSelect" name="department_id" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-800 text-xs sm:text-sm">
                    <option value="">Select department...</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Course / Program -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Course <span class="text-rose-500">*</span>
                </label>
                <select id="programSelect" name="program_id" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-800 text-xs sm:text-sm">
                    <option value="">Select course...</option>
                    @foreach($programs as $prog)
                        <option value="{{ $prog->id }}" data-department="{{ $prog->department_id }}" {{ old('program_id') == $prog->id ? 'selected' : '' }}>
                            {{ $prog->name }} ({{ $prog->code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Semester & Subject (2 columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <!-- Semester -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        Semester <span class="text-rose-500">*</span>
                    </label>
                    <select id="semesterSelect" name="semester_id" required
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-800 text-xs sm:text-sm">
                        <option value="">Select semester...</option>
                    </select>
                </div>

                <!-- Subject -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1.5">
                        Subject <span class="text-rose-500">*</span>
                    </label>
                    <select id="subjectSelect" name="subject_id" required
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-800 text-xs sm:text-sm">
                        <option value="">Select subject...</option>
                    </select>
                </div>
            </div>

            <!-- Resource Type -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    Resource Type <span class="text-rose-500">*</span>
                </label>
                <select name="resource_type_id" required
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-800 text-xs sm:text-sm">
                    <option value="">Select type (e.g. Handwritten Notes, Previous Year Papers, Syllabus)...</option>
                    @foreach($resourceTypes as $type)
                        <option value="{{ $type->id }}" {{ old('resource_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">Description</label>
                <textarea name="description" rows="3" placeholder="Enter brief description or topics covered..."
                    class="w-full px-3.5 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-slate-900 text-xs sm:text-sm">{{ old('description') }}</textarea>
            </div>

            <!-- DRAG & DROP FILE ZONE (Exact visual from Screen 5) -->
            <div>
                <label class="block font-semibold text-slate-700 mb-1.5">
                    File <span class="text-rose-500">*</span>
                </label>
                <div id="dropZone" class="relative border-2 border-dashed border-blue-200 hover:border-blue-400 bg-blue-50/40 hover:bg-blue-50/70 rounded-2xl p-6 text-center cursor-pointer transition-colors">
                    <input type="file" id="fileInput" name="file" required 
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png" 
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    
                    <div class="space-y-2 pointer-events-none">
                        <div class="w-12 h-12 mx-auto rounded-2xl bg-white shadow-2xs border border-blue-100 flex items-center justify-center text-blue-600">
                            <i data-lucide="cloud-upload" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-xs sm:text-sm">
                                <span class="text-blue-600 hover:underline">Choose file</span> or drag and drop
                            </p>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                (PDF, DOCX, PPTX, XLSX, JPG, PNG)
                            </p>
                            <p class="text-[10px] text-slate-400 mt-0.5 font-medium">
                                Max size: 10 MB
                            </p>
                        </div>
                    </div>

                    <!-- Selected File Info Banner -->
                    <div id="fileInfo" class="hidden mt-3 p-2 bg-white rounded-xl border border-blue-200 text-xs text-blue-800 font-semibold flex items-center justify-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                        <span id="fileName"></span>
                    </div>
                </div>
            </div>

            <!-- Full-width Submit Button from Screen 5 -->
            <div class="pt-3">
                <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-xs shadow-blue-500/25 transition-all">
                    Submit
                </button>
                <p class="text-[11px] text-slate-400 text-center mt-2">
                    Submitted resources undergo quick admin moderation before public listing.
                </p>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const deptSelect = document.getElementById('departmentSelect');
    const progSelect = document.getElementById('programSelect');
    const semSelect = document.getElementById('semesterSelect');
    const subSelect = document.getElementById('subjectSelect');

    const fileInput = document.getElementById('fileInput');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');

    // Live file picker indicator
    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const sizeMb = (file.size / (1024 * 1024)).toFixed(2);
                fileName.textContent = `${file.name} (${sizeMb} MB)`;
                fileInfo.classList.remove('hidden');
            } else {
                fileInfo.classList.add('hidden');
            }
        });
    }

    // Dynamic Cascading Dropdowns
    deptSelect.addEventListener('change', async () => {
        const deptId = deptSelect.value;
        progSelect.innerHTML = '<option value="">Loading courses...</option>';
        semSelect.innerHTML = '<option value="">Select semester...</option>';
        subSelect.innerHTML = '<option value="">Select subject...</option>';

        if (!deptId) {
            progSelect.innerHTML = '<option value="">Select course...</option>';
            return;
        }

        try {
            const res = await fetch(`/api/academic/programs?department_id=${deptId}`);
            const programs = await res.json();
            progSelect.innerHTML = '<option value="">Select course...</option>';
            programs.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.id;
                opt.textContent = `${p.name} (${p.code})`;
                progSelect.appendChild(opt);
            });
        } catch (e) {
            progSelect.innerHTML = '<option value="">Error loading courses</option>';
        }
    });

    progSelect.addEventListener('change', async () => {
        const progId = progSelect.value;
        semSelect.innerHTML = '<option value="">Loading semesters...</option>';
        subSelect.innerHTML = '<option value="">Select subject...</option>';

        if (!progId) {
            semSelect.innerHTML = '<option value="">Select semester...</option>';
            return;
        }

        try {
            const res = await fetch(`/api/academic/semesters?program_id=${progId}`);
            const semesters = await res.json();
            semSelect.innerHTML = '<option value="">Select semester...</option>';
            semesters.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.id;
                opt.textContent = s.name;
                semSelect.appendChild(opt);
            });
        } catch (e) {
            semSelect.innerHTML = '<option value="">Error loading semesters</option>';
        }
    });

    semSelect.addEventListener('change', async () => {
        const progId = progSelect.value;
        const semId = semSelect.value;
        subSelect.innerHTML = '<option value="">Loading subjects...</option>';

        if (!progId || !semId) {
            subSelect.innerHTML = '<option value="">Select subject...</option>';
            return;
        }

        try {
            const res = await fetch(`/api/academic/subjects?program_id=${progId}&semester_id=${semId}`);
            const subjects = await res.json();
            subSelect.innerHTML = '<option value="">Select subject...</option>';
            subjects.forEach(s => {
                const opt = document.createElement('option');
                opt.value = s.id;
                opt.textContent = `${s.name}${s.code ? ' (' + s.code + ')' : ''}`;
                subSelect.appendChild(opt);
            });
        } catch (e) {
            subSelect.innerHTML = '<option value="">Error loading subjects</option>';
        }
    });

    // Auto-trigger if program was preselected on load
    if (progSelect.value) {
        progSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
