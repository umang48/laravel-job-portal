<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobApplicationRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\RedirectResponse;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;



class JobApplicationController extends Controller
{
use AuthorizesRequests;
   /**
 * Display applications received for employer jobs.
 */
public function index(Request $request): View
{
    $user = auth()->user();

    $companyIds = $user->companies()->pluck('id');

    $jobs = Job::whereIn('company_id', $companyIds)
        ->orderBy('title')
        ->get();

    $applicationsQuery = JobApplication::query()
        ->whereHas('job', function ($query) use ($companyIds) {
            $query->whereIn('company_id', $companyIds);
        })
        ->with([
            'user',
            'job.company',
        ]);

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {

        $search = $request->search;

        $applicationsQuery->whereHas('user', function ($query) use ($search) {

            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");

        });
    }

    /*
    |--------------------------------------------------------------------------
    | Job Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('job_id')) {

        $applicationsQuery->where('job_id', $request->job_id);

    }

    /*
    |--------------------------------------------------------------------------
    | Status Filter
    |--------------------------------------------------------------------------
    */

    if ($request->filled('status')) {

        $applicationsQuery->where('status', $request->status);

    }

    $applications = $applicationsQuery
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('job-applications.index', compact(
        'applications',
        'jobs'
    ));
}

    /**
     * Display an application.
     */
   public function show(JobApplication $jobApplication)
{
    $this->authorize('view', $jobApplication);

    $jobApplication->load([
        'user.resume',
        'job.company',
        'job.category',
    ]);

    return view(
        'employer.applications.show',
        compact('jobApplication')
    );
}

    public function employerIndex()
{
    $applications = JobApplication::with([
        'job.company',
        'user',
    ])
    ->whereHas('job.company', function ($query) {
        $query->where('user_id', auth()->id());
    })
    ->latest()
    ->paginate(10);

    return view(
        'employer.applications.index',
        compact('applications')
    );
}

public function employerShow(JobApplication $application)
{
    $this->authorize('view', $application);

    $application->load([
    'job.company',
    'job.category',
    'user',
    'statusHistories.changedBy',
]);

    return view(
        'employer.applications.show',
        compact('application')
    );
}

    /**
     * Update application status.
     */
    public function updateStatus(
    Request $request,
    JobApplication $application
) {
    $this->authorize('update', $application);

    $validated = $request->validate([
        'status' => [
            'required',
            'in:pending,reviewing,shortlisted,rejected,hired',
        ],
    ]);

    $oldStatus = $application->status;
    $newStatus = $validated['status'];

    if ($oldStatus !== $newStatus) {

        DB::transaction(function () use (
            $application,
            $oldStatus,
            $newStatus
        ) {

            $application->update([
                'status' => $newStatus,
            ]);

            $application->statusHistories()->create([
                'changed_by' => auth()->id(),
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);
        });
    }

    return redirect()
        ->route(
            'employer.applications.show',
            $application
        )
        ->with(
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


    public function myApplications()
{
    $applications = JobApplication::with([
        'job.company',
        'job.category',
    ])
    ->where('user_id', auth()->id())
    ->latest()
    ->paginate(10);

    return view('applications.mine', compact('applications'));
}

public function showMyApplication(JobApplication $application)
{
    abort_unless(
        $application->user_id === auth()->id(),
        403
    );
$application->load([
    'job.company',
    'job.category',
    'user',
    'statusHistories.changedBy',
]);
    return view(
        'applications.show',
        compact('application')
    );
}

}