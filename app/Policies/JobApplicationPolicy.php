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

    /**
     * Determine whether the user can view the application.
     */
    public function view(User $user, JobApplication $jobApplication): bool
    {
        return $this->ownsJob($user, $jobApplication);
    }

    /**
     * Determine whether the user can update the application status.
     */
    public function update(User $user, JobApplication $jobApplication): bool
    {
        return $this->ownsJob($user, $jobApplication);
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