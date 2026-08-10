<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

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
}