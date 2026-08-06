@extends('layouts.app')

@section('title', 'Create Job')

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-8">

    <h1 class="text-2xl font-bold mb-6">
        Create Job
    </h1>

    <form
        action="{{ route('jobs.store') }}"
        method="POST">

        @csrf

        @include('jobs._form')

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded-lg mt-6">

            Save Job

        </button>

    </form>

</div>

@endsection