<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// please take note this is the controller u should be putting all the page that do not need auth
Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('/');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cashier-dashboard', [App\Http\Controllers\HomeController::class, 'cashier'])->name('cashier-dashboard')->middleware('role:cashier');
Route::get('/sales_report', [App\Http\Controllers\HomeController::class, 'sales_report'])->name('sales_report')->middleware('role:cashier');
Route::get('/job-portal', [App\Http\Controllers\HomeController::class, 'employee'])->name('job-portal')->middleware('role:employee');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/manager-dashboard', [ManagerController::class, 'index'])->name('manager.dashboard')->middleware('role:manager');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/manage-roles', [RoleController::class, 'index'])->name('admin.manage_roles');
    Route::patch('/admin/update-role/{id}', [RoleController::class, 'updateRole'])->name('admin.updateRole');
    // Show Edit Profile Form
    Route::get('/admin/profile', [AdminController::class, 'editProfile'])->name('admin.profile');
    // Handle Profile Update
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/register', [AdminController::class, 'storeStaff'])->name('admin.storeStaff');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('/admin/setting', [AdminController::class, 'setting'])->name('admin.setting');
});





// PRODUCT CREATE
Route::middleware(['auth'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('admin');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('admin');
});


// CATEGORY CREATE

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
