<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\RedirectResponse;


use Illuminate\Http\Request;

class SavedJobController extends Controller
{
     /**
     * Display saved jobs.
     */
    public function index()
    {
        $savedJobs = SavedJob::with([
            'job.company',
            'job.category',
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

        return view(
            'saved-jobs.index',
            compact('savedJobs')
        );
    }

    /**
     * Save a job.
     */
    public function store(Job $job): RedirectResponse
    {
        SavedJob::firstOrCreate([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);

        return back()->with(
            'success',
            'Job saved successfully.'
        );
    }

    /**
     * Remove a saved job.
     */
    public function destroy(Job $job): RedirectResponse
    {
        SavedJob::where('user_id', auth()->id())
            ->where('job_id', $job->id)
            ->delete();

        return back()->with(
            'success',
            'Job removed from saved jobs.'
        );
    }
}
