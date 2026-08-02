@extends('layouts.master')

@section('content')

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white shadow rounded-lg p-8">

        <h1 class="text-3xl font-bold mb-6">

            {{ $company->name }}

        </h1>

        <div class="space-y-4">

            <p>

                <strong>City:</strong>

                {{ $company->city }}

            </p>

            <p>

                <strong>Website:</strong>

                {{ $company->website }}

            </p>

            <p>

                <strong>Email:</strong>

                {{ $company->email }}

            </p>

            <p>

                <strong>Phone:</strong>

                {{ $company->phone }}

            </p>

            <p>

                <strong>Description:</strong>

                {{ $company->description }}

            </p>

        </div>

        <div class="mt-8">

            <a href="{{ route('companies.index') }}"
                class="rounded bg-gray-700 px-5 py-3 text-white">

                Back

            </a>

        </div>

    </div>

</div>

@endsection