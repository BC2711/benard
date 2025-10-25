<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.website.index');
});

Route::get('/calculator', function () {
    return view('pages.website.calculator');
});

Route::get('/londa', function () {
    return view('pages.website.index');
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
    Route::post('/loan-application',[EmailController::class,'send_loan_application_email']);
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

        // website management routes
        Route::get('/hero-section', [SectionController::class, 'hero_section'])->name('hero-section');
        Route::post('/hero-section', [SectionController::class, 'hero_section'])->name('hero-section');

        Route::get('/feature-section', [SectionController::class, 'feature_section'])->name('feature-section');
        Route::post('/feature-section', [SectionController::class, 'feature_section'])->name('feature-section');

        Route::get('/about-section', [SectionController::class, 'about_section'])->name('about-section');
        Route::post('/about-section', [SectionController::class, 'about_section'])->name('about-section');

        Route::get('/service-section', [SectionController::class, 'service_section'])->name('service-section');
        Route::post('/service-section', [SectionController::class, 'service_section'])->name('service-section');

        Route::get('/price-section', [SectionController::class, 'price_section'])->name('price-section');
        Route::post('/price-section', [SectionController::class, 'price_section'])->name('price-section');
        Route::post('/price-section/toggle-loan-type', [SectionController::class, 'toggle_loan_type'])->name('pricing.toggle');

        Route::get('/team-section', [SectionController::class, 'team_section'])->name('team-section');
        Route::post('/team-section', [SectionController::class, 'team_section'])->name('team-section');

        Route::get('/project-section', [SectionController::class, 'project_section'])->name('project-section');
        Route::post('/project-section', [SectionController::class, 'project_section'])->name('project-section');

        Route::get('/testimonial-section', [SectionController::class, 'testimonial_section'])->name('testimonial-section');
        Route::post('/testimonial-section', [SectionController::class, 'testimonial_section'])->name('testimonial-section');
        Route::post('/testimonial-section/delete-photo/{index}', [SectionController::class, 'deletePhoto'])->name('delete-photo');

        Route::get('/counter-section', [SectionController::class, 'counter_section'])->name('counter-section');
        Route::post('/counter-section', [SectionController::class, 'counter_section'])->name('counter-section');

        Route::get('/client-section', [SectionController::class, 'client_section'])->name('client-section');
        Route::post('/client-section', [SectionController::class, 'client_section'])->name('client-section');

        Route::get('/blog-section', [SectionController::class, 'blog_section'])->name('blog-section');
        Route::post('/blog-section', [SectionController::class, 'blog_section'])->name('blog-section');

        Route::get('/contact-section', [SectionController::class, 'contact_section'])->name('contact-section');
        Route::post('/contact-section', [SectionController::class, 'contact_section'])->name('contact-section');

        Route::get('/cta-section', [SectionController::class, 'cta_section'])->name('cta-section');
        Route::post('/cta-section', [SectionController::class, 'cta_section'])->name('cta-section');

        Route::get('/footer-section', [SectionController::class, 'footer_section'])->name('footer-section');
        Route::post('/footer-section', [SectionController::class, 'footer_section'])->name('footer-section');
    });
});
