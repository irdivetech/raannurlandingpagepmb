<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PmbController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ParentPortal\HelpdeskController as ParentHelpdeskController;
use App\Http\Controllers\Admin\HelpdeskController as AdminHelpdeskController;


// PMB Public Routes
Route::get('/', [PmbController::class, 'landing'])->name('pmb.landing');
Route::get('/biaya', [PublicController::class, 'biaya'])->name('public.biaya');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');
Route::get('/pmb', [PmbController::class, 'landing'])->name('pmb.home');
Route::get('/pmb/register', [PmbController::class, 'registerStart'])->name('pmb.register');
Route::get('/pmb/register/steps', [PmbController::class, 'steps'])->name('pmb.steps');
Route::post('/pmb/register/submit', [PmbController::class, 'submit'])->name('pmb.submit');
Route::get('/pmb/success', [PmbController::class, 'success'])->name('pmb.success');
Route::post('/pmb/register/account', [PmbController::class, 'createParentAccount'])->name('pmb.create_account');
Route::get('/pmb/tracking', [PmbController::class, 'tracking'])->name('pmb.tracking');
Route::get('/pmb/formulir/download', [PmbController::class, 'downloadBlankFormulir'])->name('pmb.formulir.download');

// Article & Gallery Public Routes
Route::get('/artikel', [\App\Http\Controllers\PublicArticleController::class, 'index'])->name('public.articles.index');
Route::get('/artikel/{slug}', [\App\Http\Controllers\PublicArticleController::class, 'show'])->name('public.articles.show');
Route::get('/kategori/{slug}', [\App\Http\Controllers\PublicArticleController::class, 'category'])->name('public.articles.category');
Route::get('/galeri', [\App\Http\Controllers\PublicArticleController::class, 'gallery'])->name('public.gallery');

// Auth Routes
Route::get('/parent/login', [AuthController::class, 'showLogin'])->name('parent.login');
Route::post('/parent/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Parent Portal Routes
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/dashboard', [ParentController::class, 'dashboard'])->name('parent.dashboard');
    Route::get('/parent/dashboard/pdf', [ParentController::class, 'downloadDashboardPdf'])->name('parent.dashboard.pdf');
    
    Route::get('/parent/announcements', [ParentController::class, 'announcements'])->name('parent.announcements');
    
    Route::get('/parent/status', [ParentController::class, 'status'])->name('parent.status');
    Route::get('/parent/status/pdf', [ParentController::class, 'downloadBuktiPdf'])->name('parent.status.pdf');
    
    Route::get('/parent/documents', [ParentController::class, 'documents'])->name('parent.documents');
    Route::post('/parent/documents', [ParentController::class, 'uploadDocument'])->name('parent.documents.upload');
    Route::get('/parent/profile', [ParentController::class, 'profile'])->name('parent.profile');
    Route::put('/parent/profile', [ParentController::class, 'updateProfile'])->name('parent.profile.update');
    Route::get('/parent/student', [ParentController::class, 'editStudent'])->name('parent.student.edit');
    Route::put('/parent/student', [ParentController::class, 'updateStudent'])->name('parent.student.update');
    Route::get('/parent/formulir/pdf', [ParentController::class, 'downloadFormulirPdf'])->name('parent.formulir.pdf');

    // === Parent Helpdesk Routes ===
    Route::prefix('parent/helpdesk')->name('parent.helpdesk.')->group(function () {
        Route::get('/',                  [ParentHelpdeskController::class, 'index'])->name('index');
        Route::get('/create',            [ParentHelpdeskController::class, 'create'])->name('create');
        Route::post('/',                 [ParentHelpdeskController::class, 'store'])->name('store');
        Route::get('/{ticket}',          [ParentHelpdeskController::class, 'show'])->name('show');
        Route::get('/{ticket}/messages', [ParentHelpdeskController::class, 'messages'])->name('messages');
        Route::post('/{ticket}/reply',   [ParentHelpdeskController::class, 'storeResponse'])->name('reply');
        Route::post('/{ticket}/rate',    [ParentHelpdeskController::class, 'storeRating'])->name('rate');
    });
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/applicants', [AdminController::class, 'applicants'])->name('admin.applicants.index');
    Route::get('/admin/applicants/create', [AdminController::class, 'createApplicant'])->name('admin.applicants.create');
    Route::post('/admin/applicants/store', [AdminController::class, 'storeApplicant'])->name('admin.applicants.store');
    Route::get('/admin/applicants/export', [AdminController::class, 'exportApplicants'])->name('admin.applicants.export');
    Route::get('/admin/applicants/{id}', [AdminController::class, 'detail'])->name('admin.applicants.detail');
    Route::patch('/admin/documents/{id}/verify', [AdminController::class, 'verifyDocument'])->name('admin.documents.verify');
    Route::patch('/admin/applicants/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.applicants.status');

    Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class, ['as' => 'admin']);
    Route::resource('/admin/students', \App\Http\Controllers\AdminStudentController::class, ['as' => 'admin']);
    Route::resource('/admin/announcements', \App\Http\Controllers\AdminAnnouncementController::class, ['as' => 'admin']);
    
    // CMS Artikel Modules
    Route::resource('/admin/categories', \App\Http\Controllers\Admin\CategoryController::class, ['as' => 'admin']);
    Route::resource('/admin/articles', \App\Http\Controllers\Admin\ArticleController::class, ['as' => 'admin']);
    
    Route::get('/admin/reports', [\App\Http\Controllers\AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/reports/export', [\App\Http\Controllers\AdminReportController::class, 'export'])->name('admin.reports.export');

    Route::get('/admin/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [\App\Http\Controllers\SettingsController::class, 'update'])->name('admin.settings.update');

    // Profil Sekolah - Lokasi & Kontak
    Route::get('/admin/school-profile', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'edit'])->name('admin.school-profile.edit');
    Route::put('/admin/school-profile', [\App\Http\Controllers\Admin\SchoolProfileController::class, 'update'])->name('admin.school-profile.update');

    // === Admin Helpdesk Routes ===
    Route::prefix('admin/helpdesk')->name('admin.helpdesk.')->group(function () {
        Route::get('/dashboard',         [AdminHelpdeskController::class, 'dashboard'])->name('dashboard');
        Route::get('/',                  [AdminHelpdeskController::class, 'index'])->name('index');
        Route::get('/{ticket}',          [AdminHelpdeskController::class, 'show'])->name('show');
        Route::get('/{ticket}/messages', [AdminHelpdeskController::class, 'messages'])->name('messages');
        Route::patch('/{ticket}',        [AdminHelpdeskController::class, 'update'])->name('update');
        Route::post('/{ticket}/reply',   [AdminHelpdeskController::class, 'storeResponse'])->name('reply');
        Route::post('/{ticket}/resolve', [AdminHelpdeskController::class, 'resolve'])->name('resolve');
    });
});
