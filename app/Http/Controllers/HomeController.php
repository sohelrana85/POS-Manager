<?php

namespace App\Http\Controllers;

use App\Models\ProductSell;
use App\Models\Purchase;

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
}
