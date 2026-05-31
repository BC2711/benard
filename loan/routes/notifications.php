<?php

use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('notifications')->group(function () {
    Route::middleware('auth:management')->group(function () {
        Route::post('/send', [NotificationController::class, 'sendNotification']);
        Route::get('/statistics', [NotificationController::class, 'statistics']);
        Route::post('/process-pending', [NotificationController::class, 'processPending']);
        Route::get('/', [NotificationController::class, 'index']);
        Route::post('/{notification}/read', [NotificationController::class, 'markAsRead']);
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    });

    Route::post('/application', [LoanApplicationController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('loan-application.store');
    Route::post('/news', [NewsletterController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('newsletter.subscribe');
});
