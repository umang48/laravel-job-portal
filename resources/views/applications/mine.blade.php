@extends('layouts.app')

@section('title', 'My Applications')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            My Applications
        </h1>

        <p class="text-gray-600 mt-2">
            Track the jobs you have applied for and their current status.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100
                    border border-green-300
                    px-5 py-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if($applications->count())

        <div class="space-y-5">

            @foreach($applications as $application)

                <div class="bg-white rounded-xl shadow-sm
                            border border-gray-200 p-6">

                    <div class="flex flex-col md:flex-row
                                md:items-center
                                md:justify-between gap-4">

                        <div>

                            <h2 class="text-xl font-semibold text-gray-800">
                                {{ $application->job->title }}
                            </h2>

                            <p class="text-gray-600 mt-1">
                                {{ $application->job->company->name }}
                            </p>

                            <p class="text-sm text-gray-500 mt-2">
                                Applied:
                                {{ $application->created_at->format('d M Y') }}
                            </p>

                        </div>

                        <div class="flex items-center gap-4">

                            @php
                                $statusClasses = match($application->status) {
                                    'pending' =>
                                        'bg-yellow-100 text-yellow-800',

                                    'reviewing' =>
                                        'bg-blue-100 text-blue-800',

                                    'shortlisted' =>
                                        'bg-green-100 text-green-800',

                                    'rejected' =>
                                        'bg-red-100 text-red-800',

                                    'hired' =>
                                        'bg-emerald-100 text-emerald-800',

                                    default =>
                                        'bg-gray-100 text-gray-800',
                                };
                            @endphp

                            <span class="px-3 py-1 rounded-full
                                         text-sm font-medium
                                         {{ $statusClasses }}">
                                {{ ucfirst($application->status) }}
                            </span>

                            <a
                                href="{{ route(
                                    'applications.mine.show',
                                    $application
                                ) }}"
                                class="px-4 py-2 rounded-lg
                                       bg-blue-600 text-white
                                       hover:bg-blue-700">

                                View Details

                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="mt-6">
            {{ $applications->links() }}
        </div>

    @else

        <div class="bg-white rounded-xl shadow-sm
                    border border-gray-200
                    p-10 text-center">

            <h2 class="text-xl font-semibold text-gray-800">
                No Applications Yet
            </h2>

            <p class="text-gray-600 mt-2">
                You haven't applied for any jobs yet.
            </p>

            <a
                href="{{ route('jobs.index') }}"
                class="inline-block mt-5
                       px-5 py-3 rounded-lg
                       bg-blue-600 text-white
                       hover:bg-blue-700">

                Browse Jobs

            </a>

        </div>

    @endif

</div>

@endsection