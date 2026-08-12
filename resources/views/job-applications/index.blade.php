@extends('layouts.app')

@section('title', 'Job Applications')

@section('content')
<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Job Applications
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Review applications received for your jobs.
            </p>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- Filters --}}

            <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">

                <form
                    method="GET"
                    action="{{ route('job-applications.index') }}"
                >

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">


                        {{-- Search --}}

                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Search Applicant
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Name or email"
                                class="w-full rounded-lg border-gray-300 px-4 py-2.5"
                            >

                        </div>


                        {{-- Job --}}

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Job
                            </label>

                            <select
                                name="job_id"
                                class="w-full rounded-lg border-gray-300 px-4 py-2.5"
                            >

                                <option value="">
                                    All Jobs
                                </option>

                                @foreach($jobs as $job)

                                    <option
                                        value="{{ $job->id }}"
                                        @selected(request('job_id') == $job->id)
                                    >
                                        {{ $job->title }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- Status --}}

                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-lg border-gray-300 px-4 py-2.5"
                            >

                                <option value="">
                                    All Statuses
                                </option>

                                <option
                                    value="pending"
                                    @selected(request('status') === 'pending')
                                >
                                    Pending
                                </option>

                                <option
                                    value="shortlisted"
                                    @selected(request('status') === 'shortlisted')
                                >
                                    Shortlisted
                                </option>

                                <option
                                    value="rejected"
                                    @selected(request('status') === 'rejected')
                                >
                                    Rejected
                                </option>

                                <option
                                    value="hired"
                                    @selected(request('status') === 'hired')
                                >
                                    Hired
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="flex items-center gap-3 mt-5">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-medium"
                        >
                            Search
                        </button>

                        <a
                            href="{{ route('job-applications.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-lg font-medium"
                        >
                            Reset
                        </a>

                    </div>

                </form>

            </div>


            {{-- Applications --}}

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

                <div class="px-6 py-5 border-b">

                    <h3 class="text-lg font-semibold text-gray-900">
                        Applications
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $applications->total() }}
                        application{{ $applications->total() !== 1 ? 's' : '' }}
                        found.
                    </p>

                </div>


                @if($applications->count())

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50">

                                <tr>

                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                        Applicant
                                    </th>

                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                        Job
                                    </th>

                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                        Applied
                                    </th>

                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                        Status
                                    </th>

                                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-100">

                                @foreach($applications as $application)

                                    <tr class="hover:bg-gray-50">


                                        {{-- Applicant --}}

                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">

                                                    {{ strtoupper(substr($application->user->name, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <p class="font-medium text-gray-900">
                                                        {{ $application->user->name }}
                                                    </p>

                                                    <p class="text-sm text-gray-500">
                                                        {{ $application->user->email }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Job --}}

                                        <td class="px-6 py-5">

                                            <p class="font-medium text-gray-900">
                                                {{ $application->job->title }}
                                            </p>

                                            <p class="text-sm text-gray-500">
                                                {{ $application->job->location }}
                                            </p>

                                        </td>


                                        {{-- Applied --}}

                                        <td class="px-6 py-5">

                                            <p class="text-sm text-gray-700">
                                                {{ $application->created_at->format('d M Y') }}
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                {{ $application->created_at->diffForHumans() }}
                                            </p>

                                        </td>


                                        {{-- Status --}}

                                        <td class="px-6 py-5">

                                            @if($application->status === 'pending')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                                    Pending
                                                </span>

                                            @elseif($application->status === 'shortlisted')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                    Shortlisted
                                                </span>

                                            @elseif($application->status === 'rejected')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                    Rejected
                                                </span>

                                            @elseif($application->status === 'hired')

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                    Hired
                                                </span>

                                            @else

                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                    {{ ucfirst($application->status) }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Action --}}

                                        <td class="px-6 py-5 text-right">

                                            <a
                                                href="#"
                                                class="text-blue-600 hover:text-blue-800 font-medium text-sm"
                                            >
                                                View Application
                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}

                    <div class="px-6 py-5 border-t">

                        {{ $applications->links() }}

                    </div>


                @else

                    <div class="p-12 text-center">

                        <div class="text-gray-400 mb-4">

                            <svg
                                class="w-12 h-12 mx-auto"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"
                                />
                            </svg>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-900">
                            No applications found
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Try changing your search or filters.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>