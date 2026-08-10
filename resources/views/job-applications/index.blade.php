@extends('layouts.app')

@section('title', 'Job Applications')

@section('content')

<div class="mb-6 flex items-center justify-between">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Applications
        </h1>

        <p class="mt-1 text-gray-500">
            {{ $job->title }}
        </p>
    </div>

    <a
        href="{{ route('jobs.show', $job) }}"
        class="rounded-lg bg-gray-600 px-5 py-2 text-white hover:bg-gray-700">

        Back to Job

    </a>

</div>

@if(session('success'))

    <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
        {{ session('success') }}
    </div>

@endif

<div class="overflow-hidden rounded-xl bg-white shadow">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>

                <th class="px-6 py-4 text-left">
                    Applicant
                </th>

                <th class="px-6 py-4 text-left">
                    Email
                </th>

                <th class="px-6 py-4 text-left">
                    Applied
                </th>

                <th class="px-6 py-4 text-left">
                    Status
                </th>

                <th class="px-6 py-4 text-right">
                    Action
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($applications as $application)

                <tr class="border-t">

                    <td class="px-6 py-4 font-medium">
                        {{ $application->user->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $application->user->email }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $application->created_at->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4">

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-sm">
                            {{ ucfirst($application->status) }}
                        </span>

                    </td>

                    <td class="px-6 py-4 text-right">

                        <a
                            href="{{ route('job-applications.show', $application) }}"
                            class="text-blue-600 hover:text-blue-800">

                            Review

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="5"
                        class="px-6 py-10 text-center text-gray-500">

                        No applications received yet.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">
    {{ $applications->links() }}
</div>

@endsection