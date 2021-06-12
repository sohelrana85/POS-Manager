<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function all_purchase(){
        $all_purchase = Purchase::with('supplier','product')->where('status','0')->get();

            return response()->json([
                'all_purchase' => $all_purchase
            ]);
    }


    public function add_to_stock($id){

        $product = Purchase::find($id);

        $checkDuplicate = Stock::where('product_name', $product->product_name)->first();

        // DB::beginTransaction();
       try {
            if($checkDuplicate == null) {
                $result = Stock::create([
                    'user'         => Auth::id(),
                    'product_name' => $product->product_name,
                    'warehouse'    => $product->warehouse,
                    'stock_qty'    => $product->product_qty + $product->free_qty,
                    'stock_value'  => $product->total_price,
                ]);

                if($result){
                    $product->status = 1;
                    $product->update();
                }
            } else {

                $checkDuplicate->stock_qty  += $product->product_qty + $product->free_qty;
                $checkDuplicate->stock_value  += $product->total_price;
                $checkDuplicate->update();

                $product->status = 1;
                $product->update();
            }

            return response()->json([
                'status' => '1',
                'message' => 'Product successfully Added to the Stock'
            ]);

            // DB::commit();
        } catch (Exception $e) {
                // DB::rollBack();
                return response()->json([
                'status' => '0',
                'message' => 'Product Add Failed!',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function get_all_stock(){

        $stock = Stock::all();
        return response()->json([
            'stock' => $stock
        ]);
    }
}
