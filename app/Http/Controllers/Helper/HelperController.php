<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PackageSize;
use App\Models\PaymentStatus;
use App\Models\PaymentType;
use App\Models\Product;
use App\Models\ProductSell;
use App\Models\PurchaseStatus;
use App\Models\Supplier;
use App\Models\UnitType;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function get_category(){
        $category = Category::all();
        return response()->json([
            'category' => $category
        ]);
    }
    public function get_brand(){
        $brand = Brand::all();
        return response()->json([
            'brand' => $brand
        ]);
    }
    public function get_unit_type(){
        $unit_type = UnitType::all();
        return response()->json([
            'unit_type' => $unit_type
        ]);
    }
    public function get_package_size($id){
        $package_size = PackageSize::where('unit_id', $id)->get();
        return response()->json([
            'package_size' => $package_size
        ]);
    }

    public function get_warehouse(){
        $warehouses = Warehouse::all();
        return response()->json([
            'warehouses' => $warehouses
        ]);
    }
    public function get_suppliers(){
        $supplier = Supplier::all();
        return response()->json([
            'supplier' => $supplier
        ]);
    }
    public function get_purchase_status(){
        $purchase_status = PurchaseStatus::all();
        return response()->json([
            'purchase_status' => $purchase_status
        ]);
    }
    // public function get_payment_status(){
    //     $payment_status = PaymentStatus::all();
    //     return response()->json([
    //         'payment_status' => $payment_status
    //     ]);
    // }
    public function get_payment_type(){
        $payment_type = PaymentType::all();
        return response()->json([
            'payment_type' => $payment_type
        ]);
    }
    // public function get_purchase_type(){
    //     $purchase_type = PurchaseType::all();
    //     return response()->json([
    //         'purchase_type' => $purchase_type
    //     ]);
    // }
    public function get_products(){
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }
    public function get_bank_account(){
        $bank_account = BankAccount::all();
        return response()->json([
            'bank_accounts' => $bank_account
        ]);
    }

    //get last invoice no
    public function get_last_invoice_no(){
        $last_invoice_no = ProductSell::all()->pluck('invoice_no')->last();
        return response()->json([
            'last_invoice_no' => $last_invoice_no
        ]);
    }

    //Get Customers
    public function get_customers() {
        $customers = Customer::select('id','name')->get();
        return response()->json([
            'customers' => $customers
        ]);
    }
}
