<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
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
        if(!$this->user->can('role.view')){
            abort(403, 'sorry! Access Denied');
        }

        $roles = Role::all();
        return view('pages.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->user->can('role.create')){
            abort(403, 'sorry! Access Denied');
        }

        $group_name = Permission::pluck('group_name')->unique();
        $permissions = Permission::select('id','name','group_name')->get();
        return view('pages.role.create',compact('group_name','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->user->can('role.create')){
            abort(403, 'sorry! Access Denied');
        }

        // return $request->all();
        $request->validate([ 'name' => 'required|string|min:3|unique:roles']);
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);

        if($role){
            session()->flash('type', 'success');
            session()->flash('message', 'Role '.$role->name.' Create Successfully');
            return redirect()->back();
        } else {
            session()->flash('type', 'danger');
            session()->flash('message', 'Role Create Failed');
            return redirect()->back();
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
        if(!$this->user->can('role.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $role = Role::find($id);
        $group_name = Permission::pluck('group_name')->unique();
        $permissions = Permission::select('id','name','group_name')->get();
        return view('pages.role.edit',compact('role','group_name','permissions'));
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
        if(!$this->user->can('role.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([ 'name' => 'required|string|min:3|unique:roles,id,'.$id]);

        $role = Role::find($id);
        try {
            $role->name = $request->name;
            $role->update();

            $role->syncPermissions($request->permissions);

            session()->flash('type', 'success');
            session()->flash('message', 'Role '.$role->name.' Update Successfully');
            return redirect()->route('role.index');
        } catch (Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', 'Role '.$role->name.' Update Failed');
            return redirect()->back();
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
        if(!$this->user->can('role.delete')){
            abort(403, 'sorry! Access Denied');
        }

        $myrole = $this->user->roles;
        $role = Role::findById($id);

        if($myrole['0']->name == $role->name) {
            session()->flash('type', 'danger');
            session()->flash('message', 'You can not Delete Yourself');
            return redirect()->back();
        } else {
            $role->delete();
            session()->flash('type', 'success');
            session()->flash('message', 'Role Delete Successfully');
            return redirect()->back();
        }

    }
}
