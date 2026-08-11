<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;


class MyApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with([
            'job.company',
            'job.category',
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

        return view('my-applications.index', compact('applications'));
    }
}
