<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FeatureSectionController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ImpactNumbersController;
use App\Http\Controllers\Admin\LoanCalculatorController;
use App\Http\Controllers\Admin\LoanPlansController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\SuccessStoriesController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\TeamSectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\TrustedClientsController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\SectionController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('website.index');
});



Route::get('/calculator', function () {
    return view('website.calculator');
});




Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('notifications')->group(function () {
    Route::post('/send', [NotificationController::class, 'sendNotification']);
    Route::post('/subscribe', [EmailController::class, 'subscribe']);
    Route::get('/statistics', [NotificationController::class, 'statistics']);
    Route::post('/process-pending', [NotificationController::class, 'processPending']);
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/{notification}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    Route::post('/loan-application', [EmailController::class, 'send_loan_application_email']);
    Route::resource('/application', LoanApplicationController::class);
});

Route::prefix('management')->name('management.')->group(function () {
    Route::middleware('guest:management')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

        Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

        // Password Reset Routes
        Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('throttle:5,1');

        Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
        Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('throttle:5,1');
    });

    Route::middleware('auth:management')->group(function () {
        // User Management Routes
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('users/{user}/unlock', [UserController::class, 'unlock'])->name('unlock');
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::put('profile', [UserController::class, 'updateProfile'])->name('update-profile');
        Route::get('change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
        Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('hero', HeroSectionController::class);
        Route::resource('about', AboutSectionController::class);
        Route::resource('features', FeatureSectionController::class);
        Route::resource('service', ServiceSectionController::class);
        Route::resource('price', LoanPlansController::class);
        Route::resource('team', TeamSectionController::class);
        Route::resource('project', SuccessStoriesController::class);
        Route::resource('testimonial', TestimonialsController::class);
        Route::resource('counter', ImpactNumbersController::class);
        Route::resource('client', TrustedClientsController::class);

        Route::resource('support', SupportController::class);
        Route::resource('calculator', LoanCalculatorController::class);
        Route::resource('footer', FooterController::class);
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

    // Other routes...
    Route::resource('hero', HeroSectionController::class);
    Route::resource('calculator', LoanCalculatorController::class);
    Route::resource('footer', FooterController::class);
    // ...
});
