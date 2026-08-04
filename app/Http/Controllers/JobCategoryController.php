<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobCategoryRequest;
use App\Http\Requests\UpdateJobCategoryRequest;
use Illuminate\Support\Str;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = JobCategory::query()
            ->latest()
            ->paginate(10);

        return view('job-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('job-categories.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobCategoryRequest $request)
{
    JobCategory::create([

        'name' => $request->name,

        'slug' => Str::slug($request->name),

        'description' => $request->description,

        'is_active' => $request->boolean('is_active'),

    ]);

    return redirect()
        ->route('job-categories.index')
        ->with('success', 'Category created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(JobCategory $jobCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCategory $jobCategory)
{
    return view('job-categories.edit', compact('jobCategory'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory)
{
    $validated = $request->validated();

    $jobCategory->update([
        ...$validated,
        'slug' => Str::slug($validated['name']),
        'is_active' => $request->boolean('is_active'),
    ]);

    return redirect()
        ->route('job-categories.index')
        ->with('success', 'Category updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCategory $jobCategory)
    {
        //
    }
}
