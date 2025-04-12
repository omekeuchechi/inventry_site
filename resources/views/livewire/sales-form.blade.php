{{-- resources/views/livewire/sales-form.blade.php --}}  

<div class="container">  
    <!-- Product Table with Pagination -->  
    <h3>Available Products</h3>  
    <table class="table table-bordered">  
        <thead>  
            <tr>
                <th><i class="fas fa-cubes"></i> Product</th>  
                <th><i class="fas fa-money-bill"></i> Price</th>  
                <th><i class="fas fa-coins"></i> Stock Quantity</th>  
                <th><i class="fas fa-shopping-basket"></i> Action</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($products as $product)  
                <tr>  
                    <td>{{ $product->name }}</td>  
                    <td>${{ number_format($product->price, 2) }}</td>  
                    <td id="stock-quantity-{{ $product->id }}">{{ $product->stock_quantity }}</td>  
                    <td>  
                        <button class="btn btn-primary" wire:click="$set('productId', {{ $product->id }})" id ="sound1">Select</button>  
                    </td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  

    <!-- Pagination -->  
    <div style="margin: 20px 0;">  
        {{ $products->links() }} <!-- Pagination Links -->  
    </div>  

    <form id="sales-form" wire:submit.prevent="sell">  
        <div class="input-group mb-3">  
            <button class="btn btn-outline-secondary" type="button" wire:click="decrementQuantity">−</button>  
            <input   
                type="number"   
                wire:model="quantity"   
                class="form-control text-center"   
                min="1"   
                required   
                style="width: 60px;"   
            />  
            <button class="btn btn-outline-secondary" type="button" wire:click="incrementQuantity">+</button>  
            <button class="btn btn-success" type="submit" id="sell">Sell</button>  
        </div>  
        <div id="response-message"></div>  
    </form>  

    @if (session()->has('message'))  
        <div class="alert alert-success">  
            {{ session('message') }}  
        </div>  
    @endif  

    @if (session()->has('error'))  
        <div class="alert alert-danger">  
            {{ session('error') }}  
        </div>  
    @endif  

    <!-- Cart Section -->  
    <h3>Your Cart</h3>  
    @if (!empty($cart))  
        <table class="table table-bordered">  
            <thead>  
                <tr>  
                    <th>Product</th>  
                    <th>Quantity</th>  
                    <th>Total Price</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach ($cart as $item)  
                    <tr>  
                        <td>{{ $item['name'] }}</td>  
                        <td>{{ $item['quantity'] }}</td>  
                        <td>${{ number_format($item['total_price'], 2) }}</td>  
                    </tr>  
                @endforeach  
            </tbody>  
        </table>  
    @else  
        <p>No items in cart.</p>  
    @endif  

    <!-- Buy Button -->  
    <button class="btn btn-primary mt-3" wire:click="buy">Buy</button>  

    <!-- New Sale Button -->  
    <button class="btn btn-secondary mt-3" wire:click="resetSale">New Sale</button>  

    <!-- Receipt Section -->  
    <div id="receipt" style="display: none;">  
        <h3>Purchase Receipt</h3>  
        <table class="table">  
            <thead>  
                <tr>  
                    <th>Product</th>  
                    <th>Quantity</th>  
                    <th>Total Price</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach ($cart as $item)  
                    <tr>  
                        <td>{{ $item['name'] }}</td>  
                        <td>{{ $item['quantity'] }}</td>  
                        <td>${{ number_format($item['total_price'], 2) }}</td>  
                    </tr>  
                @endforeach  
            </table>  
            <p>Date: {{ now()->format('Y-m-d H:i:s') }}</p>  
            <p>Total Amount: ${{ number_format(array_sum(array_column($cart, 'total_price')), 2) }}</p>  
        </div>  

        <button id="print-receipt" class="btn btn-secondary" onclick="printReceipt()" style="display: none;">Print Receipt</button>  
    </div>  

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>  
    <script> 
    
const soundElements = document.querySelectorAll('#sound1');

soundElements.forEach((element) => {
    element.addEventListener('click', function() {
        // Play the sound
        const audio = new Audio('{{ asset("sounds/sound.mp3") }}');
        element.innerText = 'Selecting...';
        audio.play();
    });
});

const saleSound = document.querySelector('#sell');

saleSound.addEventListener('click', function() {
        // Play the sound
        const audio = new Audio('{{ asset("sounds/sound2.mp3") }}');
        saleSound.innerText = 'Selecting...';
        audio.play();
    });
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;  

        // Initialize Pusher  
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {  
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'  
        });  

        // Subscribe to the relevant channel  
        Livewire.on('receiptShown', () => {  
            const cart = document.getElementById('receipt');  
            cart.style.display = 'block';  
            const printButton = document.getElementById('print-receipt');  
            printButton.style.display = 'inline-block';  
        });  

        const channel = pusher.subscribe('private-products.{{ $productId }}');  
        channel.bind('stock-updated', function(data) {  
            // Update stock quantity in your application or notify user about changes  
            const product_id = data.productId;  
            const stock_quantity = data.stockQuantity;  

            // Update the UI to reflect the new stock quantity  
            const stockElement = document.getElementById(`stock-quantity-${product_id}`);  
            if (stockElement) {  
                stockElement.innerText = stock_quantity;  
            }  
        });
    </script>  
</div>  