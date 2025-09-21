<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdmissionController;
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
use App\Http\Controllers\TuitionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/curriculum', [CurriculumController::class, 'index'])->name('curriculum');
Route::get('/parent', [ParentController::class, 'index'])->name('parent');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/admission', [AdmissionController::class, 'index'])->name('admission');
Route::get('/activities/{slug}', [ActivityController::class, 'detail'])
    ->name('activities.detail');
Route::get('/login', [AdminController::class, 'login'])
    ->name('login');
Route::post('/login', [AdminController::class, 'checkLogin'])->name('login.post');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/api/feedbacks', [FeedbackController::class, 'apiFeedbacks']);
Route::post('/register', [RegistrationController::class, 'store'])->name('registration.store');
// routes/web.php
Route::get('/forgot-password', [AdminController::class, 'showForgotForm'])->name('password.forgot-form');
Route::post('/forgot-password', [AdminController::class, 'sendOtp'])->name('password.send-otp');

// Xác minh OTP + đổi mật khẩu
Route::get('/verify-reset', [AdminController::class, 'showVerifyAndResetForm'])->name('password.verify-reset-form');
Route::post('/verify-reset', [AdminController::class, 'verifyAndReset'])->name('password.verify-reset');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['customAuth:admin,manager'])
    ->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('carausel', [CarauselController::class, 'index'])->name('carausel.index');
        Route::get('carausel/add', [CarauselController::class, 'create'])->name('carausel.create');
        Route::post('carausel/add', [CarauselController::class, 'store'])->name('carausel.store');
        Route::get('carausel/edit/{id}', [CarauselController::class, 'edit'])->name('carausel.edit');
        Route::put('carausel/edit/{id}', [CarauselController::class, 'update'])->name('carausel.update');
        Route::delete('carausel/{carausel}', [CarauselController::class, 'destroy'])->name('carausel.destroy');
        Route::get('activities', [ActivityController::class, 'index'])->name('activities.index');
        Route::get('activities/create', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('activities', [ActivityController::class, 'store'])->name('activities.store');
        Route::get('activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::put('activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
        Route::delete('activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
        Route::get('special_features', [SpecialFeatureController::class, 'index'])->name('special_features.index');
        Route::get('special_features/{id}/edit', [SpecialFeatureController::class, 'edit'])->name('special_features.edit');
        Route::put('special_features/{id}', [SpecialFeatureController::class, 'update'])->name('special_features.update');
        Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
        Route::get('galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
        Route::delete('images/{image}', [GalleryController::class, 'destroyImage'])->name('galleries.images.destroy');
        Route::get('programs', [ProgramController::class, 'index'])->name('programs.index');
        Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create');
        Route::post('programs', [ProgramController::class, 'store'])->name('programs.store');
        Route::get('programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit');
        Route::put('programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
        Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');

        Route::get('education', [EducationContentController::class, 'index'])->name('education.index');
        Route::get('education/{educationContent}/edit', [EducationContentController::class, 'edit'])->name('education.edit');
        Route::put('education/{educationContent}', [EducationContentController::class, 'update'])->name('education.update');

        Route::get('daily_schedules', [DailyScheduleController::class, 'index'])
            ->name('daily_schedules.index');
        Route::get('daily_schedules/create', [DailyScheduleController::class, 'create'])
            ->name('daily_schedules.create');
        Route::post('daily_schedules', [DailyScheduleController::class, 'store'])
            ->name('daily_schedules.store');
        Route::get('daily_schedules/{daily_schedule}/edit', [DailyScheduleController::class, 'edit'])
            ->name('daily_schedules.edit');
        Route::put('daily_schedules/{daily_schedule}', [DailyScheduleController::class, 'update'])
            ->name('daily_schedules.update');
        Route::delete('daily_schedules/{daily_schedule}', [DailyScheduleController::class, 'destroy'])
            ->name('daily_schedules.destroy');
        Route::post('daily_schedules/reorder', [DailyScheduleController::class, 'reorder'])
            ->name('daily_schedules.reorder');
        // Danh sách promotions
        Route::get('promotions', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
        Route::post('promotions', [PromotionController::class, 'store'])->name('promotions.store');
        Route::get('promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
        Route::put('promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
        Route::delete('promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
        // Hiển thị danh sách
        Route::get('menus', [MenuController::class, 'index'])
            ->name('menus.index');
        Route::get('menus/create', [MenuController::class, 'create'])
            ->name('menus.create');
        Route::post('menus', [MenuController::class, 'store'])
            ->name('menus.store');
        // Form chỉnh sửa
        Route::get('menus/{menu}/edit', [MenuController::class, 'edit'])
            ->name('menus.edit');
        Route::put('menus/{menu}', [MenuController::class, 'update'])
            ->name('menus.update');
        Route::delete('menus/{menu}', [MenuController::class, 'destroy'])
            ->name('menus.destroy');
        Route::post('menus/sort', [MenuController::class, 'sort'])->name('menus.sort');
        Route::get('parent_notices', [ParentNoticeController::class, 'index'])
            ->name('parent_notices.index');

        Route::get('parent_notices/create', [ParentNoticeController::class, 'create'])
            ->name('parent_notices.create');

        Route::post('parent_notices', [ParentNoticeController::class, 'store'])
            ->name('parent_notices.store');

        Route::get('parent_notices/{id}/edit', [ParentNoticeController::class, 'edit'])
            ->name('parent_notices.edit');

        Route::put('parent_notices/{id}', [ParentNoticeController::class, 'update'])
            ->name('parent_notices.update');

        Route::delete('parent_notices/{id}', [ParentNoticeController::class, 'destroy'])
            ->name('parent_notices.destroy');

        Route::get('feedbacks', [FeedbackController::class, 'index'])
            ->name('feedbacks.index');

        Route::get('feedbacks/create', [FeedbackController::class, 'create'])
            ->name('feedbacks.create');

        Route::post('feedbacks', [FeedbackController::class, 'store'])
            ->name('feedbacks.store');

        Route::get('feedbacks/{feedback}', [FeedbackController::class, 'edit'])
            ->name('feedbacks.edit');

        Route::put('feedbacks/{id}', [FeedbackController::class, 'update'])
            ->name('feedbacks.update');

        Route::delete('feedbacks/{id}', [FeedbackController::class, 'destroy'])
            ->name('feedbacks.destroy');

        Route::get('love-messages', [LoveMessageController::class, 'index'])->name('love-messages.index');

        Route::get('love-messages/create', [LoveMessageController::class, 'create'])->name('love-messages.create');

        Route::post('love-messages', [LoveMessageController::class, 'store'])->name('love-messages.store');

        Route::get('love-messages/{loveMessage}/edit', [LoveMessageController::class, 'edit'])->name('love-messages.edit');

        Route::put('love-messages/{loveMessage}', [LoveMessageController::class, 'update'])->name('love-messages.update');

        Route::delete('love-messages/{loveMessage}', [LoveMessageController::class, 'destroy'])->name('love-messages.destroy');
        Route::get('tuitions', [TuitionController::class, 'index'])->name('tuition.index');
        Route::get('tuitions/create', [TuitionController::class, 'create'])->name('tuition.create');
        Route::post('tuitions', [TuitionController::class, 'store'])->name('tuition.store');
        Route::get('tuitions/{tuition}/edit', [TuitionController::class, 'edit'])->name('tuition.edit');
        Route::put('tuitions/{tuition}', [TuitionController::class, 'update'])->name('tuition.update');
        Route::delete('tuitions/{tuition}', [TuitionController::class, 'destroy'])->name('tuition.destroy');
        Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
        Route::get('registrations/{id}', [RegistrationController::class, 'show'])->name('registrations.show');
        Route::post('registrations/{id}/toggle-status', [RegistrationController::class, 'toggleStatus'])->name('registrations.toggleStatus');
        // Cập nhật kết quả liên hệ (AJAX)
        Route::put('/registrations/{id}/update-result', [RegistrationController::class, 'updateResult'])
            ->name('registrations.updateResult');

        //account 
        // Route::get('/api/accounts', [AdminController::class, 'listAccount'])->name('accounts.index');
        Route::get('accounts', [AdminController::class, 'listAccount'])->name('accounts.index');
        Route::get('/accounts/create', [AdminController::class, 'create'])->name('accounts.create');
        Route::post('/accounts', [AdminController::class, 'store'])->name('accounts.store');
        Route::get('/accounts/{id}/edit', [AdminController::class, 'edit'])->name('accounts.edit');
        Route::put('/accounts/{id}', [AdminController::class, 'update'])->name('accounts.update');
        Route::get('/accounts/ban/{id}', [AdminController::class, 'ban'])->name('accounts.ban');

    });


