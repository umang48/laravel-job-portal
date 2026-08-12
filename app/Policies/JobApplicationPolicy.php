<?php

namespace App\Policies;

use App\Models\JobApplication;
use App\Models\User;


class JobApplicationPolicy
{
    /**
     * Determine whether the user can view any applications.
     */
    public function viewAny(User $user): bool
    {
        return $user->company !== null;
    }

    public function view(User $user, JobApplication $application): bool
    {
        return $application->job
            ->company
            ->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the application status.
     */
    public function update(User $user, JobApplication $application): bool
    {
        return $application->job
            ->company
            ->user_id === $user->id;
    }

    /**
     * Determine whether the user owns the job's company.
     */
    private function ownsJob(
        User $user,
        JobApplication $jobApplication
    ): bool {
        return $jobApplication->job
            && $jobApplication->job->company
            && $jobApplication->job->company->user_id === $user->id;
    }
}