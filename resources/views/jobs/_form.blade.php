<div class="mb-6">

<label class="block mb-2 font-medium">

Company

</label>

<select
name="company_id"
class="w-full border rounded-lg p-3">

@foreach($companies as $company)

<option
value="{{ $company->id }}">

{{ $company->name }}

</option>

@endforeach

</select>

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
value="{{ $category->id }}">

{{ $category->name }}

</option>

@endforeach

</select>

</div>

<div class="mb-6">

<label class="block mb-2">

Job Title

</label>

<input
type="text"
name="title"
class="w-full border rounded-lg p-3">

</div>