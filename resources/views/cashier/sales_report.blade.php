@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <h1 class="text-center my-4">Sales Report</h1>

    <div class="card">
        <div class="card-header">
            <form method="GET" action="{{ route('sales.report') }}" class="form-inline">
                <div class="form-group mx-2">
                    <label for="start_date" class="mr-2">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="form-group mx-2">
                    <label for="end_date" class="mr-2">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <button type="submit" class="btn btn-primary mx-2">Filter</button>
            </form>
        </div>
        <div class="card-body">
            @if($sales->isEmpty())
                <p class="text-center">No sales data available for the selected date range.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Total Price</th>
                            <th>Sale Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->product_name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>${{ number_format($sale->total_price, 2) }}</td>
                                <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $sales->links() }}
                </div>
            @endif
        </div>
    </div>
</div> --}}
@endsection