@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->role === 'employee')
                    {{ __('Job Request') }}
                    @elseif(Auth::user()->role === 'cashier')
                    {{ __('Cashier') }}
                    @elseif(Auth::user()->role === 'manager')
                    {{ __('Manager') }}
                    @elseif(Auth::user()->role === 'admin')
                    {{ __('Admin') }}
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                @if(Auth::user()->role == 'admin')
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                @elseif(Auth::user()->role == 'employee')
                    <a class="dropdown-item" href="{{ route('job-portal') }}">View Result</a>
                @elseif(Auth::user()->role == 'manager')
                    <a class="dropdown-item" href="{{ route('manager.dashboard') }}">Dashboard</a>
                @elseif(Auth::user()->role == 'cashier')
                    <a class="btn btn-secondary" href="{{ route('cashier-dashboard') }}">Dashboard</a>
                    {{ __('You are now a cashier! '.Auth::user()->name) }}
                @else
                    <a class="dropdown-item" href="{{ route('/') }}">Home</a>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
