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

    <div class="bg-white rounded-lg shadow p-6 mb-6">

<form
    method="GET"
    action="{{ route('jobs.index') }}"
    class="bg-white rounded-xl shadow-sm p-5 mb-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Search --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Search
            </label>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Job title or company"
                class="w-full rounded-lg border-gray-300 px-4 py-2">
        </div>

        {{-- Category --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Category
            </label>

            <select
                name="category"
                class="w-full rounded-lg border-gray-300 px-4 py-2">

                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(request('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Job Type --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Job Type
            </label>

            <select
                name="job_type"
                class="w-full rounded-lg border-gray-300 px-4 py-2">

                <option value="">All Types</option>

                @foreach([
                    'Full Time',
                    'Part Time',
                    'Contract',
                    'Internship',
                    'Remote'
                ] as $type)

                    <option
                        value="{{ $type }}"
                        @selected(request('job_type') == $type)>
                        {{ $type }}
                    </option>

                @endforeach

            </select>
        </div>

        {{-- Location --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Location
            </label>

            <input
                type="text"
                name="location"
                value="{{ request('location') }}"
                placeholder="Ahmedabad"
                class="w-full rounded-lg border-gray-300 px-4 py-2">
        </div>

    </div>

    <div class="flex gap-3 mt-4">

        <button
            type="submit"
            class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
            Search
        </button>

        <a
            href="{{ route('jobs.index') }}"
            class="rounded-lg bg-gray-200 px-5 py-2 text-gray-700 hover:bg-gray-300">
            Clear
        </a>

    </div>

</form>

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