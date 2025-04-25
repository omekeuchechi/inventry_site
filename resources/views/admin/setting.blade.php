@extends('layouts.master')

@section('content')
<div class="container">
    @include('includes.admin_nav')
    
    <h1 class="py-2 h1 text-center" style="font-size: 1rem;margin: 10px 0 20px 0">Settings</h1>
    <div class="container">
        <livewire:admin-settings />
    </div>
</div>
@endsection