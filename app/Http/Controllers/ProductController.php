<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Notifications\LowStockAlert;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::with('category')->get());
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'barcode' => 'required|string|unique:products,barcode|max:50',
        ]);

        $product = Product::create($request->all());

        // Notify admin if stock quantity is at or below reorder level
        $this->checkStockNotification($product);

        return response()->json(['message' => 'Product stocked successfully', 'product' => $product]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'barcode' => 'required|string|unique:products,barcode,' . $id . '|max:50',
        ]);

        // Prevent stock quantity from going below zero
        if ($request->stock_quantity < 0) {
            return response()->json(['error' => 'Stock quantity cannot be negative'], 422);
        }

        $product->update($request->all());

        // Notify admin if stock quantity is at or below reorder level after update
        $this->checkStockNotification($product);

        return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }

    // 🔍 Search for products by name for autocomplete feature
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->get(['id', 'name']); // Return ID and Name for better selection

        return response()->json($products);
    }

    // ✅ Private function to check and send low stock notifications
    private function checkStockNotification(Product $product)
    {
        if ($product->stock_quantity <= $product->reorder_level) {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                $admin->notify(new LowStockAlert($product));
            }
        }
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

}
