<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Supplier::paginate(10);
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
            'business_name' => 'required|string|unique:suppliers,business_name,' . $id,
            's_name'        => 'required|string|min:4',
            'email'         => 'required|email:rfc,dns|unique:suppliers,email,' . $id,
            'phone'         => 'required|digits:11|unique:suppliers,phone,' . $id,
            'address'       => 'required|string',
            'status'         => 'required|in:0,1',
        ]);

        try {

            Supplier::create([
            'user_id'       => Auth::id(),
            'business_name' => $request->business_name,
            'name'          => $request->s_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'status'        => $request->status,
        ]);

            return response()->json([
                'status'  => '1',
                'message' => 'Supplier Added Successfully'
        ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Opps! Something Wrong.'
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_name' => 'required|string|unique:suppliers,business_name,' . $id,
            's_name'        => 'required|string|min:4',
            'email'         => 'required|email:rfc,dns|unique:suppliers,email,' . $id,
            'phone'         => 'required|digits:11|unique:suppliers,phone,' . $id,
            'address'       => 'required|string',
            'status'         => 'required|in:0,1',
        ]);

        try {

            $supplier = Supplier::find($id);

            $supplier->business_name = $request->business_name;
            $supplier->name          = $request->s_name;
            $supplier->email         = $request->email;
            $supplier->phone         = $request->phone;
            $supplier->address       = $request->address;
            $supplier->status        = $request->status;
            $supplier->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Supplier Update Successful'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Supplier Update Failed',
                // 'exception' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => "Supplier Delete Successful"
        ]);
    }


    //Extra
    public function return_item(){
        return view('pages.supplier.return-item');
    }
    public function due_payment(){
        return view('pages.supplier.due-payment');
    }
}
