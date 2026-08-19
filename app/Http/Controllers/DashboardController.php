<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the employer dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();

        // Get companies owned by the logged-in employer.
        $companyIds = $user->companies()->pluck('id');

        // Jobs belonging to employer's companies.
        $jobsQuery = Job::whereIn('company_id', $companyIds);

        $totalJobs = (clone $jobsQuery)->count();

        $activeJobs = (clone $jobsQuery)
            ->where('is_active', true)
            ->count();

        // Applications received for employer's jobs.
        $applicationsQuery = JobApplication::whereHas('job', function ($query) use ($companyIds) {
            $query->whereIn('company_id', $companyIds);
        });

        // Total number of applications.
        $applicationsCount = (clone $applicationsQuery)->count();

        // Total number of unique applicants.
        $totalApplicants = (clone $applicationsQuery)
            ->distinct('user_id')
            ->count('user_id');

        // Pending applications.
        $pendingApplications = (clone $applicationsQuery)
            ->where('status', 'pending')
            ->count();


$pendingCount = (clone $applicationsQuery)
    ->where('status', 'pending')
    ->count();

        // Recent applications.
        $recentApplications = (clone $applicationsQuery)
            ->with([
                'user',
                'job',
            ])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalJobs',
            'activeJobs',
            'applicationsCount',
            'totalApplicants',
            'pendingApplications',
            'recentApplications',
            'pendingCount'
        ));
    }
}