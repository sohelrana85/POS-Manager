<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
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
        if(!$this->user->can('user.view')){
            abort(403, 'sorry! Access Denied');
        }

        $users = User::all();
        return view('pages.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->user->can('user.create')){
            abort(403, 'sorry! Access Denied');
        }

        $roles = Role::all();
        return view('pages.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->user->can('user.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'name'     => 'required|string|min:4',
            'email'    => 'required|email:rfc,dns|unique:users',
            'password' => 'required|string|min:6|max:20',
            'role'     => 'required',
        ]);

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles($request->role);

            session()->flash('type','success');
            session()->flash('message','A User Create Successful');
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('type','success');
            session()->flash('message','A User Create Failed');
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
        if(!$this->user->can('user.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $roles = Role::all();
        $user = User::find($id);
        return view('pages.user.edit',compact('user','roles'));
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
        if(!$this->user->can('user.edit')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'name'     => 'required|string|min:4',
            'email'    => 'required|email:rfc,dns|unique:users,id,'.$id,
            'role'     => 'required',
        ]);

        try {
            $user = User::find($id);
                $user->name     = $request->name;
                $user->email    = $request->email;
                $user->update();

            $user->syncRoles($request->role);

            session()->flash('type','success');
            session()->flash('message','A User Create Successful');
            return redirect()->back();

        } catch (\Throwable $th) {
            session()->flash('type','success');
            session()->flash('message','A User Create Failed');
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
        if(!$this->user->can('user.delete')){
            abort(403, 'sorry! Access Denied');
        }

        User::find($id)->delete();

        session()->flash('type','success');
        session()->flash('message','A user delete Successful');
        return redirect()->back();
    }
}
