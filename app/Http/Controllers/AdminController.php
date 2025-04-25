<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Cloudinary\Cloudinary;


class AdminController extends Controller
{
    /**
     * Show the list of users (except the admin).
     */
    protected $cloudinary;
    public function __construct()  
    {  
        $this->cloudinary = new Cloudinary();  
    } 

    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('cashier-dashboard')->with('error', 'Unauthorized Access');
        }

        $users = User::where('role', '!=', 'admin')->get(); // Exclude admin users
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Update the user's role.
     */
    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:cashier,manager,admin',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User role updated successfully.');
    }

    /**
     * Show the staff registration form (Only accessible by admin).
     */
    public function showRegisterForm()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('cashier-dashboard')->with('error', 'Unauthorized Access');
        }

        return view('admin.register');
    }

    /**
     * Store new staff details (Admin registers new staff).
     */
    public function storeStaff(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:cashier,manager'
        ]);

        // Create the new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
            'role' => $request->role
        ]);

        return redirect()->route('admin.register')->with('success', 'Staff registered successfully.');
    }

    /**
     * Show the admin's profile edit form.
     */
    public function editProfile()
    {
        $admin = Auth::user(); // Get the currently logged-in admin
        return view('admin.profile', compact('admin'));
    }

    /**
     * Handle admin profile update.
     */
    public function updateProfile(Request $request)
    {
        $admin = Auth::user(); // Get logged-in admin

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id, // Ignore current admin's email
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update name and email
        $admin->name = $request->name;
        $admin->email = $request->email;

        // If password is provided, update it
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }


    public function notifications()
    {
        return response()->json(Auth::user()->unreadNotifications);
    }

    public function setting()
    {
        return view('admin.setting');
    }
}
