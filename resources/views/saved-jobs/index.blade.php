@extends('layouts.app')

@section('title', 'Saved Jobs')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Saved Jobs
        </h1>

        <p class="text-gray-600 mt-2">
            Jobs you saved for later.
        </p>

    </div>


    @if(session('success'))

        <div class="mb-6 rounded-lg
                    border border-green-300
                    bg-green-100
                    px-5 py-4
                    text-green-800">

            {{ session('success') }}

        </div>

    @endif


    @if($savedJobs->count())

        <div class="space-y-5">

            @foreach($savedJobs as $savedJob)

                @php
                    $job = $savedJob->job;
                @endphp

                <div class="rounded-xl
                            border border-gray-200
                            bg-white
                            p-6
                            shadow-sm">

                    <div class="flex flex-col
                                gap-5
                                md:flex-row
                                md:items-center
                                md:justify-between">

                        <div>

                            <h2 class="text-xl font-semibold
                                       text-gray-800">

                                {{ $job->title }}

                            </h2>

                            <p class="mt-1 text-gray-600">

                                {{ $job->company->name }}

                            </p>


                            <div class="mt-3 flex flex-wrap
                                        gap-3 text-sm
                                        text-gray-500">

                                @if($job->location)

                                    <span>
                                        📍 {{ $job->location }}
                                    </span>

                                @endif

                                @if($job->job_type)

                                    <span>
                                        💼 {{ $job->job_type }}
                                    </span>

                                @endif

                                @if($job->experience)

                                    <span>
                                        🎓 {{ $job->experience }}
                                    </span>

                                @endif

                            </div>


                            <p class="mt-3 text-xs text-gray-400">

                                Saved
                                {{ $savedJob->created_at
                                    ->diffForHumans() }}

                            </p>

                        </div>


                        <div class="flex flex-wrap gap-3">

                            <a
                                href="{{ route(
                                    'jobs.show',
                                    $job
                                ) }}"
                                class="rounded-lg
                                       bg-blue-600
                                       px-5 py-2.5
                                       text-white
                                       hover:bg-blue-700">

                                View Job

                            </a>


                            <form
                                method="POST"
                                action="{{ route(
                                    'jobs.unsave',
                                    $job
                                ) }}">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rounded-lg
                                           border
                                           border-red-300
                                           bg-red-50
                                           px-5 py-2.5
                                           text-red-700
                                           hover:bg-red-100">

                                    Remove

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        <div class="mt-6">

            {{ $savedJobs->links() }}

        </div>

    @else

        <div class="rounded-xl
                    border border-gray-200
                    bg-white
                    p-12
                    text-center
                    shadow-sm">

            <div class="text-5xl mb-4">
                ☆
            </div>

            <h2 class="text-xl font-semibold
                       text-gray-800">

                No Saved Jobs

            </h2>

            <p class="mt-2 text-gray-600">

                Save interesting jobs and come back
                to them later.

            </p>

            <a
                href="{{ route('jobs.index') }}"
                class="mt-6 inline-block
                       rounded-lg
                       bg-blue-600
                       px-5 py-3
                       text-white
                       hover:bg-blue-700">

                Browse Jobs

            </a>

        </div>

    @endif

</div>

@endsection