<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Web\CmsPageController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', [CmsPageController::class, 'home'])->name('website.home');

Route::view('/consultation', 'website.consultation')->name('website.consultation');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

Route::view('/service-details', 'website.service_details')->name('website.service-details');
Route::view('/testimonial-reviews', 'website.review_testimonials')->name('website.testimonial-reviews');
Route::view('/view-success-stories', 'website.case')->name('website.success-stories');
Route::view('/calculator', 'website.calculator')->name('website.calculator');

Route::get('/management/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/management/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

Route::get('/sitemap.xml', function () {
    $pages = Page::published()->get();

    return response()
        ->view('website.sitemap', compact('pages'))
        ->header('Content-Type', 'application/xml');
})->name('website.sitemap');

Route::get('/{slug}', [CmsPageController::class, 'show'])
    ->where('slug', '^(?!management|notifications|register|consultation|calculator|service-details|testimonial-reviews|view-success-stories|storage|up).*$')
    ->name('website.page');
