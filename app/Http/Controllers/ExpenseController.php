<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::with('expense','pType','bAccount')->select('id','date','expense_type','payment_status','paid_amount','due_amount','payment_type','bank_account','remarks');
        return DataTables($expenses)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date'           => 'required',
            'expense_type'   => 'required',
            'payment_status' => 'required',
            'paid_amount'    => $request->payment_status != "Due" ? 'required' : '',
            'due_amount'     => $request->payment_status != "Paid" ? 'required' : '',
            'payment_type'   => $request->payment_status != "Due" ? 'required' : '',
            'bank_account'   => $request->payment_status != "Due" ? 'required' : '',
            'remarks'        => 'required'
        ]);

        try {
            Expense::create([
                'user'           => Auth::id(),
                'date'           => $request->date,
                'expense_type'   => $request->expense_type,
                'payment_status' => $request->payment_status,
                'paid_amount'    => $request->paid_amount ? $request->paid_amount : null,
                'due_amount'     => $request->due_amount ? $request->due_amount : null,
                'payment_type'   => $request->payment_type ? $request->payment_type : null,
                'bank_account'   => $request->bank_account ? $request->bank_account : null,
                'remarks'        => $request->remarks,
            ]);
            return response()->json([
                'status' => '1',
                'message' => "Expense Added Successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => "Expense Added Successfully"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
