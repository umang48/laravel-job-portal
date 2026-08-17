@extends('layouts.app')

@section('title', 'Review Application')

@section('content')

<div class="mb-6">

    <a
        href="{{ route('jobs.applications.index', $jobApplication->job) }}"
        class="text-blue-600 hover:text-blue-800">

        ← Back to Applications

    </a>

</div>

@if(session('success'))

    <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
        {{ session('success') }}
    </div>

@endif

<div class="grid gap-6 md:grid-cols-3">

    {{-- Applicant --}}

    <div class="rounded-xl bg-white p-6 shadow md:col-span-2">

        <h1 class="mb-6 text-2xl font-bold">
            Applicant Details
        </h1>

        <div class="space-y-4">

            <div>
                <p class="text-sm text-gray-500">
                    Name
                </p>

                <p class="font-medium">
                    {{ $jobApplication->user->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Email
                </p>

                <p class="font-medium">
                    {{ $jobApplication->user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Applied For
                </p>

                <p class="font-medium">
                    {{ $jobApplication->job->title }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Applied On
                </p>

                <p class="font-medium">
                    {{ $jobApplication->created_at->format('d M Y, h:i A') }}
                </p>
            </div>

        </div>

        <div class="mt-8">

            <h2 class="mb-3 text-lg font-bold">
                Cover Letter
            </h2>

            <div class="rounded-lg bg-gray-50 p-5 text-gray-700">

                {!! nl2br(e($jobApplication->cover_letter ?: 'No cover letter provided.')) !!}

            </div>

        </div>

        <div class="mt-8">

            <h2 class="mb-3 text-lg font-bold">
                Resume
            </h2>

            <a
    href="{{ route('resumes.download', $jobApplication->user->resume) }}"
    class="rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700">

    Download Resume

</a>

        </div>

    </div>

    {{-- Status --}}

    <div class="rounded-xl bg-white p-6 shadow">

        <h2 class="mb-5 text-lg font-bold">
            Application Status
        </h2>

        <form
            method="POST"
            action="{{ route('job-applications.status', $jobApplication) }}">

            @csrf
            @method('PATCH')

            <select
                name="status"
                class="mb-4 w-full rounded-lg border p-3">

                @foreach([
                    'pending',
                    'shortlisted',
                    'rejected',
                    'hired'
                ] as $status)

                    <option
                        value="{{ $status }}"
                        @selected($jobApplication->status === $status)>

                        {{ ucfirst($status) }}

                    </option>

                @endforeach

            </select>

            @error('status')

                <p class="mb-3 text-sm text-red-600">
                    {{ $message }}
                </p>

            @enderror

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 font-medium text-white hover:bg-blue-700">

                Update Status

            </button>

        </form>

    </div>

</div>

@can('update', $job)

    <a
        href="{{ route('jobs.applications.index', $job) }}"
        class="rounded-lg bg-purple-600 px-5 py-3 text-white hover:bg-purple-700">

        View Applications

    </a>

@endcan

@endsection