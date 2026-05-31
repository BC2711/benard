<?php

use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\CmsCollectionController;
use App\Http\Controllers\Admin\CmsPageController as AdminCmsPageController;
use App\Http\Controllers\Admin\CmsPageSectionController;
use App\Http\Controllers\Admin\ConsultationSectionController;
use App\Http\Controllers\Admin\FeatureSectionController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\EmailLogController;
use App\Http\Controllers\Admin\EmailSettingsController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ImpactNumbersController;
use App\Http\Controllers\Admin\LoanCalculatorController;
use App\Http\Controllers\Admin\LoanPlansController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\SuccessStoriesController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\TeamSectionController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\TrustedClientsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('management')->name('management.')->group(function () {
    Route::middleware('guest:management')->group(function () {
        Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
        Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('throttle:5,1');
        Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
        Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('throttle:5,1');
        Route::get('/two-factor', [AuthController::class, 'showTwoFactorForm'])->name('two-factor.form');
        Route::post('/two-factor', [AuthController::class, 'verifyTwoFactor'])->name('two-factor.verify')->middleware('throttle:5,1');
    });

    Route::middleware('auth:management')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('users/{user}/unlock', [UserController::class, 'unlock'])->name('unlock');
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::put('profile', [UserController::class, 'updateProfile'])->name('update-profile');
        Route::get('change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
        Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('dashboard', DashboardController::class)->only(['index']);
        Route::resource('cms/pages', AdminCmsPageController::class)
            ->names('cms.pages')
            ->parameters(['pages' => 'page']);
        Route::post('cms/pages/{page}/sections/reorder', [CmsPageSectionController::class, 'reorder'])->name('cms.pages.sections.reorder');
        Route::post('cms/pages/{page}/sections', [CmsPageSectionController::class, 'store'])->name('cms.pages.sections.store');
        Route::put('cms/pages/{page}/sections/{section}', [CmsPageSectionController::class, 'update'])->name('cms.pages.sections.update');
        Route::delete('cms/pages/{page}/sections/{section}', [CmsPageSectionController::class, 'destroy'])->name('cms.pages.sections.destroy');

        Route::get('cms/collections/{type}', [CmsCollectionController::class, 'index'])->name('cms.collections.index');
        Route::get('cms/collections/{type}/create', [CmsCollectionController::class, 'create'])->name('cms.collections.create');
        Route::post('cms/collections/{type}', [CmsCollectionController::class, 'store'])->name('cms.collections.store');
        Route::get('cms/collections/{type}/{id}/edit', [CmsCollectionController::class, 'edit'])->name('cms.collections.edit');
        Route::put('cms/collections/{type}/{id}', [CmsCollectionController::class, 'update'])->name('cms.collections.update');
        Route::delete('cms/collections/{type}/{id}', [CmsCollectionController::class, 'destroy'])->name('cms.collections.destroy');

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
        Route::resource('consultation', ConsultationSectionController::class)->only(['index', 'update']);
        Route::post('consultation', [ConsultationController::class, 'store'])->name('consultation.store');
        Route::resource('support', SupportController::class);
        Route::resource('calculator', LoanCalculatorController::class)->only(['index', 'update']);
        Route::resource('footer', FooterController::class);
        Route::get('email/settings', [EmailSettingsController::class, 'edit'])->name('email-settings.edit');
        Route::put('email/settings', [EmailSettingsController::class, 'update'])->name('email-settings.update');
        Route::post('email/settings/test', [EmailSettingsController::class, 'test'])->name('email-settings.test');
        Route::get('email/templates', [EmailTemplateController::class, 'index'])->name('email-templates.index');
        Route::get('email/templates/{template}/edit', [EmailTemplateController::class, 'edit'])->name('email-templates.edit');
        Route::put('email/templates/{template}', [EmailTemplateController::class, 'update'])->name('email-templates.update');
        Route::get('email/templates/{template}/preview', [EmailTemplateController::class, 'preview'])->name('email-templates.preview');
        Route::get('email/logs', [EmailLogController::class, 'index'])->name('email-logs.index');
    });
});
