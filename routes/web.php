<?php

use App\Http\Controllers\AcademicApiController;
use App\Http\Controllers\Admin\AcademicController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NoticeController as AdminNoticeController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\ResourceModerationController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TeacherVerificationController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportantLinkController;
use App\Http\Controllers\OfficialNoticeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Resources
Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
Route::get('/resources/{program}/{semester}/{subject}/{slug}', [ResourceController::class, 'show'])->name('resources.show');
Route::get('/resource/{id}/download', [ResourceController::class, 'download'])->name('resources.download')->middleware('throttle:60,1');
Route::get('/resource/{id}/preview', [ResourceController::class, 'preview'])->name('resources.preview');
Route::post('/resource/{id}/report', [ResourceController::class, 'report'])->name('resources.report')->middleware('throttle:5,1');

// Academic Explorer
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');

// Official Notices
Route::get('/notices', [OfficialNoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{slug}', [OfficialNoticeController::class, 'show'])->name('notices.show');

// Important Links & Informational Pages
Route::get('/important-links', [ImportantLinkController::class, 'index'])->name('links.index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');
Route::get('/sitemap.xml', [PageController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [PageController::class, 'robots'])->name('robots');

// Academic Dynamic JSON API for Cascading Dropdowns
Route::prefix('api/academic')->group(function () {
    Route::get('/programs', [AcademicApiController::class, 'programs'])->name('api.programs');
    Route::get('/semesters', [AcademicApiController::class, 'semesters'])->name('api.semesters');
    Route::get('/subjects', [AcademicApiController::class, 'subjects'])->name('api.subjects');
});

/*
|--------------------------------------------------------------------------
| Student & Teacher Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated Student / Teacher Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/my-uploads', [DashboardController::class, 'myUploads'])->name('dashboard.my-uploads');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [DashboardController::class, 'updateProfile'])->name('dashboard.profile.update');

    Route::get('/upload', [UploadController::class, 'create'])->name('upload.create');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store')->middleware('throttle:10,1');
});

/*
|--------------------------------------------------------------------------
| Dedicated Admin Authentication
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit')->middleware('throttle:5,1');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Protected Admin Panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource Moderation
    Route::get('/resources', [ResourceModerationController::class, 'index'])->name('resources.index');
    Route::get('/resources/pending', [ResourceModerationController::class, 'pending'])->name('resources.pending');
    Route::get('/resources/{id}/review', [ResourceModerationController::class, 'review'])->name('resources.review');
    Route::post('/resources/{id}/approve', [ResourceModerationController::class, 'approve'])->name('resources.approve');
    Route::post('/resources/{id}/reject', [ResourceModerationController::class, 'reject'])->name('resources.reject');
    Route::delete('/resources/{id}', [ResourceModerationController::class, 'destroy'])->name('resources.destroy');

    // Academic Structure Management
    Route::get('/academic/departments', [AcademicController::class, 'departments'])->name('departments.index');
    Route::post('/academic/departments', [AcademicController::class, 'storeDepartment'])->name('departments.store');
    Route::delete('/academic/departments/{id}', [AcademicController::class, 'destroyDepartment'])->name('departments.destroy');

    Route::get('/academic/programs', [AcademicController::class, 'programs'])->name('programs.index');
    Route::post('/academic/programs', [AcademicController::class, 'storeProgram'])->name('programs.store');
    Route::delete('/academic/programs/{id}', [AcademicController::class, 'destroyProgram'])->name('programs.destroy');

    Route::get('/academic/semesters', [AcademicController::class, 'semesters'])->name('semesters.index');
    Route::post('/academic/semesters', [AcademicController::class, 'storeSemester'])->name('semesters.store');
    Route::delete('/academic/semesters/{id}', [AcademicController::class, 'destroySemester'])->name('semesters.destroy');

    Route::get('/academic/subjects', [AcademicController::class, 'subjects'])->name('subjects.index');
    Route::post('/academic/subjects', [AcademicController::class, 'storeSubject'])->name('subjects.store');
    Route::delete('/academic/subjects/{id}', [AcademicController::class, 'destroySubject'])->name('subjects.destroy');

    Route::get('/academic/resource-types', [AcademicController::class, 'resourceTypes'])->name('resource-types.index');
    Route::post('/academic/resource-types', [AcademicController::class, 'storeResourceType'])->name('resource-types.store');
    Route::delete('/academic/resource-types/{id}', [AcademicController::class, 'destroyResourceType'])->name('resource-types.destroy');

    // User Management & Teacher Verification
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/users/{id}/change-role', [AdminUserController::class, 'changeRole'])->name('users.change-role');

    Route::get('/teachers/verification', [TeacherVerificationController::class, 'index'])->name('teachers.verification');
    Route::post('/teachers/{id}/verify', [TeacherVerificationController::class, 'verify'])->name('teachers.verify');
    Route::post('/teachers/{id}/revoke', [TeacherVerificationController::class, 'revoke'])->name('teachers.revoke');

    // Official Notices Management & Sync
    Route::get('/notices', [AdminNoticeController::class, 'index'])->name('notices.index');
    Route::post('/notices/sync', [AdminNoticeController::class, 'syncNow'])->name('notices.sync');
    Route::post('/notices/{id}/toggle', [AdminNoticeController::class, 'toggle'])->name('notices.toggle');

    // Reports & Audit Logs
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/{id}/resolve', [AdminReportController::class, 'resolve'])->name('reports.resolve');

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
});
