<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class BusinessSettingController extends Controller
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
        if(!$this->user->can('business-setting.view')){
            abort(403, 'sorry! Access Denied');
        }

        return view('pages.setting.business-setting');
    }


    public function get_business_setting_data()
    {
        if(!$this->user->can('business-setting.view')){
            abort(403, 'sorry! Access Denied');
        }

        $business_setting = BusinessSetting::all();
        return response()->json($business_setting);
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
        if(!$this->user->can('business-setting.create')){
            abort(403, 'sorry! Access Denied');
        }

        $data = BusinessSetting::find($request->id);
        if(!is_null($data)){
            $path = public_path('upload_file/logo/');
            if(file_exists($path.$data->logo)){
                unlink($path.$data->logo);
            }
            $data->delete();
        }
        $request->validate([
            'business_name'    => 'required|string|unique:business_settings',
            'business_address' => 'required|string',
            'country'          => 'required|string',
            'city'             => 'required|string',
            'mobile'           => 'required|digits:11',
            'start_date'       => 'required|date',
            'currency'         => 'required|string',
            'currency_symbol'  => 'required',
            'upload_logo'      => 'required',
            'date_format'      => 'required',
            'time_format'      => 'required'
        ]);

        $extension = $request->upload_logo->extension();
        $filename = Str::replace(" ","", Str::lower($request->business_name))."_logo.".$extension;
        try {

            $upload = $request->upload_logo->move(public_path('upload_file/logo'),$filename);

            if($upload) {
                BusinessSetting::create([
                    'user'            => Auth::id(),
                    'business_name'   => $request->business_name,
                    'address'         => $request->business_address,
                    'country'         => $request->country,
                    'city'            => $request->city,
                    'mobile'          => $request->mobile,
                    'start_date'      => $request->start_date,
                    'email'           => $request->email ? $request->email : null,
                    'website'         => $request->website ? $request->website : null,
                    'currency'        => $request->currency,
                    'currency_symbol' => $request->currency_symbol,
                    'logo'            => $filename,
                    'date_format'     => $request->date_format,
                    'time_format'     => $request->time_format,
                ]);
            }

            return response()-> json([
                'status' => '1',
                'message' => "data save success"
            ]);
        } catch (Exception $e) {
            return response()-> json([
                'status' => '0',
                'message' => "data save failed",
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessSetting  $businessSetting
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessSetting $businessSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessSetting  $businessSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessSetting $businessSetting)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessSetting  $businessSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'business_name'    => 'required|string|unique:business_settings,id,'.$id,
        //     'business_address' => 'required|string',
        //     'country'          => 'required|string',
        //     'city'             => 'required|string',
        //     'mobile'           => 'required|digits:11',
        //     'start_date'       => 'required|date',
        //     'currency'         => 'required|string',
        //     'currency_symbol'  => 'required',
        //     // 'upload_logo'      => 'required',
        //     'date_format'      => 'required',
        //     'time_format'      => 'required'
        // ]);


        // $data = BusinessSetting::find($id);
        // $path = public_path('upload_file/logo/');
        // if(file_exists($path.$data->logo)){
        // unlink($path.$data->logo);
        // }

        // $extension = $request->upload_logo->extension();
        // $filename = Str::replace(" ","", Str::lower($request->business_name))."_logo.".$extension;
        // try {

        //     $upload = $request->upload_logo->move(public_path('upload_file/logo'),$filename);

        //     $data->business_name   =  $request->business_name;
        //     $data->address         =  $request->business_address;
        //     $data->country         =  $request->country;
        //     $data->city            =  $request->city;
        //     $data->mobile          =  $request->mobile;
        //     $data->start_date      =  $request->start_date;
        //     $data->email           =  $request->email ? $request->email : null;
        //     $data->website         =  $request->website ? $request->website : null;
        //     $data->currency        =  $request->currency;
        //     $data->currency_symbol =  $request->currency_symbol;
        //     // $data->logo            =  $filename;
        //     $data->date_format     =  $request->date_format;
        //     $data->time_format     =  $request->time_format;
        //     $data->update();

        //     return response()-> json([
        //         'status' => '1',
        //         'message' => "data Update success"
        //     ]);
        // } catch (Exception $e) {
        //     return response()-> json([
        //         'status' => '0',
        //         'message' => "data Update failed",
        //         'error' => $e->getMessage()
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessSetting  $businessSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessSetting $businessSetting)
    {
        //
    }
}
