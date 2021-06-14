<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSell extends Model
{
    use HasFactory;
    protected $fillable = ['user','product','customer','invoice_no','invoice_date','product_qty','product_price','tax','product_discount','shipping_cost','previous_due','total_amount','payment_status','receive_amount','due_amount','payment_type','account_name'
    ];

    public function productName(){
        return $this->belongsTo(Product::class, 'product','id')->select('id','product_name');
    }
    public function customers(){
        return $this->belongsTo(Customer::class, 'customer','id')->select('id','name');
    }
}
