<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyApplicationController;



Route::view('/', 'pages.home.index');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/my-applications', [
        MyApplicationController::class,
        'index'
    ])->name('my-applications.index');
        

    Route::resource('companies', CompanyController::class);

    Route::resource('job-categories', JobCategoryController::class);

    Route::resource('jobs', JobController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::post(
        '/jobs/{job}/apply',
        [JobApplicationController::class, 'store']
    )->name('jobs.apply');

});

Route::middleware('auth')->group(function () {

    Route::get(
        '/jobs/{job}/applications',
        [JobApplicationController::class, 'index']
    )->name('jobs.applications.index');

    Route::get(
        '/job-applications/{jobApplication}',
        [JobApplicationController::class, 'show']
    )->name('job-applications.show');

    Route::patch(
        '/job-applications/{jobApplication}/status',
        [JobApplicationController::class, 'updateStatus']
    )->name('job-applications.status');

});




require __DIR__.'/auth.php';
