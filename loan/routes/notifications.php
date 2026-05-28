<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('notifications')->group(function () {
    Route::post('/send', [NotificationController::class, 'sendNotification']);
    Route::post('/subscribe', [EmailController::class, 'subscribe']);
    Route::get('/statistics', [NotificationController::class, 'statistics']);
    Route::post('/process-pending', [NotificationController::class, 'processPending']);
    Route::get('/', [NotificationController::class, 'index']);
    Route::post('/{notification}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    Route::post('/loan-application', [EmailController::class, 'send_loan_application_email']);
    Route::post('/application', [LoanApplicationController::class, 'store']);
    Route::post('/news', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
});
