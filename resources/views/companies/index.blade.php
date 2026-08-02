@extends('layouts.master')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold">
            Companies
        </h1>

        <a href="{{ route('companies.create') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Add Company
        </a>

    </div>

    @if($companies->isEmpty())

        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded-lg">
            No companies found.
        </div>

    @else

        <div class="overflow-x-auto bg-white rounded-lg shadow">

        @if(session('success'))

        <div class="bg-green-100 text-green-800 border border-green-300 rounded-lg p-4 mb-6">

            {{ session('success') }}

        </div>

        @endif

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">ID</th>

                        <th class="text-left p-4">Company</th>

                        <th class="text-left p-4">City</th>

                        <th class="text-left p-4">Website</th>

                        <th class="text-left p-4">Verified</th>
                        <th class="p-4 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($companies as $company)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-4">
                            {{ $company->id }}
                        </td>

                        <td class="p-4 font-semibold">
                            {{ $company->name }}
                        </td>

                        <td class="p-4">
                            {{ $company->city }}
                        </td>

                        <td class="p-4">
                            {{ $company->website }}
                        </td>

                        <td class="p-4">

                            @if($company->is_verified)

                                <span class="text-green-600 font-semibold">
                                    Verified
                                </span>

                            @else

                                <span class="text-red-600">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td class="p-4">

                            <a href="{{ route('companies.show', $company) }}"
                                class="text-blue-600 hover:underline">

                                View

                            </a>

                            |

                             <a
        href="{{ route('companies.edit', $company) }}"
        class="rounded bg-yellow-500 px-3 py-2 text-white hover:bg-yellow-600">

        Edit

    </a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>

@endsection