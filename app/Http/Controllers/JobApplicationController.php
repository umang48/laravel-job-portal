<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(
        StoreJobApplicationRequest $request,
        Job $job
    ) {
        // Prevent applying to inactive jobs
        if (! $job->is_active) {
            return back()
                ->with('error', 'This job is no longer accepting applications.');
        }

        // Prevent applying after the deadline
        if (
            $job->last_date &&
            now()->startOfDay()->greaterThan($job->last_date)
        ) {
            return back()
                ->with('error', 'The application deadline has passed.');
        }

        // Prevent duplicate applications
        $alreadyApplied = JobApplication::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return back()
                ->with('error', 'You have already applied for this job.');
        }

        $validated = $request->validated();

        $resumePath = $request->file('resume')
            ->store('resumes', 'public');

        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'resume' => $resumePath,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('jobs.show', $job)
            ->with('success', 'Your application has been submitted successfully.');
    }
}
