<?php

namespace App\Http\Controllers;

use App\Models\PackageSize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PackageSizeController extends Controller
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
        if(!$this->user->can('package-size.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.product.package-size');
    }


    public function all_package_size()
    {
        if(!$this->user->can('package-size.view')){
            abort(403, 'sorry! Access Denied');
        }

        return PackageSize::with('unitTypes')->paginate(10);
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
        if(!$this->user->can('package-size.create')){
            abort(403, 'sorry! Access Denied');
        }

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
        if(!$this->user->can('package-size.edit')){
            abort(403, 'sorry! Access Denied');
        }

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
        if(!$this->user->can('package-size.delete')){
            abort(403, 'sorry! Access Denied');
        }

       PackageSize:: find($id)->delete();

        return response()->json([
            'status'  => '1',
            'message' => 'Item Delete successfully'
        ]);
    }
}
