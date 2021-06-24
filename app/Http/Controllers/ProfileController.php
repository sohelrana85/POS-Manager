<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        if($request->profile_pic){

            $user = User::find(Auth::id());

            if(file_exists(public_path('upload_file/pp/').$user->profile_pic)){
                unlink(public_path('upload_file/pp/').$user->profile_pic);
            }

            $filename = Str::replace(' ','-',Str::lower($request->name))."_pp.".$request->profile_pic->extension();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->profile_pic = $filename;
            $user->update();

            $request->profile_pic->move(public_path('upload_file/pp'), $filename);

        } else {
            auth()->user()->update($request->all());
        }
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
