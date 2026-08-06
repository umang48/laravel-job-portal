@extends('layouts.master')

@section('content')

<div class="max-w-3xl mx-auto py-10">

    <h1 class="mb-8 text-3xl font-bold">
        Create Company
    </h1>

    <form
        action="{{ route('companies.store') }}"
        method="POST"
        class="rounded-lg bg-white p-8 shadow"
        enctype="multipart/form-data">

        @include('companies._form', [
            'buttonText' => 'Save Company'
        ])

    </form>

</div>

@endsection