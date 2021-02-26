<?php

use Illuminate\Support\Facades\Route;
use Tipoff\Feedback\Http\Controllers\Web\FeedbackController;

Route::prefix('feedback')->group(function () {
    Route::get('/', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('response', [FeedbackController::class, 'response']);
    Route::get('internal', [FeedbackController::class, 'internal'])->name('feedback.internal');
    Route::post('internal/{feedback}', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::get('external', [FeedbackController::class, 'external']);
    Route::get('review', [FeedbackController::class, 'review']);
    Route::get('thanks', [FeedbackController::class, 'thanks'])->name('feedback.thanks');
});
