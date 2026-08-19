@extends('layouts.app')

@section('title', 'Job Seeker Dashboard')

@section('content')

<div class="mb-8">

    <h1 class="text-3xl font-bold text-gray-800">
        Job Seeker Dashboard
    </h1>

    <p class="mt-1 text-gray-500">
        Welcome back, {{ auth()->user()->name }}.
        Track your job applications and discover new opportunities.
    </p>

</div>


{{-- Statistics --}}

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Applications --}}

    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Total Applications
                </p>

                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $applicationsCount }}
                </p>

            </div>

            <div class="bg-blue-100 text-blue-600 rounded-lg p-3 text-xl">
                📄
            </div>

        </div>

        <a
            href="{{ route('applications.mine') }}"
            class="inline-block mt-4 text-sm font-medium text-blue-600 hover:text-blue-800"
        >
            View Applications →
        </a>

    </div>


    {{-- Pending --}}

    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Pending
                </p>

                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $pendingCount }}
                </p>

            </div>

            <div class="bg-yellow-100 text-yellow-600 rounded-lg p-3 text-xl">
                ⏳
            </div>

        </div>

        <p class="mt-4 text-sm text-gray-500">
            Applications awaiting review
        </p>

    </div>


{{-- Quick Actions --}}

<div class="bg-white rounded-xl shadow p-6 mb-8">

    <h2 class="text-xl font-semibold text-gray-800 mb-5">
        Quick Actions
    </h2>

    <div class="flex flex-wrap gap-4">

        <a
            href="{{ route('jobs.index') }}"
            class="rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700"
        >
            Browse Jobs
        </a>

        <a
            href="{{ route('applications.mine') }}"
            class="rounded-lg bg-gray-700 px-5 py-3 text-white hover:bg-gray-800"
        >
            My Applications
        </a>

        <a
            href="{{ route('profile.edit') }}"
            class="rounded-lg border border-gray-300 px-5 py-3 text-gray-700 hover:bg-gray-50"
        >
            Edit Profile
        </a>

    </div>

</div>


{{-- Recent Applications --}}

<div class="bg-white rounded-xl shadow">

    <div class="flex items-center justify-between px-6 py-5 border-b">

        <div>

            <h2 class="text-xl font-semibold text-gray-800">
                Recent Applications
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Your latest job applications
            </p>

        </div>

        <a
            href="{{ route('applications.mine') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-800"
        >
            View All
        </a>

    </div>


    @if($recentApplications->count())

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Job
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Company
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Applied On
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @foreach($recentApplications as $application)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('jobs.show', $application->job) }}"
                                    class="font-semibold text-blue-600 hover:text-blue-800"
                                >
                                    {{ $application->job->title }}
                                </a>

                                @if($application->job->location)

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $application->job->location }}
                                    </p>

                                @endif

                            </td>


                            <td class="px-6 py-4 text-gray-700">

                                {{ $application->job->company->name ?? 'N/A' }}

                            </td>


                            <td class="px-6 py-4 text-gray-600">

                                {{ $application->created_at->format('d M Y') }}

                            </td>


                            <td class="px-6 py-4">

                                @php

                                    $statusClasses = match($application->status) {

                                        'Pending' =>
                                            'bg-yellow-100 text-yellow-800',

                                        'Reviewed' =>
                                            'bg-blue-100 text-blue-800',

                                        'Shortlisted' =>
                                            'bg-green-100 text-green-800',

                                        'Rejected' =>
                                            'bg-red-100 text-red-800',

                                        'Hired' =>
                                            'bg-purple-100 text-purple-800',

                                        default =>
                                            'bg-gray-100 text-gray-800',

                                    };

                                @endphp

                                <span
                                    class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}"
                                >
                                    {{ $application->status }}
                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="p-10 text-center">

            <div class="text-5xl mb-4">
                🔎
            </div>

            <h3 class="text-lg font-semibold text-gray-800">
                No applications yet
            </h3>

            <p class="text-gray-500 mt-2">
                Start exploring jobs and apply for your next opportunity.
            </p>

            <a
                href="{{ route('jobs.index') }}"
                class="inline-block mt-5 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
            >
                Browse Jobs
            </a>

        </div>

    @endif

</div>

@endsection
