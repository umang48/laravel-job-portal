@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Review Application
            </h1>

            <p class="text-gray-600 mt-1">
                Review applicant details and update application status.
            </p>

        </div>

        <a
            href="{{ route('employer.applications.index') }}"
            class="px-4 py-2 bg-gray-600 text-white rounded-lg
                   hover:bg-gray-700">

            Back

        </a>

    </div>

    @if(session('success'))

        <div class="mb-6 rounded-lg bg-green-100 border border-green-300
                    text-green-800 px-4 py-3">

            {{ session('success') }}

        </div>

    @endif


    <div class="space-y-6">

    {{-- Applicant Profile --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <div class="flex items-start justify-between">

            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Applicant Profile
                </h2>

                <p class="text-gray-500 mt-1">
                    Applicant for {{ $jobApplication->job->title }}
                </p>
            </div>

            <span class="inline-flex rounded-full px-3 py-1 text-sm font-medium
                @class([
                    'bg-yellow-100 text-yellow-800' =>
                        $jobApplication->status === 'pending',

                    'bg-blue-100 text-blue-800' =>
                        $jobApplication->status === 'under_review',

                    'bg-purple-100 text-purple-800' =>
                        $jobApplication->status === 'shortlisted',

                    'bg-indigo-100 text-indigo-800' =>
                        $jobApplication->status === 'interview',

                    'bg-green-100 text-green-800' =>
                        $jobApplication->status === 'hired',

                    'bg-red-100 text-red-800' =>
                        $jobApplication->status === 'rejected',
                ])">

                {{ ucwords(str_replace('_', ' ', $jobApplication->status)) }}

            </span>

        </div>

    </div>


    {{-- Basic Information --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-5">
            Basic Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">
                    Name
                </p>

                <p class="font-medium text-gray-900">
                    {{ $jobApplication->user->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Email
                </p>

                <p class="font-medium text-gray-900">
                    {{ $jobApplication->user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Phone
                </p>

                <p class="font-medium text-gray-900">
                    {{ $jobApplication->user->phone ?: 'Not provided' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    City
                </p>

                <p class="font-medium text-gray-900">
                    {{ $jobApplication->user->city ?: 'Not provided' }}
                </p>
            </div>

        </div>

    </div>


    {{-- Bio --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-4">
            About Applicant
        </h3>

        @if($jobApplication->user->bio)

            <p class="text-gray-700 whitespace-pre-line">
                {{ $jobApplication->user->bio }}
            </p>

        @else

            <p class="text-gray-500">
                No bio provided.
            </p>

        @endif

    </div>


    {{-- Skills --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-4">
            Skills
        </h3>

        @if($jobApplication->user->skills)

            <div class="flex flex-wrap gap-2">

                @foreach(
                    preg_split('/[,\\n]+/', $jobApplication->user->skills)
                    as $skill
                )

                    @if(trim($skill))

                        <span class="rounded-full bg-blue-100 text-blue-800
                                     px-3 py-1 text-sm">

                            {{ trim($skill) }}

                        </span>

                    @endif

                @endforeach

            </div>

        @else

            <p class="text-gray-500">
                No skills provided.
            </p>

        @endif

    </div>


    {{-- Experience --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-4">
            Experience
        </h3>

        @if($jobApplication->user->experience)

            <p class="text-gray-700 whitespace-pre-line">
                {{ $jobApplication->user->experience }}
            </p>

        @else

            <p class="text-gray-500">
                No experience information provided.
            </p>

        @endif

    </div>


    {{-- Resume --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-lg font-semibold">
                    Resume
                </h3>

                @if($jobApplication->user->resume)

                    <p class="text-sm text-gray-500 mt-1">
                        {{ $jobApplication->user->resume->file_name }}
                    </p>

                @else

                    <p class="text-sm text-gray-500 mt-1">
                        Applicant has not uploaded a resume.
                    </p>

                @endif

            </div>


            @if($jobApplication->user->resume)

                <a
                    href="{{ asset('storage/' . $jobApplication->user->resume->file_path) }}"
                    target="_blank"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-white
                           hover:bg-blue-700">

                    View Resume

                </a>

            @endif

        </div>

    </div>


    {{-- Cover Letter --}}
    <div class="bg-white rounded-xl shadow-sm p-6">

        <h3 class="text-lg font-semibold mb-4">
            Cover Letter
        </h3>

        @if($jobApplication->cover_letter)

            <p class="text-gray-700 whitespace-pre-line">
                {{ $jobApplication->cover_letter }}
            </p>

        @else

            <p class="text-gray-500">
                No cover letter provided.
            </p>

        @endif

    </div>

</div>

    {{-- Job Information --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h2 class="text-lg font-semibold mb-5">
            Job Information
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <p class="text-sm text-gray-500">
                    Job Title
                </p>

                <p class="font-medium">
                    {{ $application->job->title }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Company
                </p>

                <p class="font-medium">
                    {{ $application->job->company->name }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Category
                </p>

                <p class="font-medium">
                    {{ $application->job->category->name ?? 'N/A' }}
                </p>

            </div>

            <div>

                <p class="text-sm text-gray-500">
                    Applied On
                </p>

                <p class="font-medium">
                    {{ $application->created_at->format('d M Y H:i') }}
                </p>

            </div>

        </div>

    </div>


    {{-- Application --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h2 class="text-lg font-semibold mb-5">
            Application
        </h2>

        @if($application->cover_letter)

            <div class="mb-6">

                <p class="text-sm text-gray-500 mb-2">
                    Cover Letter
                </p>

                <div class="bg-gray-50 rounded-lg p-5 whitespace-pre-line">
                    {{ $application->cover_letter }}
                </div>

            </div>

        @endif


        @if($application->resume)

            <div>

                <p class="text-sm text-gray-500 mb-2">
                    Resume
                </p>

                <a
                    href="{{ Storage::url($application->resume) }}"
                    target="_blank"
                    class="inline-flex items-center px-4 py-2
                           bg-blue-600 text-white rounded-lg
                           hover:bg-blue-700">

                    View Resume

                </a>

            </div>

        @endif

    </div>


    {{-- Change Status --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold mb-5">
            Application Status
        </h2>

        <form
            method="POST"
            action="{{ route(
                'employer.applications.status',
                $application
            ) }}">

            @csrf
            @method('PATCH')

            <div class="flex gap-4 items-end">

                <div class="flex-1">

                    <label
                        for="status"
                        class="block text-sm font-medium
                               text-gray-700 mb-2">

                        Status

                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border-gray-300
                               p-3">

                        @foreach([
                            'pending',
                            'reviewing',
                            'shortlisted',
                            'rejected',
                            'hired'
                        ] as $status)

                            <option
                                value="{{ $status }}"
                                @selected(
                                    $application->status === $status
                                )>

                                {{ ucfirst($status) }}

                            </option>

                        @endforeach

                    </select>

                    @error('status')

                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

                <button
                    type="submit"
                    class="px-6 py-3 bg-blue-600 text-white
                           rounded-lg hover:bg-blue-700">

                    Update Status

                </button>

            </div>

        </form>

    </div>

</div>

{{-- Application Status History --}}
<div class="bg-white rounded-xl shadow p-6 mt-6">

    <h2 class="text-lg font-semibold mb-6">
        Application Status History
    </h2>

    @if($application->statusHistories->count())

        <div class="relative">

            <div class="space-y-6">

                @foreach($application->statusHistories as $history)

                    <div class="flex gap-4">

                        {{-- Timeline Dot --}}
                        <div class="flex flex-col items-center">

                            <div class="w-3 h-3 rounded-full bg-blue-600">
                            </div>

                            @if(!$loop->last)

                                <div class="w-px h-full bg-gray-200">
                                </div>

                            @endif

                        </div>

                        {{-- History Content --}}
                        <div class="pb-6">

                            <div class="flex items-center gap-2">

                                <span
                                    class="px-3 py-1 rounded-full
                                           text-xs font-medium
                                           bg-gray-100 text-gray-700">

                                    {{ ucfirst($history->old_status ?? 'Initial') }}

                                </span>

                                <span class="text-gray-400">
                                    →
                                </span>

                                <span
                                    class="px-3 py-1 rounded-full
                                           text-xs font-medium
                                           bg-blue-100 text-blue-700">

                                    {{ ucfirst($history->new_status) }}

                                </span>

                            </div>

                            <p class="text-sm text-gray-500 mt-2">

                                Changed by
                                <span class="font-medium text-gray-700">
                                    {{ $history->changedBy->name }}
                                </span>

                                on

                                {{ $history->created_at->format('d M Y, h:i A') }}

                            </p>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @else

        <p class="text-gray-500">
            No status changes have been recorded yet.
        </p>

    @endif

</div>

@endsection