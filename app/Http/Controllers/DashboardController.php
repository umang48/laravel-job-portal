<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [

            'companiesCount' => Company::count(),

            'verifiedCompanies' => Company::where('is_verified', true)->count(),

        ]);
    }
}
