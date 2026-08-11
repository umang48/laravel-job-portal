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
            href="{{ route('my-applications.index') }}"
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


    {{-- Shortlisted --}}

    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Shortlisted
                </p>

                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $shortlistedCount }}
                </p>

            </div>

            <div class="bg-green-100 text-green-600 rounded-lg p-3 text-xl">
                ⭐
            </div>

        </div>

        <p class="mt-4 text-sm text-gray-500">
            Applications shortlisted
        </p>

    </div>


    {{-- Hired --}}

    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Hired
                </p>

                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ $hiredCount }}
                </p>

            </div>

            <div class="bg-purple-100 text-purple-600 rounded-lg p-3 text-xl">
                🎉
            </div>

        </div>

        <p class="mt-4 text-sm text-gray-500">
            Successful applications
        </p>

    </div>

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
            href="{{ route('my-applications.index') }}"
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
            href="{{ route('my-applications.index') }}"
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


<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Employer Dashboard
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage your jobs and applications.
                </p>
            </div>

            <a
                href="{{ route('jobs.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium"
            >
                + Post New Job
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Statistics --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">


                {{-- Total Jobs --}}

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Jobs
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $totalJobs }}
                            </p>

                        </div>

                        <div class="bg-blue-100 text-blue-600 rounded-lg p-3">

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"
                                />
                            </svg>

                        </div>

                    </div>

                    <a
                        href="{{ route('jobs.index') }}"
                        class="inline-block text-sm text-blue-600 mt-4 hover:underline"
                    >
                        Manage Jobs →
                    </a>

                </div>


                {{-- Active Jobs --}}

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Active Jobs
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $activeJobs }}
                            </p>

                        </div>

                        <div class="bg-green-100 text-green-600 rounded-lg p-3">

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 mt-4">
                        Currently accepting applications
                    </p>

                </div>


                {{-- Total Applicants --}}

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Applicants
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $totalApplicants }}
                            </p>

                        </div>

                        <div class="bg-purple-100 text-purple-600 rounded-lg p-3">

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H7a4 4 0 01-4-4v-1a4 4 0 014-4h6a4 4 0 014 4v1a4 4 0 01-4 4zM9 8a4 4 0 100-8 4 4 0 000 8zm8 0a3 3 0 100-6 3 3 0 000 6z"
                                />
                            </svg>

                        </div>

                    </div>

                    <p class="text-sm text-gray-500 mt-4">
                        Unique job seekers
                    </p>

                </div>


                {{-- Pending Applications --}}

                <div class="bg-white rounded-xl shadow-sm border p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-gray-500">
                                Pending Applications
                            </p>

                            <p class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $pendingApplications }}
                            </p>

                        </div>

                        <div class="bg-yellow-100 text-yellow-600 rounded-lg p-3">

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                        </div>

                    </div>

                    <a
                        href="#recent-applications"
                        class="inline-block text-sm text-blue-600 mt-4 hover:underline"
                    >
                        Review Applications →
                    </a>

                </div>

            </div>


            {{-- Recent Applications --}}

            <div
                id="recent-applications"
                class="bg-white rounded-xl shadow-sm border"
            >

                <div class="flex items-center justify-between p-6 border-b">

                    <div>

                        <h3 class="text-lg font-semibold text-gray-900">
                            Recent Applications
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Latest applications received for your jobs.
                        </p>

                    </div>

                    <a
                        href="#"
                        class="text-sm text-blue-600 hover:underline"
                    >
                        View All
                    </a>

                </div>


                @if($recentApplications->count())

                    <div class="divide-y">

                        @foreach($recentApplications as $application)

                            <div class="p-6 flex items-center justify-between hover:bg-gray-50">

                                <div class="flex items-center gap-4">

                                    <div class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center font-semibold text-gray-600">

                                        {{ strtoupper(substr($application->user->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-900">
                                            {{ $application->user->name }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            Applied for
                                            <span class="font-medium text-gray-700">
                                                {{ $application->job->title }}
                                            </span>
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $application->created_at->diffForHumans() }}
                                        </p>

                                    </div>

                                </div>


                                <div class="flex items-center gap-4">

                                    @if($application->status === 'pending')

                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>

                                    @elseif($application->status === 'shortlisted')

                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            Shortlisted
                                        </span>

                                    @elseif($application->status === 'rejected')

                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            {{ ucfirst($application->status) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="p-10 text-center">

                        <p class="text-gray-500">
                            No applications received yet.
                        </p>

                        <a
                            href="{{ route('jobs.create') }}"
                            class="inline-block mt-4 text-blue-600 hover:underline"
                        >
                            Post your first job →
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>