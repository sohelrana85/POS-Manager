<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SupplierController extends Controller
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
        if(!$this->user->can('supplier.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.supplier.manage-supplier');
    }


    public function all_supplier()
    {
        if(!$this->user->can('supplier.view')){
            abort(403, 'sorry! Access Denied');
        }

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
        if(!$this->user->can('supplier.create')){
            abort(403, 'sorry! Access Denied');
        }

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
        if(!$this->user->can('supplier.edit')){
            abort(403, 'sorry! Access Denied');
        }

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
        if(!$this->user->can('supplier.delete')){
            abort(403, 'sorry! Access Denied');
        }

        Supplier::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => "Supplier Delete Successful"
        ]);
    }


    //Extra
    public function return_item()
    {
        if(!$this->user->can('supplier.return')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.supplier.return-item');
    }
    public function due_payment()
    {
        if(!$this->user->can('supplier.due-payment')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.supplier.due-payment');
    }
}
