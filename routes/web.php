<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CarauselController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\DailyScheduleController;
use App\Http\Controllers\EducationContentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoveMessageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ParentNoticeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SpecialFeatureController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TuitionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum');
Route::get('/parent', [ParentController::class, 'index'])->name('parent');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
Route::get('/activities/{slug}', [ActivityController::class, 'detail'])->name('activities.detail');

Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'checkLogin'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/api/feedbacks', [FeedbackController::class, 'apiFeedbacks']);
Route::post('/register', [RegistrationController::class, 'store'])->name('registration.store');

Route::get('/forgot-password', [AdminController::class, 'showForgotForm'])->name('password.forgot-form');
Route::post('/forgot-password', [AdminController::class, 'sendOtp'])->name('password.send-otp');
Route::get('/verify-reset', [AdminController::class, 'showVerifyAndResetForm'])->name('password.verify-reset-form');
Route::post('/verify-reset', [AdminController::class, 'verifyAndReset'])->name('password.verify-reset');

/*
|--------------------------------------------------------------------------
| Shared Auth Routes (Admin, Manager, Teacher)
|--------------------------------------------------------------------------
*/
Route::middleware(['customAuth:admin,manager,teacher'])->group(function () {
    Route::get('accounts/profile/{id}', [AdminController::class, 'profile'])->name('accounts.profile');
    Route::post('accounts/change-password', [AdminController::class, 'changePassword'])->name('accounts.change-password');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('accounts.update-profile');

    Route::get('attendances/{classname}/{date?}', [AttendanceController::class, 'form'])->name('attendances.form');
    Route::post('attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('student/{studentId}/stats', [AdminController::class, 'stats'])->name('attendances.stats');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('customAuth:admin')->group(function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Resources
    Route::resource('students', StudentController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::resource('tuitions', TuitionController::class);
    Route::resource('registrations', RegistrationController::class)->only(['index', 'show']);
    Route::resource('daily_schedules', DailyScheduleController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('carausel', CarauselController::class);
    Route::resource('special_features', SpecialFeatureController::class)->only(['index', 'edit', 'update']);
    Route::resource('galleries', GalleryController::class)->except(['create', 'store']);
    Route::resource('feedbacks', FeedbackController::class)->except(['show']);
    Route::resource('love-messages', LoveMessageController::class);
    Route::resource('parent_notices', ParentNoticeController::class);
    Route::resource('accounts', AccountController::class);
   // Ban / Unban
    Route::post('accounts/ban/{id}', [AccountController::class, 'ban'])->name('accounts.ban');
    Route::get('education', [EducationContentController::class, 'index'])->name('education.index');
    Route::get('education/{educationContent}/edit', [EducationContentController::class, 'edit'])->name('education.edit');
    Route::put('education/{educationContent}', [EducationContentController::class, 'update'])->name('education.update');

    // Activities
    Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
    Route::get('activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
    Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');

    // Custom routes
    Route::delete('galleries/images/{image}', [GalleryController::class, 'destroyImage'])->name('galleries.images.destroy');
    Route::put('/registrations/{id}/update-result', [RegistrationController::class, 'updateResult'])->name('registrations.updateResult');
    Route::post('menus/sort', [MenuController::class, 'sort'])->name('menus.sort');

    Route::resource('love-messages', LoveMessageController::class);
});

/*
|--------------------------------------------------------------------------
| Manager Routes
|--------------------------------------------------------------------------
*/
Route::prefix('manager')->name('manager.')->middleware('customAuth:manager')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('students', StudentController::class);
    Route::resource('daily_schedules', DailyScheduleController::class);
    Route::resource('menus', MenuController::class)->except(['show']);
    Route::resource('tuitions', TuitionController::class);
    Route::resource('registrations', RegistrationController::class)->only(['index', 'show']);

    // Account management
    Route::resource('accounts', AdminController::class)->except(['show', 'destroy']); // tùy chỉnh nếu AdminController quản lý account
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::prefix('teacher')->name('teacher.')->middleware('customAuth:teacher')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('attendances/{classname}/{date?}', [AttendanceController::class, 'form'])->name('attendances.form');
    Route::post('attendances/store', [AttendanceController::class, 'store'])->name('attendances.store');
});
