<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UnitTypeController extends Controller
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
        if(!$this->user->can('unit.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.product.unit-type');
    }


    public function all_unit_type()
    {
        if(!$this->user->can('unit.view')){
            abort(403, 'sorry! Access Denied');
        }

        return UnitType::paginate(10);
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
        if(!$this->user->can('unit.create')){
            abort(403, 'sorry! Access Denied');
        }

        $id = $request->id;
        $request->validate([
            'name'   => 'required|unique:unit_types,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            UnitType::create([
                'user_id' => Auth::id(),
                'name'    => $request->name,
                'status'  => $request->status,
            ]);
            return response()->json([
                'status'  => '1',
                'message' => 'Unit Save Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Unit Save Failed'
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
        if(!$this->user->can('unit.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'name'   => 'required|unique:unit_types,name,' .$id,
            'status' => 'required|in:1,0',
        ]);

        try {
            $unit_type = UnitType::find($id);

            $unit_type->name   = $request->name;
            $unit_type->status = $request->status;
            $unit_type->update();

            return response()->json([
                'status'  => '1',
                'message' => 'Unit Update Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => '0',
                'message' => 'Unit Update Failed'
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
        if(!$this->user->can('unit.delete')){
            abort(403, 'sorry! Access Denied');
        }

        UnitType::find($id)->delete();

        return response()->json([
            'status' => '1',
            'message' => 'Item Delete successfully'
        ]);
    }

}
