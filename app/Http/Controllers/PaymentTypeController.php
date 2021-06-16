<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PaymentType::paginate(10);
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
            'name'   => 'required|unique:payment_types',
            'status' => 'required|in:1,0',
        ]);

        try {
            PaymentType::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Data Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Data Save Failed'
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
        $request->validate([
            'name'   => 'required|unique:unit_types,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $data = PaymentType::find($id);

            $data->name   = $request->name;
            $data->status = $request->status;
            $data->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Data Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Date Update Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentType::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => 'Item Delete successfully'
        ]);
    }
}
