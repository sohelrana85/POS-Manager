<?php

namespace App\Http\Controllers;

use App\Models\BankTransaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankTransactionController extends Controller
{
    public function index()
    {
        return BankTransaction::with('bank_names')->orderBy('date','desc')->paginate(10);
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'description'      => 'required|string',
            'transaction_type' => 'required|in:debit,credit',
            'bank_name'        => 'required',
            'amount'           => 'required|numeric',
        ]);

        try {

            $last_balance = BankTransaction::where('bank_name', $request->bank_name)->pluck('balance')->last();

            BankTransaction::create([
                'user_id'          => Auth::id(),
                'date'             => $request->transaction_date,
                'description'      => $request->description,
                'transaction_type' => $request->transaction_type,
                'bank_name'        => $request->bank_name,
                'debit'            => $request->transaction_type == 'debit' ? $request->amount : 0,
                'credit'           => $request->transaction_type == 'credit' ? $request->amount : 0,
                'balance'          => $request->transaction_type == 'debit' ? $last_balance + $request->amount : $last_balance - $request->amount,
            ]);

            return response()->json([
                'status' => '1',
                'message' => 'Data save Success.'
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status' => '0',
                'message' => 'Data save failed.',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        BankTransaction::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => 'Item delete Successfully'
        ]);
    }


    //Ledger
    public function search_ledger(Request $request)
    {

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'bank_id' => 'required'
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $bank_id = $request->bank_id;

        $data = BankTransaction::with('bank_names')->where('date','>=', $start_date)->where('date','<=', $end_date)->where('bank_name','like', $bank_id)->get();

        return response()->json([
                'result' => $data
            ]);
        }
}
