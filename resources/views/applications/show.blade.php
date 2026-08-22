@extends('layouts.app')

@section('title', 'Application Details')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="mb-6">

        <a
            href="{{ route('applications.mine') }}"
            class="text-blue-600 hover:underline">

            ← Back to My Applications

        </a>

    </div>

    {{-- Job Information --}}
    <div class="bg-white rounded-xl shadow-sm
                border border-gray-200 p-6 mb-8">

        <div class="flex flex-col md:flex-row
                    md:justify-between gap-4">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $application->job->title }}
                </h1>

                <p class="text-gray-600 mt-2">
                    {{ $application->job->company->name }}
                </p>

                @if($application->job->location)

                    <p class="text-sm text-gray-500 mt-2">
                        📍 {{ $application->job->location }}
                    </p>

                @endif

            </div>

            @php
                $statusClasses = match($application->status) {
    'pending' =>
        'bg-yellow-100 text-yellow-800',

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

            <div>

                <span class="inline-block
                             px-4 py-2
                             rounded-full
                             text-sm font-semibold
                             {{ $statusClasses }}">

                    {{ ucfirst($application->status) }}

                </span>

            </div>

        </div>

    </div>


    {{-- Application Information --}}
    <div class="bg-white rounded-xl shadow-sm
                border border-gray-200 p-6 mb-8">

        <h2 class="text-xl font-semibold text-gray-800 mb-5">
            Application Information
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-gray-500">
                    Applied On
                </p>

                <p class="font-medium text-gray-800 mt-1">
                    {{ $application->created_at->format('d M Y, h:i A') }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Current Status
                </p>

                <p class="font-medium text-gray-800 mt-1">
                    {{ ucfirst($application->status) }}
                </p>

            </div>

        </div>

    </div>


    {{-- Status Timeline --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800">
            Application Status
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Track the progress of your application.
        </p>
    </div>

    @php

        $statuses = [
    'pending' => [
        'label' => 'Applied',
        'description' => 'Your application has been submitted.',
    ],

    'shortlisted' => [
        'label' => 'Shortlisted',
        'description' => 'You have been shortlisted for this position.',
    ],

    'hired' => [
        'label' => 'Hired',
        'description' => 'Congratulations! You have been selected.',
    ],
];

        $statusOrder = array_keys($statuses);

        $currentStatus = $application->status;

        /*
         * Rejected is a terminal status and doesn't follow
         * the normal application progression.
         */
        $isRejected = $currentStatus === 'rejected';

        $currentIndex = array_search(
            $currentStatus,
            $statusOrder,
            true
        );

    @endphp


    {{-- Rejected Application --}}
    @if($isRejected)

        <div class="mb-8 rounded-xl border border-red-200
                    bg-red-50 p-5">

            <div class="flex items-start gap-4">

                <div class="flex h-10 w-10 shrink-0
                            items-center justify-center
                            rounded-full bg-red-100
                            text-red-600">

                    ✕

                </div>

                <div>

                    <h3 class="font-semibold text-red-800">
                        Application Rejected
                    </h3>

                    <p class="text-sm text-red-700 mt-1">
                        Unfortunately, your application was not selected
                        for this position.
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- Normal Status Timeline --}}
    @if(!$isRejected)

        <div class="relative">

            {{-- Vertical Timeline Line --}}
            <div class="absolute left-5 top-5 bottom-5
                        w-0.5 bg-gray-200">
            </div>


            <div class="space-y-8">

                @foreach($statuses as $status => $statusData)

                    @php

                        $statusIndex = array_search(
                            $status,
                            $statusOrder,
                                                       true
                        );

                        $isCompleted =
                            $currentIndex !== false &&
                            $statusIndex < $currentIndex;

                        $isCurrent =
                            $status === $currentStatus;

                        $isUpcoming =
                            $currentIndex !== false &&
                            $statusIndex > $currentIndex;

                    @endphp


                    <div class="relative flex gap-5">

                        {{-- Status Icon --}}
                        <div class="
                            relative z-10
                            flex h-10 w-10 shrink-0
                            items-center justify-center
                            rounded-full
                            border-4 border-white

                            @if($isCompleted)
                                bg-green-600 text-white
                            @elseif($isCurrent)
                                bg-blue-600 text-white
                            @else
                                bg-gray-200 text-gray-500
                            @endif
                        ">

                            @if($isCompleted)

                                ✓

                            @elseif($isCurrent)

                                ●

                            @else

                                ○

                            @endif

                        </div>


                        {{-- Status Content --}}
                        <div class="flex-1 pb-2">

                            <div class="flex flex-col
                                        sm:flex-row
                                        sm:items-center
                                        sm:justify-between
                                        gap-2">

                                <div>

                                    <h3 class="
                                        font-semibold

                                        @if($isCompleted)
                                            text-green-700
                                        @elseif($isCurrent)
                                            text-blue-700
                                        @else
                                            text-gray-400
                                        @endif
                                    ">

                                        {{ $statusData['label'] }}

                                    </h3>

                                    <p class="text-sm mt-1
                                        @if($isUpcoming)
                                            text-gray-400
                                        @else
                                            text-gray-600
                                        @endif
                                    ">

                                        {{ $statusData['description'] }}

                                    </p>

                                </div>


                                {{-- Current Badge --}}
                                @if($isCurrent)

                                    <span class="
                                        inline-flex
                                        items-center
                                        rounded-full
                                        bg-blue-100
                                        px-3 py-1
                                        text-xs
                                        font-semibold
                                        text-blue-700
                                    ">

                                        Current Status

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endif


    {{-- Actual Status History --}}
    @if($application->statusHistories->count())

        <div class="mt-10 pt-8 border-t border-gray-200">

            <h3 class="text-lg font-semibold text-gray-800 mb-6">

                Status History

            </h3>


            <div class="space-y-5">

                @foreach($application->statusHistories as $history)

                    <div class="flex gap-4">

                        <div class="
                            flex h-8 w-8 shrink-0
                            items-center justify-center
                            rounded-full
                            bg-gray-100
                            text-gray-600
                        ">

                            ✓

                        </div>


                        <div class="flex-1">

                            <div class="flex flex-col
                                        sm:flex-row
                                        sm:justify-between
                                        gap-1">

                                <p class="font-medium text-gray-800">

                                   {{ $statuses[$history->status]['label'] ?? ucfirst($history->status) }}

                                </p>

                                <span class="text-sm text-gray-500">

                                    {{ $history->created_at
                                        ->format('d M Y, h:i A') }}

                                </span>

                            </div>


                            @if($history->comment)

                                <p class="text-sm text-gray-600 mt-1">

                                    {{ $history->comment }}

                                </p>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endif

</div>

</div>

@endsection