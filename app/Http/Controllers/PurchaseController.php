<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PurchaseController extends Controller
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
        if(!$this->user->can('purchase.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.purchase.manage-purchase');
    }


    public function create()
    {
        if(!$this->user->can('purchase.create')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.purchase.product-purchase');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->user->can('purchase.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'memo_no'         => 'required',
            'memo_date'       => 'required|date',
            'warehouse'       => 'required',
            'supplier'        => 'required',
            'purchase_status' => 'required',
            'product_name'    => 'required',
            'product_qty'     => 'required|numeric',
            'free_qty'        => 'required|numeric',
            'unit_price'      => 'required',
            'total_price'     => 'required',
            'order_tax'       => 'required',
            'order_discount'  => 'required',
            'shipping_cost'   => 'required',
            'payment_status'  => 'required',
            'paid_amount'     => 'required',
            'due_amount'      => 'required',
            'payment_type'    => $request->payment_status != 'Due' ? 'required' : '',
            'account'         => $request->payment_status != 'Due' ? 'required' : ''
        ]);

       try {
            Purchase::create([
            'user'            => Auth::id(),
            'memo_no'         => $request->memo_no,
            'memo_date'       => $request->memo_date,
            'warehouse'       => $request->warehouse,
            'supplier'        => $request->supplier,
            'purchase_status' => $request->purchase_status,
            'product_name'    => $request->product_name,
            'product_qty'     => $request->product_qty,
            'free_qty'        => $request->free_qty,
            'unit_price'      => $request->unit_price,
            'total_price'     => $request->total_price,
            'order_tax'       => $request->order_tax,
            'order_discount'  => $request->order_discount,
            'shipping_cost'   => $request->shipping_cost,
            'payment_status'  => $request->payment_status,
            'paid_amount'     => $request->paid_amount ? $request->paid_amount : null,
            'due_amount'      => $request->due_amount ? $request->due_amount : null,
            'payment_type'    => $request->payment_type ? $request->payment_type : null,
            'bank_account'    => $request->account ? $request->account : null
        ]);

        return response()->json([
            'status' => '1',
            'message' => 'Product Purchase Successful'
        ]);
       } catch (Exception $e) {
           return response()->json([
            'status' => '0',
            'message' => 'Product Purchase Failed!',
            'errors' => $e->getMessage()
        ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function load_purchase_data()
    {
        if(!$this->user->can('purchase.view')){
            abort(403, 'sorry! Access Denied');
        }

        $product_purchase = Purchase::with('warehouse','supplier','purchase_status','product','payment_type','bank_account')->get();

        return response()->json([
            'product_purchase' => $product_purchase
        ]);
    }


}
