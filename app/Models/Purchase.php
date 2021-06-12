<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable =[
            'user','memo_no','memo_date','warehouse','supplier','purchase_status',
            'product_name','product_qty','free_qty','unit_price','total_price','order_tax','order_discount','shipping_cost','payment_status','paid_amount','due_amount','payment_type','bank_account',
    ];

    public function warehouse(){
        return $this->belongsTo(Warehouse::class, 'warehouse')->select('id','name');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier')->select('id','business_name');
    }
    public function purchase_status(){
        return $this->belongsTo(PurchaseStatus::class, 'purchase_status')->select('id','name');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_name')->select('id','product_name');
    }
    public function payment_type(){
        return $this->belongsTo(PaymentType::class, 'payment_type')->select('id','name');
    }
    public function bank_account(){
        return $this->belongsTo(BankAccount::class, 'bank_account')->select('id','bank_name');
    }
}
