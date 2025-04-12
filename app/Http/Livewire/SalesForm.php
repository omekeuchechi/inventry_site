<?php  

namespace App\Http\Livewire;  

use App\Events\StockUpdated;  
use App\Models\Product;  
use Livewire\Component;  
use Livewire\WithPagination; // Import the WithPagination trait  

class SalesForm extends Component  
{  
    use WithPagination; // Enable pagination  

    public $productId;  
    public $quantity = 1; // Default quantity for sales  
    public $cart = []; // Variable to hold added products for the cart  
    protected $products; // Change visibility to protected  
    public $perPage = 5; // Number of products per page  

    public function mount()  
    {  
        $this->cart = session()->get('cart', []); // Retrieve from session    
    }  

    public function sell()  
    {  
        $this->validate([  
            'quantity' => 'required|numeric|min:1',  
        ]);  

        // Find the product  
        $product = Product::find($this->productId);  

        if ($product && $product->stock_quantity >= $this->quantity) {  
            $totalPrice = $product->price * $this->quantity;  
            $this->cart[] = [  
                'name' => $product->name,  
                'quantity' => $this->quantity,  
                'total_price' => $totalPrice,  
            ];  

            session()->put('cart', $this->cart);  
            session()->flash('message', 'Product added to cart successfully!');  
        } else {  
            session()->flash('error', 'Not enough stock for this sale.');  
        }  
    }  

    public function buy()  
    {  
        if (empty($this->cart)) {  
            session()->flash('error', 'No items in cart to buy.');  
            return;  
        }  

        foreach ($this->cart as $item) {  
            $product = Product::where('name', $item['name'])->first();  
            if ($product) {  
                $product->stock_quantity -= $item['quantity'];  
                $product->save();  
                event(new StockUpdated($product->id, $product->stock_quantity));  
            }  
        }  

        session()->forget('cart'); // Clear cart  
        session()->flash('message', 'Purchase completed successfully!');  
        $this->emit('receiptShown');  
    }  

    // New method to restart a new sale  
    public function resetSale()  
    {  
        // Clear cart and reset quantity  
        $this->cart = [];  
        $this->quantity = 1;  
        $this->productId = null; // Optionally reset selected product  
        session()->forget('cart'); // Clear session cart  
        session()->flash('message', 'Ready for a new sale!'); // Optional message  
    }  

    public function incrementQuantity()  
    {  
        $this->quantity++;  
    }  

    public function decrementQuantity()  
    {  
        if ($this->quantity > 1) {  
            $this->quantity--;  
        }  
    }  

    public function render()  
    {  
        // Use pagination for products  
        $this->products = Product::paginate($this->perPage); // Load paginated products  

        return view('livewire.sales-form', [  
            'cart' => $this->cart,  
            'products' => $this->products, // Pass paginated products to the view  
        ]);  
    }  
}  