<div>  
    <h2 class="text-2xl font-bold mb-4">Sales Dashboard</h2>  

    <!-- Display success or error messages -->  
    @if (session()->has('success'))  
        <div class="bg-green-500 text-white p-2 rounded mb-4">  
            {{ session('success') }}  
        </div>  
    @endif  

    @if (session()->has('error'))  
        <div class="bg-red-500 text-white p-2 rounded mb-4">  
            {{ session('error') }}  
        </div>  
    @endif  

    <!-- Sale Input Form -->  
    <div class="mb-6">  
        <h3 class="text-xl font-semibold mb-2">Record a Sale</h3>  
        <form wire:submit.prevent="sale_product">  
            <div class="mb-4">  
                <label for="itemName" class="block">Item Name</label>  
                <input type="text" id="itemName" class="border rounded w-full p-2" wire:model="itemName" required>  
                @error('itemName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror  
            </div>  
            <div class="mb-4">  
                <label for="itemQuantity" class="block">Quantity</label>  
                <input type="number" id="itemQuantity" class="border rounded w-full p-2" wire:model="itemQuantity" required>  
                @error('itemQuantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror  
            </div>  
            <div class="mb-4">  
                <label for="itemPrice" class="block">Price</label>  
                <input type="number" id="itemPrice" class="border rounded w-full p-2" wire:model="itemPrice" step="0.01" required>  
                @error('itemPrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror  
            </div>  
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Record Sale</button>  
        </form>  
    </div>  

    {{-- <!-- Sales Statistics -->  
    <div>  
        <h3 class="text-xl font-semibold mb-2">Sales Statistics</h3>  
        <ul class="list-disc ml-5">  
            <li>Total Sales: ${{ number_format($totalSales, 2) }}</li>  
            <li>Total Quantity Sold: {{ $totalQuantity }}</li>  
            <li>Total Profit: ${{ number_format($totalProfit, 2) }}</li>  
            <li>Sales Today: ${{ number_format($totalSalesToday, 2) }}</li>  
            <li>Sales Yesterday: ${{ number_format($totalSalesYesterday, 2) }}</li>  
            <li>Sales This Month: ${{ number_format($totalSalesThisMonth, 2) }}</li>  
            <li>Sales Last Month: ${{ number_format($totalSalesLastMonth, 2) }}</li>  
            <li>Sales This Year: ${{ number_format($totalSalesThisYear, 2) }}</li>  
            <li>Sales Last Year: ${{ number_format($totalSalesLastYear, 2) }}</li>  
        </ul>  
    </div>   --}}

    <!-- Display List of Sales -->  
    {{-- <div class="mt-6">  
        <h3 class="text-xl font-semibold mb-2">Sales List</h3>  
        <table class="min-w-full border border-gray-300">  
            <thead>  
                <tr>  
                    <th class="border border-gray-300 p-2">Item</th>  
                    <th class="border border-gray-300 p-2">Quantity</th>  
                    <th class="border border-gray-300 p-2">Total</th>  
                    <th class="border border-gray-300 p-2">Profit</th>  
                    <th class="border border-gray-300 p-2">Date</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach($sales as $sale)  
                    <tr>  
                        <td class="border border-gray-300 p-2">{{ $sale->product->name ?? 'Unknown' }}</td>  
                        <td class="border border-gray-300 p-2">{{ $sale->quantity }}</td>  
                        <td class="border border-gray-300 p-2">${{ number_format($sale->total, 2)
                        }}</td>
                        <td class="border border-gray-300 p-2">${{ number_format($sale->profit, 2) }}</td>
                        <td class="border border-gray-300 p-2">{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
        <div class="mt-4">
            {{ $sales->links() }}
        </div>
    </div> --}}
</div>
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>