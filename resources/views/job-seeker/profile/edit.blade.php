<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Seeker Profile
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8">

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6">

            <form method="POST"
                  action="{{ route('job-seeker.profile.update') }}">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded-lg border px-4 py-3">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Email
                        </label>

                        <input
                            type="email"
                            value="{{ $user->email }}"
                            disabled
                            class="w-full rounded-lg border bg-gray-100 px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-lg border px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            value="{{ old('city', $user->city) }}"
                            class="w-full rounded-lg border px-4 py-3">
                    </div>

                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Bio
                    </label>

                    <textarea
                        name="bio"
                        rows="5"
                        class="w-full rounded-lg border px-4 py-3">{{ old('bio', $user->bio) }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Skills
                    </label>

                    <textarea
                        name="skills"
                        rows="4"
                        placeholder="PHP, Laravel, WordPress, MySQL, JavaScript..."
                        class="w-full rounded-lg border px-4 py-3">{{ old('skills', $user->skills) }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Experience
                    </label>

                    <textarea
                        name="experience"
                        rows="6"
                        placeholder="Describe your professional experience..."
                        class="w-full rounded-lg border px-4 py-3">{{ old('experience', $user->experience) }}</textarea>
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">

                        Save Profile

                    </button>
                </div>

            </form>

        </div>

    </div>




<div class="mt-8 bg-white rounded-xl shadow-sm p-6">

    <h3 class="text-lg font-semibold mb-4">
        Resume
    </h3>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($user->resume)

        <div class="flex items-center justify-between gap-4
                    rounded-lg border p-4">

            <div>
                <p class="font-medium">
                    {{ $user->resume->file_name }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ number_format($user->resume->file_size / 1024, 1) }} KB
                </p>
            </div>

            <div class="flex gap-2">

                <a
                    href="{{ asset('storage/' . $user->resume->file_path) }}"
                    target="_blank"
                    class="rounded-lg bg-gray-600 px-4 py-2 text-white">

                    View

                </a>

                <form
                    method="POST"
                    action="{{ route('job-seeker.resume.destroy') }}">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2 text-white">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    @else

        <p class="mb-4 text-gray-500">
            No resume uploaded yet.
        </p>

    @endif

    <form
        method="POST"
        action="{{ route('job-seeker.resume.store') }}"
        enctype="multipart/form-data"
        class="mt-5">

        @csrf

        <label class="block mb-2 font-medium">
            Upload Resume
        </label>

        <input
            type="file"
            name="resume"
            accept=".pdf"
            class="w-full rounded-lg border p-3">

        @error('resume')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <button
            type="submit"
            class="mt-4 rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">

            {{ $user->resume ? 'Replace Resume' : 'Upload Resume' }}

        </button>

    </form>

</div>





</x-app-layout>