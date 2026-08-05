<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobCategory;
use App\Http\Requests\StoreJobRequest;
use Illuminate\Support\Str;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $jobs = Job::with(['company', 'category'])
        ->when($request->search, function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
