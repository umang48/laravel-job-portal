@extends('layouts.master')

@section('content')

<div class="max-w-3xl mx-auto py-10">

    <h1 class="mb-8 text-3xl font-bold">
        Edit Company
    </h1>

    <form
        action="{{ route('companies.update', $company) }}"
        method="POST"
        class="rounded-lg bg-white p-8 shadow"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('companies._form', [
            'buttonText' => 'Update Company',
            'company' => $company
        ])

    </form>

</div>

@endsection