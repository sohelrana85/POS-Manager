<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BankAccountController extends Controller
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
        if(!$this->user->can('bank-account.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.bank.manage-bank');
    }

    public function all_bank_account()
    {
        if(!$this->user->can('bank-account.view')){
            abort(403, 'sorry! Access Denied');
        }

        return BankAccount::paginate(10);
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
        if(!$this->user->can('bank-account.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'bank_name'      => 'required|string',
            'account_name'   => 'required|unique:bank_accounts',
            'account_number' => 'required|unique:bank_accounts',
            'branch_name'    => 'required|string',
            'status'         => 'required|in:1,0',
        ]);

        try {
            BankAccount::create([
                'user'           => Auth::id(),
                'bank_name'      => $request->bank_name,
                'account_name'   => $request->account_name,
                'account_number' => $request->account_number,
                'branch_name'    => $request->branch_name,
                'status'         => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Account Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Account Save Failed',
                'error'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->user->can('bank-account.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'bank_name'      => 'required|string',
            'account_name'   => 'required|unique:bank_accounts,id,'.$id,
            'account_number' => 'required|unique:bank_accounts,id,'.$id,
            'branch_name'    => 'required|string',
            'status'         => 'required|in:1,0',
        ]);

        try {
            $data = BankAccount::find($id);

            $data->user           = Auth::id();
            $data->bank_name      = $request->bank_name;
            $data->account_name   = $request->account_name;
            $data->account_number = $request->account_number;
            $data->branch_name    = $request->branch_name;
            $data->status         = $request->status;
            $data->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Account Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Account Update Failed',
                'error'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->user->can('bank-account.delete')){
            abort(403, 'sorry! Access Denied');
        }

        BankAccount::find($id)->delete();
        return response()->json([
            'status' => '1',
            'message' => 'Account Delete Success'
        ]);
    }
}
