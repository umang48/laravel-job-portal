<div class="space-y-6">

    <div>

        <label class="block mb-2 font-medium">

            Category Name

        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $jobCategory->name ?? '') }}"
            class="w-full border rounded-lg px-4 py-3">

        @error('name')

            <p class="text-red-500 mt-1 text-sm">

                {{ $message }}

            </p>

        @enderror

    </div>

    <div>

        <label class="block mb-2 font-medium">

            Description

        </label>

        <textarea
            name="description"
            rows="5"
            class="w-full border rounded-lg px-4 py-3">{{ old('description', $jobCategory->description ?? '') }}</textarea>

    </div>

    <div class="flex items-center gap-2">

        <input
            type="checkbox"
            name="is_active"
            value="1"
            {{ old('is_active', $jobCategory->is_active ?? true) ? 'checked' : '' }}>

        <label>

            Active Category

        </label>

    </div>

</div>