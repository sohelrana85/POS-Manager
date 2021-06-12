<?php

namespace App\Http\Controllers;

use App\Models\PackageSize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PackageSize::with('unitTypes')->paginate(5);
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
            'unit_type' => 'required',
            'name'      => 'required|unique:package_sizes,name,' .$id,
            'status'    => 'required|in:1,0',
        ]);

        try {
            PackageSize::create([
                'user_id' => Auth::id(),
                'unit_id' => $request->unit_type,
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Package Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Package Save Failed'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageSize  $packageSize
     * @return \Illuminate\Http\Response
     */
    public function show(PackageSize $packageSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageSize  $packageSize
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageSize $packageSize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageSize  $packageSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
                'unit_type' => 'required',
                'name'      => 'required|unique:package_sizes,name,' .$id,
                'status'    => 'required|in:1,0',
        ]);

        try {
            $package = PackageSize::find($id);

            $package->unit_id = $request->unit_type;
            $package->name    = $request->name;
            $package->status  = $request->status;
            $package->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Package Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => '0',
                'message' => 'Package Update Failed'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageSize  $packageSize
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       PackageSize:: find($id)->delete();

        return response()->json([
            'status'  => '1',
            'message' => 'Item Delete successfully'
        ]);
    }
}
