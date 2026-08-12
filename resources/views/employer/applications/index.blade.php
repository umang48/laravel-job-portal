@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Job Applications
            </h1>

            <p class="text-gray-600 mt-1">
                Review applications submitted for your jobs.
            </p>
        </div>

    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-100 border border-green-300
                    text-green-800 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="text-left px-6 py-4">
                            Applicant
                        </th>

                        <th class="text-left px-6 py-4">
                            Job
                        </th>

                        <th class="text-left px-6 py-4">
                            Company
                        </th>

                        <th class="text-left px-6 py-4">
                            Status
                        </th>

                        <th class="text-left px-6 py-4">
                            Applied
                        </th>

                        <th class="text-right px-6 py-4">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                    @forelse($applications as $application)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-900">
                                    {{ $application->user->name }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ $application->user->email }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                {{ $application->job->title }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $application->job->company->name }}

                            </td>

                            <td class="px-6 py-4">

                                <span class="px-3 py-1 rounded-full text-xs
                                    bg-gray-100 text-gray-700">

                                    {{ ucfirst($application->status) }}

                                </span>

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $application->created_at->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route(
                                        'employer.applications.show',
                                        $application
                                    ) }}"
                                    class="text-blue-600 hover:text-blue-800
                                           font-medium">

                                    Review

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-10 text-center text-gray-500">

                                No applications found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-6">

            {{ $applications->links() }}

        </div>

    </div>

</div>

@endsection