<header class="bg-white shadow">

    <div class="flex justify-between items-center p-5">

        <h1 class="text-xl font-bold">

            @yield('page-title')

        </h1>

        <div>

            {{ auth()->user()->name }}

        </div>

    </div>

</header>