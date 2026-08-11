<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;


use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $applicationsCount = JobApplication::where('user_id', $userId)
            ->count();

        $pendingCount = JobApplication::where('user_id', $userId)
            ->where('status', 'Pending')
            ->count();

        $shortlistedCount = JobApplication::where('user_id', $userId)
            ->where('status', 'Shortlisted')
            ->count();

        $hiredCount = JobApplication::where('user_id', $userId)
            ->where('status', 'Hired')
            ->count();

        $recentApplications = JobApplication::with([
            'job.company',
            'job.category',
        ])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'applicationsCount',
            'pendingCount',
            'shortlistedCount',
            'hiredCount',
            'recentApplications'
        ));
    }
}
