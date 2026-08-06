<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobCategory;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

        'companies' => Company::count(),

        'jobs' => Job::count(),

        'categories' => JobCategory::count(),

        'activeJobs' => Job::where('is_active',1)->count(),

    ]);
    }
}
