@extends('layouts.app')

@section('title', 'Jobs')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-3xl font-bold">
        Jobs
    </h1>

    <a href="{{ route('jobs.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg">

        + Add Job

    </a>

</div>

@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-6">
    {{ session('success') }}
</div>

@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-4 text-left">Title</th>

<th class="p-4 text-left">Company</th>

<th class="p-4 text-left">Category</th>

<th class="p-4 text-left">Location</th>

<th class="p-4 text-left">Type</th>

<th class="p-4 text-left">Status</th>

<th class="p-4 text-center">Actions</th>

</tr>

</thead>

<tbody>

@forelse($jobs as $job)

<tr class="border-t">

<td class="p-4 font-medium">

{{ $job->title }}

</td>

<td class="p-4">

{{ $job->company->name }}

</td>

<td class="p-4">

{{ $job->category->name }}

</td>

<td class="p-4">

{{ $job->location }}

</td>

<td class="p-4">

<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

{{ $job->job_type }}

</span>

</td>

<td class="p-4">

@if($job->is_active)

<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

Active

</span>

@else

<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

Inactive

</span>

@endif

</td>

<td class="p-4 text-center">

<a href="{{ route('jobs.edit', $job) }}"
class="text-indigo-600 hover:underline">

Edit

</a>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="p-8 text-center text-gray-500">

No jobs found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

{{ $jobs->links() }}

</div>

@endsection