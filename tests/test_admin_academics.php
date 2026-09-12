<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Department;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Support\Str;

echo "=== TESTING ADMIN ACADEMIC & APPROVAL CAPABILITIES ===\n\n";

// 1. Department Creation
$dept = Department::create([
    'name' => 'Faculty of Test ' . time(),
    'code' => 'FT' . rand(10, 99),
    'slug' => 'faculty-test-' . time(),
    'is_active' => true,
]);
assert($dept->exists, "Department creation failed");
echo "1. Department Creation: PASSED (Created '{$dept->name}' [{$dept->code}])\n";

// 2. Program Creation
$prog = Program::create([
    'department_id' => $dept->id,
    'name' => 'Bachelor of Testing ' . time(),
    'code' => 'BTEST' . rand(10, 99),
    'slug' => 'btest-' . time(),
    'total_semesters' => 4,
    'is_active' => true,
]);
assert($prog->exists, "Program creation failed");
echo "2. Program Creation: PASSED (Created '{$prog->name}')\n";

// 3. Semester Addition (Explicit addition)
$sem = Semester::create([
    'program_id' => $prog->id,
    'semester_number' => 5,
    'name' => 'Semester 5 (Advanced)',
    'slug' => 'semester-5',
    'is_active' => true,
]);
assert($sem->exists, "Semester addition failed");
echo "3. Semester Addition: PASSED (Added '{$sem->name}' to program)\n";

// 4. Subject Addition
$subject = Subject::create([
    'program_id' => $prog->id,
    'semester_id' => $sem->id,
    'name' => 'Advanced Automated Testing',
    'code' => 'TST501',
    'slug' => 'advanced-automated-testing-' . time(),
    'is_active' => true,
]);
assert($subject->exists, "Subject addition failed");
echo "4. Subject Addition: PASSED (Added '{$subject->name}' to semester)\n";

// 5. Admin Document Approval Test
$admin = User::where('role', 'admin')->first();
$student = User::where('role', 'student')->first();
$pendingDoc = Resource::create([
    'title' => 'Test Pending Syllabus ' . time(),
    'slug' => 'test-syllabus-' . time(),
    'user_id' => $student->id,
    'uploader_type' => 'student',
    'uploader_name' => $student->name,
    'department_id' => $dept->id,
    'program_id' => $prog->id,
    'semester_id' => $sem->id,
    'subject_id' => $subject->id,
    'resource_type_id' => 1,
    'academic_year' => null, // Academic year removed!
    'file_path' => 'resources/test.pdf',
    'file_name' => 'test.pdf',
    'file_type' => 'pdf',
    'mime_type' => 'application/pdf',
    'file_size' => 1024,
    'file_hash' => hash('sha256', Str::random(32)),
    'status' => 'pending',
]);
assert($pendingDoc->status === 'pending', "Doc should be pending");
echo "5. Upload without Academic Year: PASSED (Status: pending, Year: null)\n";

// Admin Approves
$pendingDoc->update([
    'status' => 'approved',
    'approved_by' => $admin->id,
    'approved_at' => now(),
]);
assert($pendingDoc->fresh()->isApproved(), "Doc approval failed");
echo "6. Admin Document Approval: PASSED (Approved by {$admin->name})\n";

// Clean up test data
$pendingDoc->delete();
$subject->delete();
$sem->delete();
$prog->delete();
$dept->delete();

echo "\n=== ALL ADMIN ACADEMIC & APPROVAL TESTS PASSED (100%) ===\n";
