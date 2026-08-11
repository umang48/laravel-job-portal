@extends('layouts.app')

@section('title', 'My Applications')

@section('content')

<div class="mb-8">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                My Applications
            </h1>

            <p class="text-gray-500 mt-1">
                Track the jobs you have applied for.
            </p>
        </div>

        <a
            href="{{ route('jobs.index') }}"
            class="rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700"
        >
            Browse Jobs
        </a>

    </div>

</div>


@if(session('success'))

    <div class="mb-6 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-green-700">
        {{ session('success') }}
    </div>

@endif


@if($applications->count())

    <div class="overflow-hidden rounded-xl bg-white shadow">

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

                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @foreach($applications as $application)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-gray-800">
                                    {{ $application->job->title }}
                                </div>

                                @if($application->job->location)

                                    <div class="text-sm text-gray-500 mt-1">
                                        {{ $application->job->location }}
                                    </div>

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


                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('jobs.show', $application->job) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium"
                                >
                                    View Job
                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


    <div class="mt-6">

        {{ $applications->links() }}

    </div>

@else

    <div class="rounded-xl bg-white shadow p-12 text-center">

        <div class="text-5xl mb-4">
            📄
        </div>

        <h2 class="text-xl font-semibold text-gray-800">
            No applications yet
        </h2>

        <p class="mt-2 text-gray-500">
            You haven't applied for any jobs yet.
        </p>

        <a
            href="{{ route('jobs.index') }}"
            class="inline-block mt-6 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
        >
            Browse Jobs
        </a>

    </div>

@endif

@endsection