<?php

namespace App\Http\Controllers;

use App\Models\ProductSell;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductSellController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->user->can('sell.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.sell.manage-sell');
    }
    public function all_sell()
    {
        if(!$this->user->can('sell.view')){
            abort(403, 'sorry! Access Denied');
        }

        $sells = ProductSell::with('productName','customers')->get();
        return response()->json([
            'sells' => $sells
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->user->can('sell.create')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.sell.product-sell');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->user->can('sell.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'customer'       => 'required',
            'invoice_no'     => 'required',
            'invoice_date'   => 'required',
            'product_name'   => 'required',
            'unit_price'     => 'required',
            'product_qty'    => 'required',
            'total_price'    => 'required',
            'payment_status' => 'required',
            'paid_amount'    => 'required',
            'due_amount'     => 'required',
            'payment_type'   => $request->payment_status != 'Due' ? 'required' : ''
        ]);
        try {
            ProductSell::create([
            'user'             => Auth::id(),
            'product'          => $request->product_name,
            'customer'         => $request->customer,
            'invoice_no'       => $request->invoice_no,
            'invoice_date'     => $request->invoice_date,
            'product_qty'      => $request->product_qty,
            'product_price'    => $request->unit_price,
            'tax'              => $request->tax,
            'product_discount' => $request->product_discount,
            'total_amount'     => $request->total_price,
            'payment_status'   => $request->payment_status,
            'receive_amount'   => $request->paid_amount,
            'due_amount'       => $request->due_amount,
            'payment_type'     => $request->payment_type,
            'account_name'     => $request->account,
            ]);


            return response()->json([
                'status' => '1',
                'message' => 'Product Sell Success'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Product Sell Failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSell  $productSell
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSell $productSell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSell  $productSell
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSell $productSell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSell  $productSell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSell $productSell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSell  $productSell
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSell $productSell)
    {
        //
    }
}
