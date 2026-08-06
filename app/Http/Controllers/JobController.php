<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with([
            'company',
            'category'
        ])
        ->latest()
        ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $companies = Company::orderBy('name')->get();

    $categories = JobCategory::orderBy('name')->get();

    return view('jobs.create', compact(
        'companies',
        'categories'
    ));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
{
    $validated = $request->validated();

    Job::create([
        ...$validated,
        'slug' => Str::slug($validated['title']),
        'is_active' => $request->boolean('is_active'),
    ]);

    return redirect()
        ->route('jobs.index')
        ->with('success', 'Job created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
{
    $companies = Company::orderBy('name')->get();

    $categories = JobCategory::orderBy('name')->get();

    return view('jobs.edit', compact(
        'job',
        'companies',
        'categories'
    ));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
{
    $validated = $request->validated();

    $job->update([
        ...$validated,
        'slug' => Str::slug($validated['title']),
        'is_active' => $request->boolean('is_active'),
    ]);

    return redirect()
        ->route('jobs.index')
        ->with('success', 'Job updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
{
    $job->delete();

    return redirect()
        ->route('jobs.index')
        ->with('success', 'Job deleted successfully.');
}
}
