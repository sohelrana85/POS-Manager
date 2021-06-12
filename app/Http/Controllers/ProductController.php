<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        return Product::with('category','brand','unit','package','user')->paginate(10);
    }

    public function store(Request $request){

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
    public function store_product_purchase(Request $request){

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

    public function delete($id){
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
}
