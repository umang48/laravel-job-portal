@extends('layouts.master')

@section('content')

<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-8">
        Create Company
    </h1>

    <form action="{{ route('companies.store') }}"
          method="POST"
          class="space-y-6 bg-white shadow rounded-lg p-8">

        @csrf

        <div>
            <label class="block mb-2 font-medium">
                Company Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded-lg px-4 py-3">

            @error('name')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium">
                Website
            </label>

            <input
                type="url"
                name="website"
                value="{{ old('website') }}"
                class="w-full border rounded-lg px-4 py-3">

            @error('website')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded-lg px-4 py-3">

            @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-2 font-medium">
                Phone
            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block mb-2 font-medium">
                City
            </label>

            <input
                type="text"
                name="city"
                value="{{ old('city') }}"
                class="w-full border rounded-lg px-4 py-3">
        </div>

        <div>
            <label class="block mb-2 font-medium">
                Description
            </label>

            <textarea
                name="description"
                rows="5"
                class="w-full border rounded-lg px-4 py-3">{{ old('description') }}</textarea>
        </div>

        <button
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">

            Save Company

        </button>

    </form>

</div>

@endsection