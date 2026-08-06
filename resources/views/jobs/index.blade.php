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

                        <a href="{{ route('jobs.edit', $job) }}"
                           class="text-blue-600">

                            Edit

                        </a>

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