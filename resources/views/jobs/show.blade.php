@extends('layouts.app')

@section('title', $job->title . ' - Job Portal')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Back --}}
    <div class="mb-6">
        <a
            href="{{ route('jobs.index') }}"
            class="inline-flex items-center text-blue-600 hover:text-blue-800">
            ← Back to Jobs
        </a>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main Job Details --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-xl shadow-sm p-8">

                {{-- Job Header --}}
                <div class="flex justify-between items-start gap-6">

                    <div>

                        <h1 class="text-3xl font-bold text-gray-900">
                            {{ $job->title }}
                        </h1>

                        <p class="mt-2 text-lg text-gray-600">
                            {{ $job->company->name }}
                        </p>

                    </div>

                    @if($job->is_active)

                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                            Active
                        </span>

                    @else

                        <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600">
                            Inactive
                        </span>

                    @endif

                </div>


                {{-- Job Meta --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">

                    <div class="bg-gray-50 rounded-lg p-4">

                        <p class="text-sm text-gray-500">
                            Location
                        </p>

                        <p class="font-medium mt-1">
                            {{ $job->location ?: 'Not specified' }}
                        </p>

                    </div>


                    <div class="bg-gray-50 rounded-lg p-4">

                        <p class="text-sm text-gray-500">
                            Job Type
                        </p>

                        <p class="font-medium mt-1">
                            {{ $job->job_type }}
                        </p>

                    </div>


                    <div class="bg-gray-50 rounded-lg p-4">

                        <p class="text-sm text-gray-500">
                            Experience
                        </p>

                        <p class="font-medium mt-1">
                            {{ $job->experience ?: 'Not specified' }}
                        </p>

                    </div>


                    <div class="bg-gray-50 rounded-lg p-4">

                        <p class="text-sm text-gray-500">
                            Category
                        </p>

                        <p class="font-medium mt-1">
                            {{ $job->category->name }}
                        </p>

                    </div>

                </div>


                {{-- Salary --}}
                @if($job->salary_min || $job->salary_max)

                    <div class="mt-8">

                        <h2 class="text-xl font-semibold mb-3">
                            Salary
                        </h2>

                        <p class="text-2xl font-bold text-green-600">

                            @if($job->salary_min)
                                ₹{{ number_format($job->salary_min) }}
                            @endif

                            @if($job->salary_min && $job->salary_max)
                                -
                            @endif

                            @if($job->salary_max)
                                ₹{{ number_format($job->salary_max) }}
                            @endif

                        </p>

                    </div>

                @endif


                {{-- Description --}}
                <div class="mt-8">

                    <h2 class="text-xl font-semibold mb-4">
                        Job Description
                    </h2>

                    <div class="text-gray-700 leading-7 whitespace-pre-line">
                        {{ $job->description }}
                    </div>

                </div>


                {{-- Last Date --}}
                @if($job->last_date)

                    <div class="mt-8 pt-6 border-t">

                        <p class="text-sm text-gray-500">
                            Application Deadline
                        </p>

                        <p class="font-semibold mt-1">
                            {{ $job->last_date->format('d M Y') }}
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- Company Sidebar --}}
        <div>

            <div class="bg-white rounded-xl shadow-sm p-6 sticky top-6">

                <h2 class="text-xl font-semibold mb-5">
                    About the Company
                </h2>


                {{-- Logo --}}
                <div class="mb-5">

                    @if($job->company->logo)

                        <img
                            src="{{ asset('storage/' . $job->company->logo) }}"
                            alt="{{ $job->company->name }}"
                            class="w-24 h-24 object-contain rounded-lg border bg-white p-2">

                    @else

                        <div class="w-24 h-24 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400">
                            No Logo
                        </div>

                    @endif

                </div>


                <h3 class="text-lg font-bold">
                    {{ $job->company->name }}
                </h3>


                @if($job->company->city)

                    <p class="text-gray-500 mt-2">
                        {{ $job->company->city }}
                    </p>

                @endif


                @if($job->company->description)

                    <p class="text-gray-600 mt-4 leading-6">
                        {{ $job->company->description }}
                    </p>

                @endif


                @if($job->company->website)

                    <a
                        href="{{ $job->company->website }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="block mt-6 text-center rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">

                        Visit Company Website

                    </a>

                @endif

            </div>

        </div>

    </div>

</div>


@auth

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-8 rounded-xl bg-white p-6 shadow">

        <h2 class="mb-5 text-xl font-bold">
            Apply for this Job
        </h2>

        <form
    action="{{ route('jobs.apply', $job) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <div class="mb-5">
        <label class="block mb-2 font-medium">
            Resume
        </label>

        <input
            type="file"
            name="resume"
            accept=".pdf,.doc,.docx"
            class="w-full border rounded-lg p-3"
            required
        >

        @error('resume')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-5">
        <label class="block mb-2 font-medium">
            Cover Letter
        </label>

        <textarea
            name="cover_letter"
            rows="6"
            class="w-full border rounded-lg p-3"
            placeholder="Tell the employer why you are suitable for this job..."
        >{{ old('cover_letter') }}</textarea>

        @error('cover_letter')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <button
        type="submit"
        class="rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700"
    >
        Apply for this Job
    </button>
</form>

    </div>

@else

    <div class="mt-8 rounded-lg bg-blue-50 p-6">

        <p class="text-gray-700">
            Please login to apply for this job.
        </p>

        <a
            href="{{ route('login') }}"
            class="mt-3 inline-block rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

            Login to Apply

        </a>

    </div>

@endauth


@endsection