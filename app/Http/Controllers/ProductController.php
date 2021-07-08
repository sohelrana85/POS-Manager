<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductController extends Controller
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
        return view('pages.product.manage-product');
    }

    public function all_product()
    {
        return Product::with('category','brand','unit','package','user')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.add-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->user->can('product.create')){
            abort(403, 'sorry! Access Denied');
        }

        $request->validate([
            'product_name'        => 'required|string|unique:products,product_name',
            'product_code'        => 'required|string|unique:products,product_code',
            'product_desc'        => 'required',
            'category'            => 'required',
            'brand'               => 'required',
            'unit_type'           => 'required',
            'package_size'        => 'required',
            'unit_selling_price'  => 'required',
            'discount_price_from' => $request->discount_price ? 'required' : '',
            'discount_price_to'   => $request->discount_price ? 'required' : '',
         ]);

        try {
            Product::create([
                'user'                => Auth::id(),
                'product_name'        => $request->product_name,
                'product_code'        => $request->product_code,
                'product_desc'        => $request->product_desc,
                'category'            => $request->category,
                'brand'               => $request->brand,
                'unit_type'           => $request->unit_type,
                'package_size'        => $request->package_size,
                'unit_selling_price'  => $request->unit_selling_price,
            ]);
            if($request->discount_price) {
                Product::create([
                    'discount_price'      => $request->discount_price,
                    'discount_price_from' => $request->discount_price_from,
                    'discount_price_to'   => $request->discount_price_to,
                ]);
                }

            return Response()->json([
                'status' => '1',
                'message' => 'Product Added Successfully'
            ]);
        } catch (Exception $e) {
             return Response()->json([
                'status' => '0',
                'message' => 'Ops! Product Add Failed!',
                'error' => $e->getMessage()
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->user->can('product.delete')){
            abort(403, 'sorry! Access Denied');
        }

        $product = Product::find($id);
        if($product) {
            $product->delete();
            return response()->json([
                'status'  => '1',
                'message' => 'Data Delete successfully'
            ]);
        } else {
            return response()->json([
                'status'  => '0',
                'message' => 'Data Not Found!'
            ]);
        }
    }

    public function print_barcode()
    {
        return view('pages.product.print-barcode');
    }
}
