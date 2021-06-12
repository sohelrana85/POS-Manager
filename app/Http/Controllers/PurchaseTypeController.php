<?php

namespace App\Http\Controllers;

use App\Models\PurchaseType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurchaseType::paginate(5);
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
        $id = $request->id;
        $request->validate([
            'name'   => 'required|unique:purchase_types,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            PurchaseType::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Item Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Item Save Failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseType $purchaseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseType $purchaseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|unique:purchase_types,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $purchase = PurchaseType::find($id);

            $purchase->name   = $request->name;
            $purchase->status = $request->status;
            $purchase->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Item Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Item Update Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseType:: find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => 'Item Delete successfully'
        ]);
    }
}
