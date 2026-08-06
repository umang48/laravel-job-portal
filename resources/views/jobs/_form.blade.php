<div class="mb-5">
    <label class="block mb-2 font-medium">
        Company
    </label>

    <select
        name="company_id"
        class="w-full border rounded-lg p-3">

        <option value="">
            Select Company
        </option>

        @foreach($companies as $company)

            <option
                value="{{ $company->id }}"
                @selected(old('company_id', $job->company_id ?? '') == $company->id)>

                {{ $company->name }}

            </option>

        @endforeach

    </select>

    @error('company_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6">

<label class="block mb-2 font-medium">

Category

</label>

<select
name="job_category_id"
class="w-full border rounded-lg p-3">

@foreach($categories as $category)

<option
    value="{{ $category->id }}"
    @selected(old('job_category_id', $job->job_category_id ?? '') == $category->id)>
    {{ $category->name }}
</option>

@endforeach

</select>

@error('job_category_id')
    <p class="text-red-500 text-sm mt-1">
        {{ $message }}
    </p>
@enderror

</div>

<div class="mb-5">
    <label class="block mb-2 font-medium">Job Title</label>

    <input
        type="text"
        name="title"
        value="{{ old('title', $job->title ?? '') }}"
        class="w-full border rounded-lg p-3">

    @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-5">

    <label class="block mb-2 font-medium">
        Location
    </label>

    <input
        type="text"
        name="location"
        value="{{ old('location', $job->location ?? '') }}"
        class="w-full border rounded-lg p-3">

    @error('location')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror

</div>

<div class="mb-5">

<label class="block mb-2 font-medium">

Job Type

</label>
<select
name="job_type"
class="w-full border rounded-lg p-3">

@foreach([
'Full Time',
'Part Time',
'Contract',
'Internship',
'Remote'
] as $type)

<option
value="{{ $type }}"
@selected(old('job_type',$job->job_type ?? '')==$type)>

{{ $type }}

</option>

@endforeach

</select>

@error('job_type')
<p class="text-red-500 text-sm mt-1">
    {{ $message }}
</p>
@enderror

</div>

<div class="grid grid-cols-2 gap-6">

<div>

<label>Minimum Salary</label>

<input
    type="number"
    name="salary_min"
    value="{{ old('salary_min', $job->salary_min ?? '') }}"
    class="w-full border rounded-lg p-3">

    @error('salary_min')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

</div>

<div>

<label>Maximum Salary</label>

<input
    type="number"
    name="salary_max"
    value="{{ old('salary_max', $job->salary_max ?? '') }}"
    class="w-full border rounded-lg p-3">

    @error('salary_max')
<p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

</div>

</div>

<div class="mb-5">

<label class="block mb-2 font-medium">

Experience

</label>

<input
    type="text"
    name="experience"
    value="{{ old('experience', $job->experience ?? '') }}"
    placeholder="2-4 Years"
    class="w-full border rounded-lg p-3">

@error('experience')
<p class="text-red-500 text-sm mt-1">
{{ $message }}
</p>
@enderror

</div>


<input
    type="date"
    name="last_date"
    value="{{ old('last_date', isset($job) ? $job->last_date?->format('Y-m-d') : '') }}"
    class="w-full border rounded-lg p-3">

<div class="mb-5">

<label class="block mb-2 font-medium">

Description

</label>

<textarea
    name="description"
    rows="6"
    class="w-full border rounded-lg p-3">{{ old('description', $job->description ?? '') }}</textarea>

@error('description')
<p class="text-red-500 text-sm mt-1">
{{ $message }}
</p>
@enderror

</div>


<div class="mb-6">

<label class="flex items-center gap-3">

<input
    type="checkbox"
    name="is_active"
    value="1"
    @checked(old('is_active', $job->is_active ?? true))
>

<span>Active Job</span>

</label>

</div>