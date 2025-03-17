@extends('layouts.app')

@section('content')

<div class="container">
    {{-- @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.manage_roles') }}" class="btn btn-primary">Manage Users</a>
    @endif --}}

    <h1>Admin Dashboard</h1>
    <p>Welcome, Manager!</p>
</div>
@endsection