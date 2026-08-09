@csrf

<div class="space-y-6">

    <div>
        <label class="block mb-2 font-medium">
            Company Name <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $company->name ?? '') }}"
            class="w-full rounded-lg border px-4 py-3">

        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block mb-2 font-medium">
            Website
        </label>

        <input
            type="url"
            name="website"
            value="{{ old('website', $company->website ?? '') }}"
            class="w-full rounded-lg border px-4 py-3">

        @error('website')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block mb-2 font-medium">
            Email
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $company->email ?? '') }}"
            class="w-full rounded-lg border px-4 py-3">

        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-5">

    <label class="block mb-2 font-medium">
        Company Logo
    </label>

    <input
        type="file"
        name="logo"
        accept="image/*"
        class="w-full border rounded-lg p-3">

    @error('logo')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror

    @if(isset($company) && $company->logo)

        <div class="mt-3">
            <p class="text-sm text-gray-500 mb-2">
                Current Logo
            </p>

            <img
                src="{{ asset('storage/' . $company->logo) }}"
                alt="{{ $company->name }}"
                class="w-24 h-24 object-contain rounded-lg border bg-white p-2">
        </div>

    @endif

</div>

    <div>
        <label class="block mb-2 font-medium">
            Phone
        </label>

        <input
            type="text"
            name="phone"
            value="{{ old('phone', $company->phone ?? '') }}"
            class="w-full rounded-lg border px-4 py-3">
    </div>

    <div>
        <label class="block mb-2 font-medium">
            City
        </label>

        <input
            type="text"
            name="city"
            value="{{ old('city', $company->city ?? '') }}"
            class="w-full rounded-lg border px-4 py-3">
    </div>

    <div>
        <label class="block mb-2 font-medium">
            Description
        </label>

        <textarea
            name="description"
            rows="5"
            class="w-full rounded-lg border px-4 py-3">{{ old('description', $company->description ?? '') }}</textarea>
    </div>

    <div class="flex gap-3">
        <button
            type="submit"
            class="rounded-lg bg-blue-600 px-6 py-3 text-white hover:bg-blue-700">

            {{ $buttonText }}

        </button>

        <a href="{{ route('companies.index') }}"
           class="rounded-lg bg-gray-600 px-6 py-3 text-white hover:bg-gray-700">
            Cancel
        </a>
    </div>

</div>