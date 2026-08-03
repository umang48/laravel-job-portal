@extends('layouts.app')

@section('title', 'Job Categories')

@section('page-title', 'Job Categories')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-2xl font-bold">Job Categories</h2>
        <p class="text-gray-500">Manage all job categories.</p>
    </div>

    <a href="{{ route('job-categories.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
        + Add Category
    </a>
</div>

@if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 p-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow overflow-hidden">

    <table class="min-w-full">

        <thead class="bg-gray-100">

            <tr>
                <th class="text-left p-4">Name</th>
                <th class="text-left p-4">Status</th>
                <th class="text-left p-4">Created</th>
                <th class="text-center p-4">Actions</th>
            </tr>

        </thead>

        <tbody>

        @forelse($categories as $category)

            <tr class="border-t">

                <td class="p-4 font-medium">
                    {{ $category->name }}
                </td>

                <td class="p-4">

                    @if($category->is_active)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Active
                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                            Inactive
                        </span>

                    @endif

                </td>

                <td class="p-4">
                    {{ $category->created_at->format('d M Y') }}
                </td>

                <td class="p-4 text-center">

                    <a href="{{ route('job-categories.edit', $category) }}"
                       class="text-blue-600 hover:underline">
                        Edit
                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="p-8 text-center text-gray-500">

                    No categories found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="mt-6">

    {{ $categories->links() }}

</div>

@endsection