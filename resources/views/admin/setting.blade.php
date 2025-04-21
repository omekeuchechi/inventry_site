@extends('layouts.master')

@section('content')
<div class="container">
    @include('includes.admin_nav')
    
    <h1 class="py-4">Settings</h1>
    <div class="container">
        <form action="" methode="post" entype="multi">
            {{-- @csrf
            <div class="mb-3">
                <label for="site_name" class="form-label">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings->site_name }}">
            </div>
            <div class="mb-3">
                <label for="site_email" class="form-label">Site Email</label>
                <input type="email" class="form-control" id="site_email" name="site_email" value="{{ $settings->site_email }}">
            </div>
            <button type="submit" class="btn btn-primary">Save Settings</button> --}}
        </form>
    </div>
</div>
@endsection