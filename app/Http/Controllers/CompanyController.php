<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $companies = Company::latest()->get();

    return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $logo = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('companies', 'public');
        }

        Company::create([
            'user_id'      => auth()->id(),
            'name'         => $request->name,
            'slug'         => Str::slug($request->name),
            'logo'         => $logo,
            'website'      => $request->website,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'city'         => $request->city,
            'description'  => $request->description,
            'is_verified'  => false,
        ]);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
       return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Company $company)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'website' => 'nullable|url',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'city' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('logo')) {

        // Delete old logo
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        // Store new logo
        $validated['logo'] = $request->file('logo')
            ->store('companies', 'public');
    }

    $validated['slug'] = Str::slug($validated['name']);

    $company->update($validated);

    return redirect()
        ->route('companies.index')
        ->with('success', 'Company updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
