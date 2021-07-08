<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ExpenseTypeController extends Controller
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
        if(!$this->user->can('expense-type.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.expense.expense-type');
    }


    public function all_expense_type()
    {
        if(!$this->user->can('expense-type.view')){
            abort(403, 'sorry! Access Denied');
        }

        $expense_types = ExpenseType::paginate(10);
        return $expense_types;
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
        if(!$this->user->can('expense-type.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'expense_name' => 'required|string|min:4|unique:expense_types,expense_type',
            'status'       => 'required|in:1,0'
        ]);

        try {
            ExpenseType::create([
                'user' => Auth::id(),
                'expense_type' => $request->expense_name,
                'status' => $request->status
            ]);
            return response()->json([
                'status' => '1',
                'message' => 'Expense Type Added Successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Expense Type Added Successfully',
                // 'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseType $expenseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseType $expenseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->user->can('expense-type.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'expense_name' => 'required|string|min:4|unique:expense_types,expense_type,' .$id,
            'status'       => 'required|in:1,0'
        ]);

        try {
            $exp_type = ExpenseType::find($id);

                $exp_type->user         = Auth::id();
                $exp_type->expense_type = $request->expense_name;
                $exp_type->status       = $request->status;
                $exp_type->update();

            return response()->json([
                'status' => '1',
                'message' => 'Data Update Successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Data Update Failed',
                // 'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->user->can('expense-type.delete')){
            abort(403, 'sorry! Access Denied');
        }

       ExpenseType::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => 'Expense Type Delete successfully'
        ]);
    }
}
