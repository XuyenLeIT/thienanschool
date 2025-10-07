<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccountController,
    ActivityController,
    AdminController,
    AdmissionController,
    AttendanceController,
    CarauselController,
    ContactController,
    CurriculumController,
    DailyScheduleController,
    EducationContentController,
    FeedbackController,
    GalleryController,
    HomeController,
    LoveMessageController,
    MenuController,
    ParentController,
    ParentNoticeController,
    ProgramController,
    PromotionController,
    RegistrationController,
    SpecialFeatureController,
    StudentController,
    TuitionController
};

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/chuong-trinh-hoc', [CurriculumController::class, 'index'])->name('curriculum');
Route::get('/phu-huynh', [ParentController::class, 'index'])->name('parent');
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::get('/tuyen-sinh', [AdmissionController::class, 'index'])->name('admission');
Route::get('/hoat-dong/{slug}', [ActivityController::class, 'detail'])->name('activities.detail');

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'checkLogin'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/api/feedbacks', [FeedbackController::class, 'apiFeedbacks']);
Route::post('/register', [RegistrationController::class, 'store'])->name('registration.store');

// Quên mật khẩu
Route::get('/forgot-password', [AdminController::class, 'showForgotForm'])->name('password.forgot-form');
Route::post('/forgot-password', [AdminController::class, 'sendOtp'])->name('password.send-otp');
Route::get('/verify-reset', [AdminController::class, 'showVerifyAndResetForm'])->name('password.verify-reset-form');
Route::post('/verify-reset', [AdminController::class, 'verifyAndReset'])->name('password.verify-reset');

/*
|--------------------------------------------------------------------------
| Role-based Routes
|--------------------------------------------------------------------------
*/
$roles = ['admin', 'manager', 'teacher'];

foreach ($roles as $role) {
    Route::prefix($role)
        ->name($role . '.')
        ->middleware("customAuth:$role")
        ->group(function () use ($role) {

            /* === ROUTE CHUNG cho tất cả admin / manager / teacher === */
            Route::get('/', [AdminController::class, 'index'])->name('dashboard');

            // Profile
            Route::get('/accounts/profile/{id}', [AdminController::class, 'profile'])->name('accounts.profile');
            Route::post('/accounts/change-password', [AdminController::class, 'changePassword'])->name('accounts.change-password');
            Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('accounts.update-profile');

            // Attendance
            Route::get('/attendances/{classname}/{date?}', [AttendanceController::class, 'form'])->name('attendances.form');
            Route::post('/attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
            Route::get('/student/{studentId}/stats', [AdminController::class, 'stats'])->name('attendances.stats');

            /* === PHÂN QUYỀN RIÊNG TỪNG ROLE === */

            // 🔹 ADMIN
            if ($role === 'admin') {
                // Quản lý account + daily_schedules + ban
                Route::post('/accounts/ban/{id}', [AccountController::class, 'ban'])->name('accounts.ban');
                Route::resources([
                    'accounts' => AccountController::class,
                    'daily_schedules' => DailyScheduleController::class,
                    'students' => StudentController::class,
                    'programs' => ProgramController::class,
                    'menus' => MenuController::class,
                    'tuitions' => TuitionController::class,
                    'registrations' => RegistrationController::class,
                    'promotions' => PromotionController::class,
                    'carausel' => CarauselController::class,
                    'special_features' => SpecialFeatureController::class,
                    'galleries' => GalleryController::class,
                    'feedbacks' => FeedbackController::class,
                    'love-messages' => LoveMessageController::class,
                    'parent_notices' => ParentNoticeController::class,
                ]);

                Route::post('/daily_schedules/reorder', [DailyScheduleController::class, 'reorder'])->name('daily_schedules.reorder');
                // Education content
                Route::get('/education', [EducationContentController::class, 'index'])->name('education.index');
                Route::get('/education/{educationContent}/edit', [EducationContentController::class, 'edit'])->name('education.edit');
                Route::put('/education/{educationContent}', [EducationContentController::class, 'update'])->name('education.update');

                // Activities
                Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
                Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
                Route::get('/activities/create', [ActivityController::class, 'create'])->name('activities.create');
                Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
                Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
                Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

                // Custom
                Route::delete('/galleries/images/{image}', [GalleryController::class, 'destroyImage'])->name('galleries.images.destroy');
                Route::put('/registrations/{id}/update-result', [RegistrationController::class, 'updateResult'])->name('registrations.updateResult');
                Route::post('/menus/sort', [MenuController::class, 'sort'])->name('menus.sort');
            }

            // 🔹 MANAGER
            elseif ($role === 'manager') {
                // Quản lý account + daily_schedules + ban
                Route::post('/accounts/ban/{id}', [AccountController::class, 'ban'])->name('accounts.ban');
                Route::resources([
                    'accounts' => AccountController::class,
                    'daily_schedules' => DailyScheduleController::class,
                    'students' => StudentController::class,
                    'menus' => MenuController::class,
                    'tuition' => TuitionController::class,
                    'registrations' => RegistrationController::class,
                ]);
                // Thêm route khôi phục
                Route::patch('students/{id}/restore', [StudentController::class, 'restore'])
                    ->name('students.restore');
                Route::post('/daily_schedules/reorder', [DailyScheduleController::class, 'reorder'])->name('daily_schedules.reorder');

                Route::put('/registrations/{id}/update-result', [RegistrationController::class, 'updateResult'])
                    ->name('registrations.updateResult');
            }

            // 🔹 TEACHER
            elseif ($role === 'teacher') {
                // Teacher chỉ có dashboard, profile và attendance (đã thêm ở trên)
                // Nếu cần route riêng cho teacher thì thêm tại đây
            }
        });
}
