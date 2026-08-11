<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;

class JobApplicationController extends Controller
{
    /**
     * Display applications for a job.
     */
    public function index(Job $job)
    {
        abort_unless(
            $job->company->user_id === auth()->id(),
            403
        );

        $applications = $job->applications()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view(
            'job-applications.index',
            compact('job', 'applications')
        );
    }

    /**
     * Display an application.
     */
    public function show(JobApplication $jobApplication)
    {
        $this->authorize('view', $jobApplication);

        $jobApplication->load([
            'job.company',
            'job.category',
            'user',
        ]);

        return view(
            'job-applications.show',
            compact('jobApplication')
        );
    }

    /**
     * Update application status.
     */
    public function updateStatus(
        Request $request,
        JobApplication $jobApplication
    ) {
        $this->authorize('update', $jobApplication);

        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,shortlisted,rejected,hired',
            ],
        ]);

        $jobApplication->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Application status updated successfully.'
        );
    }

    public function store(
        StoreJobApplicationRequest $request,
        Job $job
    ): RedirectResponse {
        $user = auth()->user();

        // Prevent applying for an inactive job.
        if (!$job->is_active) {
            return back()->with('error', 'This job is no longer accepting applications.');
        }

        // Prevent duplicate applications.
        $alreadyApplied = JobApplication::where('job_id', $job->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You have already applied for this job.');
        }

        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => $user->id,
            'resume' => $request->validated()['resume'],
            'cover_letter' => $request->validated()['cover_letter'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('jobs.show', $job)
            ->with('success', 'Your application has been submitted successfully.');
    }
}