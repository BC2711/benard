<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\WebsiteContentController;
use App\Http\Controllers\Api\SuccessStoryController as ApiSuccessStoryController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\EmailTrackingController;
use App\Http\Controllers\Web\CmsPageController;
use App\Http\Controllers\Web\SuccessStoryController;
use App\Models\Page;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Route;

Route::get('/', [CmsPageController::class, 'home'])->name('website.home');

Route::get('/consultation', [CmsPageController::class, 'show'])->defaults('slug', 'consultation')->name('website.consultation');
Route::post('/consultation', [ConsultationController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('consultation.store');

Route::get('/email/open/{token}', [EmailTrackingController::class, 'open'])->name('email.track.open');
Route::get('/email/click/{token}', [EmailTrackingController::class, 'click'])->name('email.track.click');

Route::get('/service-details', [CmsPageController::class, 'show'])->defaults('slug', 'service-details')->name('website.service-details');
Route::get('/testimonial-reviews', [CmsPageController::class, 'show'])->defaults('slug', 'testimonial-reviews')->name('website.testimonial-reviews');
Route::redirect('/view-success-stories', '/success-stories', 301);
Route::get('/success-stories', [SuccessStoryController::class, 'index'])->name('website.success-stories.index');
Route::get('/success-stories/{success_story:slug}', [SuccessStoryController::class, 'show'])->name('website.success-stories.show');
Route::get('/calculator', [CmsPageController::class, 'show'])->defaults('slug', 'calculator')->name('website.calculator');

Route::get('/management/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/management/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');
Route::get('/email/verify/{user}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware('signed')
    ->name('verification.verify');
Route::get('/email/change/{user}/{token}', [AuthController::class, 'confirmEmailChange'])
    ->middleware('signed')
    ->name('email-change.verify');

Route::get('/sitemap.xml', function () {
    $pages = Page::published()->get();
    $successStories = SuccessStory::published()->get();

    return response()
        ->view('website.sitemap', compact('pages', 'successStories'))
        ->header('Content-Type', 'application/xml');
})->name('website.sitemap');

Route::prefix('api/website')->name('api.website.')->group(function () {
    Route::get('/home', [WebsiteContentController::class, 'home'])->name('home');
    Route::get('/pages/{slug}', [WebsiteContentController::class, 'page'])->name('pages.show');
    Route::get('/menus/{location?}', [WebsiteContentController::class, 'menu'])->name('menus.show');
    Route::get('/settings', [WebsiteContentController::class, 'settings'])->name('settings.show');
    Route::get('/media', [WebsiteContentController::class, 'media'])->name('media.index');
    Route::get('/collections/{type}', [WebsiteContentController::class, 'collection'])->name('collections.index');
    Route::get('/success-stories', [ApiSuccessStoryController::class, 'index'])->name('success-stories.index');
    Route::get('/success-stories/{success_story:slug}', [ApiSuccessStoryController::class, 'show'])->name('success-stories.show');
});

Route::get('/{slug}', [CmsPageController::class, 'show'])
    ->where('slug', '^(?!management|notifications|register|consultation|calculator|service-details|testimonial-reviews|view-success-stories|storage|up).*$')
    ->name('website.page');
