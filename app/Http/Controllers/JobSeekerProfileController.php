<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobSeekerProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('job-seeker.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:2000'],
            'skills' => ['nullable', 'string', 'max:2000'],
            'experience' => ['nullable', 'string', 'max:5000'],
        ]);

        auth()->user()->update($validated);

        return redirect()
            ->route('job-seeker.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}