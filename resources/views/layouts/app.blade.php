<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Job Portal')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    @include('partials.sidebar')

    <div class="flex-1">

        @include('partials.navbar')

        <main class="p-8">
        @if(session('success'))
    <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
        {{ session('success') }}
    </div>
@endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>