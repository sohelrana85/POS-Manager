<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::paginate(5);
        // $customers = Customer::all();
        // return response()->json([
        //     'customers' => $customers
        // ]);
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
        $this->validate($request, [
            'name'    => 'required|min:4|string',
            'email'   => 'required|email:rfc,dns|unique:customers,email',
            'phone'   => 'required|digits:11|numeric|unique:customers,phone',
            'address' => 'required|min:10',
            'status'  => 'required|digits:1'
        ]);

        try {
            Customer::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'status'  => $request->status,
        ]);

            return response()->json([
                'status'  => '1',
                'message' => 'Data save success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Data save fail',
                // 'details' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required|min:4|string',
            'email'   => 'required|email:rfc,dns|unique:customers,email,' . $id,
            'phone'   => 'required|digits:11|numeric|unique:customers,phone,' . $id,
            'address' => 'required|min:10',
            'status'  => 'required|digits:1'
        ]);

        try {
            $customer = Customer::find($id);

            $customer->user_id = Auth::id();
            $customer->name    = $request->name;
            $customer->email   = $request->email;
            $customer->phone   = $request->phone;
            $customer->address = $request->address;
            $customer->status  = $request->status;
            $customer->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Data Update successful'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Data Update fail',
                // 'details' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if($customer) {
            $customer->delete();
            return response()->json([
                'status'  => '1',
                'message' => 'Data Delete successfully'
            ]);
        } else {
            return response()->json([
                'status'  => '0',
                'message' => 'Data Not Found!'
            ]);
        }
    }
}
