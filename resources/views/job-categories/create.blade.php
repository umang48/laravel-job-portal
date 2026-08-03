@extends('layouts.app')

@section('title', 'Create Category')

@section('page-title', 'Create Category')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-xl shadow p-8">

        <h2 class="text-2xl font-bold mb-6">

            Add New Job Category

        </h2>

        <form action="{{ route('job-categories.store') }}"
              method="POST">

            @csrf

            @include('job-categories._form')

            <div class="mt-6">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    Save Category

                </button>

            </div>

        </form>

    </div>

</div>

@endsection