<aside class="w-64 bg-slate-900 text-white min-h-screen">

    <div class="text-2xl font-bold p-6 border-b border-slate-700">
        Job Portal
    </div>

    <nav class="mt-6">

    <a
        href="{{ route('dashboard') }}"
        class="block px-6 py-3 hover:bg-slate-800"
    >
        Dashboard
    </a>

    <a
        href="{{ route('companies.index') }}"
        class="block px-6 py-3 hover:bg-slate-800"
    >
        Companies
    </a>

    <a
        href="{{ route('jobs.index') }}"
        class="block px-6 py-3 hover:bg-slate-800"
    >
        Jobs
    </a>

    <a
        href="{{ route('job-categories.index') }}"
        class="block px-6 py-3 hover:bg-slate-800"
    >
        Categories
    </a>

    <a
        href="{{ route('my-applications.index') }}"
        class="block px-6 py-3 hover:bg-slate-800"
    >
        My Applications
    </a>

</nav>

</aside>