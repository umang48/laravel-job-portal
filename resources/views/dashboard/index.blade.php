@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <x-stat-card
        title="Companies"
        :value="$companiesCount"
    />

    <x-stat-card
        title="Verified Companies"
        :value="$verifiedCompanies"
    />

</div>

@endsection