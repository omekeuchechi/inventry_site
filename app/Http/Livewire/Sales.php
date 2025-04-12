<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Models\Sales;
use App\Models\Product;
use App\Models\Category;

class Sales extends Component
{

    public $sales;
    public $totalSales;
    public $totalQuantity;
    public $totalProfit;
    public $totalSalesToday;
    public $totalSalesYesterday;
    public $totalSalesThisMonth;
    public $totalSalesLastMonth;
    public $totalSalesThisYear;
    public $totalSalesLastYear;
    public $totalSalesThisWeek;
    public $totalSalesLastWeek;
    public $totalSalesThisQuarter;
    public $totalSalesLastQuarter;
    public $totalSalesThisYearToDate;
    public $totalSalesLastYearToDate;
    public $totalSalesThisMonthToDate;
    public $totalSalesLastMonthToDate;

    // public function mount()
    // {
    //     $this->sales = Sales::all();
    //     $this->totalSales = Sales::sum('total');
    //     $this->totalQuantity = Sales::sum('quantity');
    //     $this->totalProfit = Sales::sum('profit');
    //     $this->totalSalesToday = Sales::whereDate('created_at', now())->sum('total');
    //     $this->totalSalesYesterday = Sales::whereDate('created_at', now()->subDay())->sum('total');
    //     $this->totalSalesThisMonth = Sales::whereMonth('created_at', now()->month)->sum('total');
    //     $this->totalSalesLastMonth = Sales::whereMonth('created_at', now()->subMonth())->sum('total');
    //     $this->totalSalesThisYear = Sales::whereYear('created_at', now()->year)->sum('total');
    //     $this->totalSalesLastYear = Sales::whereYear('created_at', now()->subYear())->sum('total');
    //     $this->totalSalesThisWeek = Sales::whereWeek('created_at', now()->week)->sum('total');
    //     $this->totalSalesLastWeek = Sales::whereWeek('created_at', now()->subWeek())->sum('total');
    //     $this->totalSalesThisQuarter = Sales::whereQuarter('created_at', now()->quarter)->sum('total');
    //     $this->totalSalesLastQuarter = Sales::whereQuarter('created_at', now()->subQuarter())->sum('total');
    //     $this->totalSalesThisYearToDate = Sales::whereYear('created_at', now()->year)->whereDate('created_at', '<=', now())->sum('total');
    //     $this->totalSalesLastYearToDate = Sales::whereYear('created_at', now()->subYear())->whereDate('created_at', '<=', now())->sum('total');
    //     $this->totalSalesThisMonthToDate = Sales::whereMonth('created_at', now()->month)->whereDate('created_at', '<=', now())->sum('total');
    //     $this->totalSalesLastMonthToDate = Sales::whereMonth('
    //     created_at', now()->subMonth())->whereDate('created_at', '<=', now())->sum('total');
    // }

    public function render()
    {
        return view('livewire.sales');
    }

    public function sale()
    {
        
    }
}
