@extends('layouts.app')

@section('title','Create Job')

@section('content')

<div class="max-w-5xl">

    <div class="bg-white rounded-xl shadow p-8">

        <h1 class="text-3xl font-bold mb-6">

            Post New Job

        </h1>

        <form
            action="{{ route('jobs.store') }}"
            method="POST">

            @csrf

            @include('jobs._form')

            <button
                class="mt-6 bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">

                Create Job

            </button>

        </form>

    </div>

</div>

@endsection