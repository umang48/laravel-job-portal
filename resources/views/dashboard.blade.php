@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Dashboard
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Companies</p>
        <h2 class="text-4xl font-bold mt-2">
            {{ $companies }}
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Jobs</p>
        <h2 class="text-4xl font-bold mt-2">
            {{ $jobs }}
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Categories</p>
        <h2 class="text-4xl font-bold mt-2">
            {{ $categories }}
        </h2>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <p class="text-gray-500">Active Jobs</p>
        <h2 class="text-4xl font-bold mt-2">
            {{ $activeJobs }}
        </h2>
    </div>

</div>

@endsection