<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Product;   

class HomeController extends Controller  
{  
    /**  
     * Create a new controller instance.  
     *  
     * @return void  
     */  
    public function __construct()  
    {  
        $this->middleware('auth');  
    }  

    /**  
     * Show the application dashboard.  
     *  
     * @return \Illuminate\Contracts\Support\Renderable  
     */  
    public function index()  
    {  
        return view('home');  
    }  

    /**  
     * Show the cashier dashboard with products.  
     *  
     * @return \Illuminate\Contracts\Support\Renderable  
     */  
    public function cashier()  
    {  
        $products = Product::all();  
        // Initialize an empty cart or fetch from session if necessary  
        $cart = session()->get('cart', []); // Get cart from session or initialize to an empty array  
        return view('cashier.dashboard', [  
            'products' => $products,  
            'cart' => $cart, // Pass the cart variable to the view  
        ]);  
    }  

    /**  
     * Show the employee job portal.  
     *  
     * @return \Illuminate\Contracts\Support\Renderable  
     */  
    public function employee()  
    {  
        return view('job.job-portal');  
    }  

    /**  
     * Show the sales report.  
     *  
     * @return \Illuminate\Contracts\Support\Renderable  
     */  
    public function sales_report()  
    {  
        return view('cashier.sales_report');  
    }  
}  