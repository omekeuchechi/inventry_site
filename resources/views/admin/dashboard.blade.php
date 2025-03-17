@extends('layouts.app')

@section('content')
    <div class="container">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
                {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Dashboard</a> --}}
                <a href="{{ route('admin.manage_roles') }}" class="btn btn-primary">Manage Users</a>
                <a href="{{ route('admin.register') }}" class="btn btn-success">Register New Staff</a>
                <a href="{{ route('admin.profile') }}" class="btn btn-secondary">Edit Profile</a>
            @endif

        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin!</p>
    </div>
@endsection
