<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\ImportantLink;
use App\Models\OfficialNotice;
use App\Models\Program;
use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\Semester;
use App\Models\SiteSetting;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@rcu.edu'],
            [
                'name' => 'RCU Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $verifiedTeacher = User::firstOrCreate(
            ['email' => 'teacher@rcu.edu'],
            [
                'name' => 'Dr. A. K. Sharma',
                'password' => Hash::make('teacher123'),
                'role' => 'teacher',
                'teacher_verified_at' => now(),
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $unverifiedTeacher = User::firstOrCreate(
            ['email' => 'newteacher@rcu.edu'],
            [
                'name' => 'Prof. S. R. Patil',
                'password' => Hash::make('teacher123'),
                'role' => 'teacher',
                'teacher_verified_at' => null, // Crucial: unverified teacher
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $student = User::firstOrCreate(
            ['email' => 'priyanshu@example.com'],
            [
                'name' => 'Priyanshu Kumar',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // 2. Departments
        $csDept = Department::create([
            'name' => 'Faculty of Computer Science & IT',
            'slug' => 'computer-science-it',
            'code' => 'CSIT',
            'description' => 'Department of Computer Science, Information Technology, and Applications.',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $mgmtDept = Department::create([
            'name' => 'Faculty of Commerce & Management',
            'slug' => 'commerce-management',
            'code' => 'COMM',
            'description' => 'Department of Business Administration and Commerce.',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $artsDept = Department::create([
            'name' => 'Faculty of Arts & Humanities',
            'slug' => 'arts-humanities',
            'code' => 'ARTS',
            'description' => 'Department of Literature, Social Sciences, and Languages.',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $sciDept = Department::create([
            'name' => 'Faculty of Science',
            'slug' => 'science',
            'code' => 'SCI',
            'description' => 'Department of Natural and Physical Sciences.',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // 3. Programs (Courses)
        $bca = Program::create([
            'department_id' => $csDept->id,
            'name' => 'Bachelor of Computer Applications',
            'code' => 'BCA',
            'slug' => 'bca',
            'duration_years' => 3,
            'total_semesters' => 6,
            'badge_color' => 'blue',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $bba = Program::create([
            'department_id' => $mgmtDept->id,
            'name' => 'Bachelor of Business Administration',
            'code' => 'BBA',
            'slug' => 'bba',
            'duration_years' => 3,
            'total_semesters' => 6,
            'badge_color' => 'green',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $ba = Program::create([
            'department_id' => $artsDept->id,
            'name' => 'Bachelor of Arts',
            'code' => 'BA',
            'slug' => 'ba',
            'duration_years' => 3,
            'total_semesters' => 6,
            'badge_color' => 'orange',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $bsc = Program::create([
            'department_id' => $sciDept->id,
            'name' => 'Bachelor of Science',
            'code' => 'B.Sc',
            'slug' => 'bsc',
            'duration_years' => 3,
            'total_semesters' => 6,
            'badge_color' => 'purple',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        // 4. Semesters for BCA
        $bcaSemesters = [];
        for ($i = 1; $i <= 6; $i++) {
            $bcaSemesters[$i] = Semester::create([
                'program_id' => $bca->id,
                'semester_number' => $i,
                'name' => "Semester {$i}",
                'slug' => "semester-{$i}",
                'is_active' => true,
            ]);
        }

        // Semesters for BBA, BA, B.Sc
        $bbaSem5 = Semester::create([
            'program_id' => $bba->id,
            'semester_number' => 5,
            'name' => 'Semester 5',
            'slug' => 'semester-5',
            'is_active' => true,
        ]);

        $bscSem1 = Semester::create([
            'program_id' => $bsc->id,
            'semester_number' => 1,
            'name' => 'Semester 1',
            'slug' => 'semester-1',
            'is_active' => true,
        ]);

        // 5. Subjects
        $javaSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'name' => 'Java Programming',
            'code' => 'BCA301',
            'slug' => 'java',
            'description' => 'Object-oriented programming using Core and Advanced Java.',
            'is_active' => true,
        ]);

        $dbmsSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'name' => 'Database Management Systems',
            'code' => 'BCA302',
            'slug' => 'dbms',
            'description' => 'Relational database concepts, SQL queries, and normalization.',
            'is_active' => true,
        ]);

        $cSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[1]->id,
            'name' => 'C Programming',
            'code' => 'BCA101',
            'slug' => 'c-programming',
            'description' => 'Procedural programming, pointers, and data structures in C.',
            'is_active' => true,
        ]);

        $mathSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[1]->id,
            'name' => 'Mathematics',
            'code' => 'BCA102',
            'slug' => 'mathematics',
            'description' => 'Discrete mathematics and mathematical foundations of CS.',
            'is_active' => true,
        ]);

        $webSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[5]->id,
            'name' => 'Web Technology',
            'code' => 'BCA501',
            'slug' => 'web-technology',
            'description' => 'Full-stack web development with HTML, CSS, JavaScript, and PHP.',
            'is_active' => true,
        ]);

        $pythonSubject = Subject::create([
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'name' => 'Python Programming',
            'code' => 'BCA303',
            'slug' => 'python',
            'description' => 'Python syntax, scripting, and data manipulation.',
            'is_active' => true,
        ]);

        $bizLawSubject = Subject::create([
            'program_id' => $bba->id,
            'semester_id' => $bbaSem5->id,
            'name' => 'Business Law',
            'code' => 'BBA501',
            'slug' => 'business-law',
            'description' => 'Corporate and mercantile law in India.',
            'is_active' => true,
        ]);

        $physicsSubject = Subject::create([
            'program_id' => $bsc->id,
            'semester_id' => $bscSem1->id,
            'name' => 'Physics',
            'code' => 'BSC101',
            'slug' => 'physics',
            'description' => 'Classical mechanics and wave theory.',
            'is_active' => true,
        ]);

        // 6. Resource Types
        $notesType = ResourceType::create([
            'name' => 'Notes',
            'slug' => 'notes',
            'subtitle' => 'Study materials & notes',
            'icon' => 'file-text',
            'color_theme' => 'blue',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $pyqType = ResourceType::create([
            'name' => 'Previous Year Papers',
            'slug' => 'pyq',
            'subtitle' => 'PYQs & model papers',
            'icon' => 'file-check',
            'color_theme' => 'green',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        $syllabusType = ResourceType::create([
            'name' => 'Syllabus',
            'slug' => 'syllabus',
            'subtitle' => 'Course-wise syllabus',
            'icon' => 'book-open',
            'color_theme' => 'purple',
            'is_active' => true,
            'sort_order' => 3,
        ]);

        $assignmentType = ResourceType::create([
            'name' => 'Assignments',
            'slug' => 'assignments',
            'subtitle' => 'Assignments & projects',
            'icon' => 'clipboard-list',
            'color_theme' => 'orange',
            'is_active' => true,
            'sort_order' => 4,
        ]);

        $qbType = ResourceType::create([
            'name' => 'Question Banks',
            'slug' => 'question-banks',
            'subtitle' => 'Subject-wise questions',
            'icon' => 'help-circle',
            'color_theme' => 'teal',
            'is_active' => true,
            'sort_order' => 5,
        ]);

        // Create a dummy sample PDF in storage so preview and download work right away!
        Storage::disk('local')->makeDirectory('resources/demo');
        $dummyPdfContent = "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj\n3 0 obj<</Type/Page/MediaBox[0 0 612 792]/Parent 2 0 R/Resources<<>>>>endobj\nxref\n0 4\n0000000000 65535 f\n0000000009 00000 n\n0000000052 00000 n\n0000000101 00000 n\ntrailer<</Size 4/Root 1 0 R>>\nstartxref\n178\n%%EOF";
        Storage::disk('local')->put('resources/demo/sample.pdf', $dummyPdfContent);

        // 7. Approved Resources (Matching screenshots)
        Resource::create([
            'title' => 'Java Notes',
            'slug' => 'bca-java-notes',
            'description' => 'Complete Java notes covering the important topics like OOPs, inheritance, polymorphism, exception handling, collections, and more. Useful for semester exams and quick revision.',
            'user_id' => $verifiedTeacher->id,
            'uploader_type' => 'teacher',
            'uploader_name' => $verifiedTeacher->name,
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'subject_id' => $javaSubject->id,
            'resource_type_id' => $notesType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'BCA_Sem3_Java_Complete_Notes.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 5033164, // 4.8 MB
            'file_hash' => hash('sha256', $dummyPdfContent),
            'status' => 'approved',
            'downloads_count' => 2410,
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(2),
            'created_at' => now()->subDays(2),
        ]);

        Resource::create([
            'title' => 'DBMS Previous Year Questions',
            'slug' => 'bca-dbms-pyq',
            'description' => 'Last 5 years solved previous year question papers for Database Management Systems.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => $student->name,
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'subject_id' => $dbmsSubject->id,
            'resource_type_id' => $pyqType->id,
            'academic_year' => '2024-25',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'BCA_DBMS_PYQ_2020_2024.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 2202009, // 2.1 MB
            'file_hash' => hash('sha256', 'dummy-dbms-pyq'),
            'status' => 'approved',
            'downloads_count' => 1840,
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(3),
            'created_at' => now()->subDays(3),
        ]);

        Resource::create([
            'title' => 'C Programming Notes',
            'slug' => 'bca-c-programming-notes',
            'description' => 'Comprehensive hand-written and typed notes for C programming and algorithms.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => $student->name,
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[1]->id,
            'subject_id' => $cSubject->id,
            'resource_type_id' => $notesType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'C_Programming_Notes_Unit1_5.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 3565158, // 3.4 MB
            'file_hash' => hash('sha256', 'dummy-c-notes'),
            'status' => 'approved',
            'downloads_count' => 1520,
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(5),
            'created_at' => now()->subDays(5),
        ]);

        Resource::create([
            'title' => 'Mathematics Syllabus',
            'slug' => 'bca-maths-syllabus',
            'description' => 'Official detailed course syllabus with recommended textbooks and references.',
            'user_id' => $admin->id,
            'uploader_type' => 'teacher',
            'uploader_name' => 'Academic Cell',
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[1]->id,
            'subject_id' => $mathSubject->id,
            'resource_type_id' => $syllabusType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'BCA_Mathematics_Syllabus.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 1258291, // 1.2 MB
            'file_hash' => hash('sha256', 'dummy-math-syllabus'),
            'status' => 'approved',
            'downloads_count' => 1200,
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(7),
            'created_at' => now()->subDays(7),
        ]);

        Resource::create([
            'title' => 'Web Technology Notes',
            'slug' => 'bca-web-tech-notes',
            'description' => 'Notes covering HTML5, CSS3, JS, responsive design, and modern web frameworks.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => $student->name,
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[5]->id,
            'subject_id' => $webSubject->id,
            'resource_type_id' => $notesType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'Web_Technology_BCA5.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 5872025, // 5.6 MB
            'file_hash' => hash('sha256', 'dummy-web-tech'),
            'status' => 'approved',
            'downloads_count' => 980,
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(10),
            'created_at' => now()->subDays(10),
        ]);

        // Pending Resources for Admin Moderation
        Resource::create([
            'title' => 'Python Notes',
            'slug' => 'bca-python-notes',
            'description' => 'Core Python programming basics, functions, and file handling.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => $student->name,
            'department_id' => $csDept->id,
            'program_id' => $bca->id,
            'semester_id' => $bcaSemesters[3]->id,
            'subject_id' => $pythonSubject->id,
            'resource_type_id' => $notesType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'Python_Notes_Sem3.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 2800000,
            'file_hash' => hash('sha256', 'dummy-python-notes'),
            'status' => 'pending',
            'created_at' => now()->subHours(2),
        ]);

        Resource::create([
            'title' => 'Business Law PYQ',
            'slug' => 'bba-business-law-pyq',
            'description' => 'Previous year examination questions for Business Law.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => 'Rahul Sharma',
            'department_id' => $mgmtDept->id,
            'program_id' => $bba->id,
            'semester_id' => $bbaSem5->id,
            'subject_id' => $bizLawSubject->id,
            'resource_type_id' => $pyqType->id,
            'academic_year' => '2024-25',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'BBA_Business_Law_PYQ.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 1900000,
            'file_hash' => hash('sha256', 'dummy-bizlaw-pyq'),
            'status' => 'pending',
            'created_at' => now()->subHours(5),
        ]);

        Resource::create([
            'title' => 'Physics Notes',
            'slug' => 'bsc-physics-notes',
            'description' => 'First semester classical mechanics notes.',
            'user_id' => $student->id,
            'uploader_type' => 'student',
            'uploader_name' => 'Ananya Roy',
            'department_id' => $sciDept->id,
            'program_id' => $bsc->id,
            'semester_id' => $bscSem1->id,
            'subject_id' => $physicsSubject->id,
            'resource_type_id' => $notesType->id,
            'academic_year' => '2025-26',
            'file_path' => 'resources/demo/sample.pdf',
            'file_name' => 'Physics_Mechanics_Notes.pdf',
            'file_type' => 'pdf',
            'mime_type' => 'application/pdf',
            'file_size' => 4100000,
            'file_hash' => hash('sha256', 'dummy-physics-notes'),
            'status' => 'pending',
            'created_at' => now()->subHours(7),
        ]);

        // 8. Official Notices (Synchronized live from official university API)
        try {
            app(\App\Services\RcuNoticeSyncService::class)->sync();
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Notice sync during database seeding: ' . $e->getMessage());
        }

        // 9. Important Links
        $links = [
            ['title' => 'RCU Official Website', 'url' => 'https://www.rcu.edu.in/', 'description' => 'Main official university portal', 'category' => 'Quick Links', 'icon' => 'globe'],
            ['title' => 'Examination Portal', 'url' => 'https://www.rcu.edu.in/exam', 'description' => 'Results, admit cards and timetables', 'category' => 'Quick Links', 'icon' => 'file-text'],
            ['title' => 'Student Login', 'url' => 'https://www.rcu.edu.in/student-login', 'description' => 'Student registration and fee portal', 'category' => 'Quick Links', 'icon' => 'user'],
            ['title' => 'Academic Calendar', 'url' => 'https://www.rcu.edu.in/calendar', 'description' => 'Semester start and vacation schedule', 'category' => 'Quick Links', 'icon' => 'calendar'],
            ['title' => 'Contact RCU', 'url' => 'https://www.rcu.edu.in/contact', 'description' => 'University administration and helpline', 'category' => 'Quick Links', 'icon' => 'phone'],
        ];

        foreach ($links as $index => $link) {
            ImportantLink::create(array_merge($link, ['sort_order' => $index + 1, 'is_active' => true]));
        }

        // 10. Site Settings
        SiteSetting::set('site_name', 'RCU Student Resource Hub');
        SiteSetting::set('site_tagline', 'Learn • Share • Grow');
        SiteSetting::set('contact_email', 'contact@rcustudenthub.in');
        SiteSetting::set('rcu_api_url', 'https://www.rcu.edu.in/wp-json/wp/v2/posts');
        SiteSetting::set('max_upload_size', '10');
        SiteSetting::set('allowed_extensions', 'pdf,docx,pptx,xlsx,jpg,png');
        SiteSetting::set('disclaimer_text', 'RCU Student Resource Hub is an independent, community-driven platform for students and teachers of RCU. It is not affiliated with or endorsed by Rani Channamma University.');
    }
}
