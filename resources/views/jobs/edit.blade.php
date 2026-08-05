@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')

<div class="max-w-4xl mx-auto">

    <h1 class="text-3xl font-bold mb-6">

        Edit Job

    </h1>

    <form
        action="{{ route('jobs.update', $job) }}"
        method="POST">

        @csrf
        @method('PUT')

        @include('jobs._form')

        <button
            class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg">

            Update Job

        </button>

    </form>

</div>

@endsection