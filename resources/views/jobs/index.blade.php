@extends('layouts.app')

@section('title', 'Jobs')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold">
            Jobs
        </h1>

        <a href="{{ route('jobs.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg">

            + Create Job

        </a>

    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">

    <div class="flex items-center justify-between mb-5">

        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Search Jobs
            </h2>

            <p class="text-sm text-gray-500">
                Find jobs matching your requirements.
            </p>
        </div>

    </div>

    <form method="GET" action="{{ route('jobs.index') }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            {{-- Keyword --}}

            <div class="sm:col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Keyword
    </label>

    <input
        type="text"
        name="keyword"
        value="{{ request('keyword') }}"
        placeholder="Search PHP, Laravel, React..."
        class="w-full rounded-lg border-gray-300 px-4 py-3
               focus:border-blue-500 focus:ring-blue-500">
</div>


            {{-- Category --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Category
                </label>

                <select
                    name="category"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

                    <option value="">
                        All Categories
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(request('category') == $category->id)>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Location --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Location
                </label>

                <input
                    type="text"
                    name="location"
                    value="{{ request('location') }}"
                    placeholder="Ahmedabad"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

            </div>


            {{-- Job Type --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Job Type
                </label>

                <select
                    name="job_type"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

                    <option value="">
                        All Job Types
                    </option>

                    @foreach([
                        'Full Time',
                        'Part Time',
                        'Contract',
                        'Internship',
                        'Remote'
                    ] as $type)

                        <option
                            value="{{ $type }}"
                            @selected(request('job_type') === $type)>

                            {{ $type }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Experience --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Experience
                </label>

                <select
                    name="experience"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

                    <option value="">
                        Any Experience
                    </option>

                    @foreach([
                        'Fresher',
                        '0-1 Years',
                        '1-3 Years',
                        '3-5 Years',
                        '5-10 Years',
                        '10+ Years'
                    ] as $experience)

                        <option
                            value="{{ $experience }}"
                            @selected(request('experience') === $experience)>

                            {{ $experience }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Minimum Salary --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Minimum Salary
                </label>

                <input
                    type="number"
                    name="min_salary"
                    value="{{ request('min_salary') }}"
                    placeholder="30000"
                    min="0"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

            </div>


            {{-- Maximum Salary --}}

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Maximum Salary
                </label>

                <input
                    type="number"
                    name="max_salary"
                    value="{{ request('max_salary') }}"
                    placeholder="100000"
                    min="0"
                    class="w-full rounded-lg border-gray-300 px-4 py-3">

            </div>

        </div>


        {{-- Buttons --}}

        <div class="flex items-center gap-3 mt-6">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-6 py-3 text-white font-medium hover:bg-blue-700">

                Search Jobs

            </button>


            <a
                href="{{ route('jobs.index') }}"
                class="rounded-lg bg-gray-200 px-6 py-3 text-gray-700 font-medium hover:bg-gray-300">

                Clear Filters

            </a>

        </div>

    </form>

</div>


@if(
    request()->filled('keyword') ||
    request()->filled('category') ||
    request()->filled('location') ||
    request()->filled('job_type') ||
    request()->filled('experience') ||
    request()->filled('min_salary') ||
    request()->filled('max_salary')
)

    <div class="flex flex-wrap items-center gap-2 mt-5 pt-5 border-t">

        <span class="text-sm font-medium text-gray-600">
            Active filters:
        </span>

        @if(request('keyword'))
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">
                Keyword: {{ request('keyword') }}
            </span>
        @endif

        @if(request('location'))
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">
                Location: {{ request('location') }}
            </span>
        @endif

        @if(request('job_type'))
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">
                {{ request('job_type') }}
            </span>
        @endif

        @if(request('experience'))
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">
                {{ request('experience') }}
            </span>
        @endif

        @if(request('min_salary'))
            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                Min ₹{{ number_format(request('min_salary')) }}
            </span>
        @endif

        @if(request('max_salary'))
            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                Max ₹{{ number_format(request('max_salary')) }}
            </span>
        @endif

        <a
            href="{{ route('jobs.index') }}"
            class="text-sm text-red-600 hover:text-red-700 ml-2">

            Clear all

        </a>

    </div>

@endif



<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

    <div>
        <h2 class="text-xl font-semibold text-gray-800">
            Available Jobs
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            {{ $jobs->total() }} jobs found
        </p>
    </div>

    <div class="flex items-center gap-3">

        <label
            for="sort"
            class="text-sm font-medium text-gray-600">

            Sort by:

        </label>

        <form method="GET" action="{{ route('jobs.index') }}">

            {{-- Preserve existing filters --}}

            @foreach(request()->except('sort', 'page') as $key => $value)

                @if(is_array($value))

                    @foreach($value as $item)

                        <input
                            type="hidden"
                            name="{{ $key }}[]"
                            value="{{ $item }}">

                    @endforeach

                @else

                    <input
                        type="hidden"
                        name="{{ $key }}"
                        value="{{ $value }}">

                @endif

            @endforeach

            <select
                name="sort"
                onchange="this.form.submit()"
                class="rounded-lg border-gray-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">

                <option
                    value="relevance"
                    @selected(request('sort', 'latest') === 'relevance')>
                    Relevance
                </option>

                <option
                    value="latest"
                    @selected(request('sort', 'latest') === 'latest')>
                    Latest
                </option>

                <option
                    value="salary_high"
                    @selected(request('sort') === 'salary_high')>
                    Salary: High to Low
                </option>

                <option
                    value="salary_low"
                    @selected(request('sort') === 'salary_low')>
                    Salary: Low to High
                </option>

            </select>

        </form>

    </div>

</div>



    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left p-4">Title</th>

                    <th class="text-left p-4">Company</th>

                    <th class="text-left p-4">Category</th>

                    <th class="text-left p-4">Location</th>

                    <th class="text-left p-4">Type</th>

                    <th class="text-left p-4">Status</th>

                    <th class="text-center p-4">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($jobs as $job)

                <tr class="border-t">

                    <td class="p-4 font-medium">
                        {{ $job->title }}
                    </td>

                    <td class="p-4">
                        {{ $job->company->name }}
                    </td>

                    <td class="p-4">
                        {{ $job->category->name }}
                    </td>

                    <td class="p-4">
                        {{ $job->location }}
                    </td>

                    <td class="p-4">
                        {{ $job->job_type }}
                    </td>

                    <td class="p-4">

                        @if($job->is_active)

                            <span class="text-green-600 font-semibold">
                                Active
                            </span>

                        @else

                            <span class="text-red-600 font-semibold">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td class="p-4 text-center">

                    <a
                        href="{{ route('jobs.show', $job) }}"
                        class="text-blue-600 hover:text-blue-800">
                        View
                    </a>

                        @can('update', $job)
    <a
        href="{{ route('jobs.edit', $job) }}"
        class="text-indigo-600 hover:text-indigo-800">
        Edit
    </a>
@endcan

@can('delete', $job)
    <form
        method="POST"
        action="{{ route('jobs.destroy', $job) }}"
        class="inline">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Are you sure you want to delete this job?')"
            class="text-red-600 hover:text-red-800">
            Delete
        </button>

    </form>
@endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center p-8">

                        No jobs found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $jobs->links() }}

    </div>

</div>

@endsection