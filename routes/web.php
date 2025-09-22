<?php

use App\Http\Controllers\FhirController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/kyc_url', [FhirController::class, 'kyc_url'])->name('kyc_url');
});
