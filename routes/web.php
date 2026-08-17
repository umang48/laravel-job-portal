<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyApplicationController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\ResumeController;


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


Route::middleware('auth')->group(function () {

    // Employer application management
    Route::get(
        '/employer/applications',
        [JobApplicationController::class, 'employerIndex']
    )->name('employer.applications.index');

    Route::get(
        '/employer/applications/{application}',
        [JobApplicationController::class, 'employerShow']
    )->name('employer.applications.show');

    Route::patch(
        '/employer/applications/{application}/status',
        [JobApplicationController::class, 'updateStatus']
    )->name('employer.applications.status');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/my-applications', [
        JobApplicationController::class,
        'myApplications'
    ])->name('applications.mine');

    Route::get('/my-applications/{application}', [
        JobApplicationController::class,
        'showMyApplication'
    ])->name('applications.mine.show');

});


Route::middleware(['auth'])->group(function () {

    Route::get('/saved-jobs', [
        SavedJobController::class,
        'index'
    ])->name('saved-jobs.index');

    Route::post('/jobs/{job}/save', [
        SavedJobController::class,
        'store'
    ])->name('jobs.save');

    Route::delete('/jobs/{job}/save', [
        SavedJobController::class,
        'destroy'
    ])->name('jobs.unsave');

});

Route::middleware('auth')->group(function () {

    Route::get('/job-seeker/profile', [
        JobSeekerProfileController::class,
        'edit'
    ])->name('job-seeker.profile.edit');

    Route::put('/job-seeker/profile', [
        JobSeekerProfileController::class,
        'update'
    ])->name('job-seeker.profile.update');

    Route::post('/job-seeker/resume', [
    ResumeController::class,
    'store'
])->name('job-seeker.resume.store');

Route::delete('/job-seeker/resume', [
    ResumeController::class,
    'destroy'
])->name('job-seeker.resume.destroy');

});


require __DIR__.'/auth.php';
