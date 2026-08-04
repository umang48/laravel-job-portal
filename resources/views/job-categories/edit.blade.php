@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-2xl font-bold mb-6">
            Edit Job Category
        </h2>

        <form action="{{ route('job-categories.update', $jobCategory) }}"
              method="POST">

            @csrf
            @method('PUT')

            @include('job-categories._form')

            <button
                class="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                Update Category

            </button>

        </form>

    </div>

</div>

@endsection