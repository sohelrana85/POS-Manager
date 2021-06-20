<?php

namespace App\Http\Controllers;

use App\Models\ProductSell;
use App\Models\Purchase;
use Carbon\Carbon;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $purchase_total = Purchase::all()->pluck('total_price')->sum();
        $due_total = Purchase::all()->pluck('due_amount')->sum();
        $sell_total = ProductSell::all()->pluck('total_amount')->sum();
        $sell_due = ProductSell::all()->pluck('due_amount')->sum();
        return view('dashboard', compact('purchase_total','due_total','sell_total','sell_due'));
    }

    public function seven_days_sale(){
        $day0 =  ProductSell::whereDate('created_at', now()->Today())->pluck('total_amount')->sum();
        $day1 =  ProductSell::whereDate('created_at', now()->subDays(1))->pluck('total_amount')->sum();
        $day2 =  ProductSell::whereDate('created_at', now()->subDays(2))->pluck('total_amount')->sum();
        $day3 =  ProductSell::whereDate('created_at', now()->subDays(3))->pluck('total_amount')->sum();
        $day4 =  ProductSell::whereDate('created_at', now()->subDays(4))->pluck('total_amount')->sum();
        $day5 =  ProductSell::whereDate('created_at', now()->subDays(5))->pluck('total_amount')->sum();
        $day6 =  ProductSell::whereDate('created_at', now()->subDays(6))->pluck('total_amount')->sum();
        return response()->json([
            'day0' => $day0,
            'day1' => $day1,
            'day2' => $day2,
            'day3' => $day3,
            'day4' => $day4,
            'day5' => $day5,
            'day6' => $day6,
        ]);

    }
}
