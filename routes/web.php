<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobAlertController;

Route::get('/job-alerts/subscribe', [JobAlertController::class, 'showSubscriptionForm'])->name('job-alerts.form');
Route::post('/job-alerts/subscribe', [JobAlertController::class, 'subscribe'])->name('job-alerts.subscribe');


Route::get('/jobs', [JobController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});
