<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::paginate(5);
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
            'name'   => 'required|unique:brands,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            Brand::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Brand Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Brand Save Failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|unique:brands,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $brand = Brand::find($id);

            $brand->name   = $request->name;
            $brand->status = $request->status;
            $brand->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Brand Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Brand Update Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => "Brand Delete Success"
        ]);
    }
}
